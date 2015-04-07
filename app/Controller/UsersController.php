<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * CakePHP Users
 * @author robertino
 */
class UsersController extends AppController {

    public $uses = array('User', 'Listener', 'Coordinator', 'Presenter');
    public $helpers = array('SearchBox');
    public $components = array('Session', 'Crud');
    public $paginate = array();

    public function index() {
        $this->setTitle(__('Users'));
        $this->Session->write('urlBack', $this->request->here());

        $this->paginate = $this->User->optionsPaginate();

        $query = null;
        if (isset($this->params->query['query'])) {
            $query = $this->params->query['query'];
            $this->termOfSearch($query, array('User.fullname', 'User.document'));
        }
        $this->set('query', $query);

        $records = $this->paginate('User');
        $this->set('records', $records);
    }

    public function form() {
        $this->setTitle(__('User'));
        $this->Session->write('urlBack', $this->referer());
    }

    public function save() {
        $this->Crud->saveData($this->User, $this->request->data);
    }

    public function update($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->setTitle(__('User'));
        $this->Crud->loadData($this->User, $id, false);
    }

    public function delete($id = null) {
        $this->Crud->deleteData($this->User, $id);
    }

    public function status($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->Crud->updateStatus($this->User, $id);
    }

    public function import() {
        $this->Session->write('urlBack', $this->referer());
    }

    public function importCheck() {
        if ($this->request->is('post')) {
            $encoding = array();
            $encoding[] = "UTF-8";
            $encoding[] = "ISO-8859-1";
            $delimiter = ",";

            $handle = fopen($this->request->data['User']['filecsv']['tmp_name'], 'r');

            $return = array(
                'messages' => array(),
                'errors' => array()
            );
            $i = 0;
            $data = array();

            while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE) {
                if (empty($row[0]) || empty($row[1]) || empty($row[2])) {
                    $return['errors'][] = __('O registro da linha %d possui um formato inválido.', $i);
                } else {
                    if (!$this->User->getUserByEmail(trim($row[1]))) {
                        if (mb_detect_encoding(trim($row[0]), $encoding) == $encoding[0]) {
                            $data[$i]['User']['fullname'] = trim($row[0]);
                            $data[$i]['User']['email'] = trim($row[1]);
                            $data[$i]['User']['document'] = trim($row[2]);
                            $data[$i]['User']['phone'] = trim($row[3]);
                        } else {
                            $data[$i]['User']['fullname'] = iconv('ISO-8859-1', 'UTF-8', trim($row[0]));
                            $data[$i]['User']['email'] = iconv('ISO-8859-1', 'UTF-8', trim($row[1]));
                            $data[$i]['User']['document'] = iconv('ISO-8859-1', 'UTF-8', trim($row[2]));
                            $data[$i]['User']['phone'] = iconv('ISO-8859-1', 'UTF-8', trim($row[3]));
                        }
                    } else {
                       $return['errors'][] = __('O email %s já está cadastrado.', trim($row[1])); 
                    }
                }
                $i++;
            }
            fclose($handle);
            
            if (!empty($return['errors'])) {
                $this->Session->setFlash(implode("<br>", $return['errors']), 'flash_error');
            }

            $this->request->data = $data;
        }
    }

    public function saveImport() {
        if ($this->request->is('post')) {
            $records = array();
            $count = 0;
            foreach ($this->request->data as $key => $value) {
                if (!$this->User->getUserByEmail($value['User']['email'])) {
                    $records[$count]['User']['id'] = '';
                    $records[$count]['User']['fullname'] = $value['User']['fullname'];
                    $records[$count]['User']['email'] = $value['User']['email'];
                    $records[$count]['User']['document'] = $value['User']['document'];
                    $records[$count]['User']['phone'] = $value['User']['phone'];
                    $records[$count]['User']['password'] = '123456';
                    $records[$count]['User']['role'] = 'user';
                    $count++;
                }
            }

            if ($this->User->saveAll($records, array('validate' => 'first', 'deep' => true))) {
                $this->Session->setFlash(__("%d registro(s) importado(s) com sucesso", count($this->data)), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->data = $records;
                $this->render('/Users/import_check');
            }
        } else {
            $this->redirect(array('action' => 'index'));
        }
    }

    public function verify($id = null) {
        $this->Session->write('urlBack', $this->referer());
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $record = $this->User->getUserById($id);
            $record['User']['verified'] = true;

            if ($this->User->saveAll($record)) {

                $email = new CakeEmail();

                $email->config('flisoljs');
                $email->template('confirmation');
                $email->emailFormat('html');
                $email->helpers(array('Html'));
                $email->viewVars(
                        array(
                            'fullname' => $record['User']['fullname'],
                            'email' => $record['User']['email']
                        )
                );
                $email->from($this->userEmail);
                $email->to($record['User']['email']);
                $email->subject(__('Registration confirmed'));

                $email->send();

                $this->Session->setFlash(__('Record successfully verified'), 'flash_success');
            }
        }
        return $this->redirect($this->Session->read('urlBack'));
    }

    public function myEditions() {
        $user = $this->Auth->user();

        $listeners = $this->Listener->getListenerByUser($user['id']);
        $coordinators = $this->Coordinator->getCoordinatorByUser($user['id']);
        $presenters = $this->Presenter->getPresenterByUser($user['id']);

        $this->set('listeners', $listeners);
        $this->set('coordinators', $coordinators);
        $this->set('presenters', $presenters);
    }

    public function register() {
        $this->setTitle(__('User'));
    }

    public function saveRegister() {
        if ($this->request->is('post')) {
            $this->User->create();
            $data = $this->request->data;
            $data['User']['role'] = 'user';
            if ($this->User->saveAll($data)) {
                $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->User->id));
                $record = $this->User->find('first', $options);
                $email = new CakeEmail();
                $email->config('flisoljs');
                $email->template('register');
                $email->emailFormat('html');
                $email->helpers(array('Html'));
                $email->viewVars(
                        array(
                            'fullname' => $record['User']['fullname'],
                            'email' => $record['User']['email'],
                            'hash_code_verified' => $record['User']['hash_code_verified']
                        )
                );
                $email->to($data['User']['email']);
                $email->subject(__('Confirmation email'));

                $email->send();

                $this->set('record', $record);

                $this->Session->setFlash(__('1st step of registration is complete'), 'flash_success');
            } else {
                $this->Session->setFlash(__('Unable to save the record'), 'flash_error');
                $this->set('activeRecoverPassword', false);
                
                $errors = $this->User->validationErrors;
                if (!empty($errors) && array_key_exists('email', $errors)) {
                    $this->set('activeRecoverPassword', true);
                }
                $this->render('/Users/register');
            }
        }
    }

    public function confirmation($hash_code_verified = null) {
        if ($hash_code_verified) {
            $record = $this->User->getUserByHashCode($hash_code_verified);

            if ($record) {
                if (isset($record['User']['verified']) && $record['User']['verified'] == true) {
                    $this->Session->setFlash(__('You have already confirmed your registration.'), 'flash_success');
                    $this->set('record', $record);
                } else {
                    $record['User']['verified'] = true;
                    if ($this->User->saveAll($record)) {

                        $email = new CakeEmail();
                        $email->config('flisoljs');
                        $email->template('confirmation');
                        $email->emailFormat('html');
                        $email->helpers(array('Html'));
                        $email->viewVars(
                                array(
                                    'fullname' => $record['User']['fullname'],
                                    'email' => $record['User']['email'],
                                )
                        );
                        $email->to($record['User']['email']);
                        $email->subject(__('Registration confirmed'));

                        $email->send();

                        $this->Session->setFlash(__('Congratulations! The registration is complete.'), 'flash_success');
                        $this->set('record', $record);
                    } else {
                        $this->Session->setFlash(__('Unable to validate your registration'), 'flash_error');
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            } else {
                $this->Session->setFlash(__('Unable to locate your registration'), 'flash_error');
                return $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->Session->setFlash(__('Unable to locate your registration'), 'flash_error');
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function deleteMany() {
        $this->Crud->deleteMany($this->Serie, $this->request->data);
    }

    public function restGetUsers() {
        if ($this->request->is('ajax')) {
            $this->autoLayout = false;
            $this->autoRender = false;
            if (isset($this->params->query['term'])) {
                echo json_encode($this->User->getUsersByFullname($this->params->query['term']));
            } else {
                echo json_encode(array());
            }
        }
    }

    public function login() {
        $this->setTitle(__('User'));
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Auth->authError = false;
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('User or password wrong, please try again.'), 'flash_error');
            $this->render('/Users/login');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function recoveryPassword() {
        
    }

    public function sendPassword() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $record = $this->User->getUserByEmail($data['User']['email']);
            if ($record) {
                $password = $this->__generatePassword();
                $record['User']['password'] = $password;
                if ($this->User->saveAll($record)) {
                    $email = new CakeEmail();
                    $email->config('flisoljs');
                    $email->template('resetpassword');
                    $email->emailFormat('html');
                    $email->helpers(array('Html'));
                    $email->viewVars(
                            array(
                                'fullname' => $record['User']['fullname'],
                                'email' => $record['User']['email'],
                                'password' => $password
                            )
                    );
                    $email->to($record['User']['email']);
                    $email->subject(__('Reset password'));

                    $email->send();

                    $this->Session->setFlash(__('Your password was sent by email. Please, verify your inbox.'), 'flash_success');
                    return $this->redirect(array('action' => 'login'));
                }
            } else {
                $this->Session->setFlash(__('Unable to locate your registration'), 'flash_error');
                return $this->redirect(array('action' => 'recoveryPassword'));
            }
        } else {
            return $this->redirect(array('action' => 'login'));
        }
    }

    public function changePassword() {
        $this->setTitle(__('User'));
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $record = $this->User->getUserByEmailAndPassword($data['User']['email'], $data['User']['oldpassword']);
            if ($record) {
                $record['User']['password'] = $data['User']['newpassword'];
                if ($this->User->saveAll($record)) {
                    $this->Session->setFlash(__('Your password was changed.'), 'flash_success');
                }
            } else {
                $this->Session->setFlash(__('User or old password wrong. Please try again.'), 'flash_error');
            }
            return $this->redirect(array('controller' => 'Editions', 'action' => 'home'));
        } else {
            $user = $this->Auth->user();
            $record = $this->User->getUserById($user['id']);
            $this->request->data = $record;
        }
    }

    private function __generatePassword($lenght = 8, $uppercase = true, $numbers = true, $symbols = false) {
        $set_letters_lower = 'abcdefghijklmnopqrstuvwxyz';
        $set_letters_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $set_numbers = '1234567890';
        $set_symbols = '!@#$%*-';
        $password = '';
        $characters = '';

        $characters .= $set_letters_lower;
        if ($uppercase)
            $characters .= $set_letters_upper;
        if ($numbers)
            $characters .= $set_numbers;
        if ($symbols)
            $characters .= $set_symbols;

        $len = strlen($characters);
        for ($n = 1; $n <= $lenght; $n++) {
            $rand = mt_rand(1, $len);
            $password .= $characters[$rand - 1];
        }
        return $password;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'register', 'saveRegister', 'confirmation', 'recoveryPassword', 'sendPassword');
    }

    public function isAuthorized($user = NULL) {
        if (parent::isAuthorized($user)) {
            return true;
        }

        if ($this->action === 'changePassword') {
            return true;
        }

        if ($this->action === 'myEditions') {
            return true;
        }

        return false;
    }

}
