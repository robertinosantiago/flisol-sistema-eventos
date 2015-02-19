<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * Description of EditionsController
 *
 * @author robertino
 */
class EditionsController extends AppController {
    
    public $uses = array('Edition', 'User', 'Coordinator', 'CoordinatorUser', 'Presenter', 'PresenterUser', 'Listener', 'ListenerUser', 'Course', 'Teacher', 'Student');
    public $helpers = array('SearchBox');
    public $components = array('Session', 'Crud', 'RequestHandler');
    public $paginate = array();

    public function index() {
        $this->setTitle(__('Editions'));
        $this->Session->write('urlBack', $this->request->here());

        $this->paginate = $this->Edition->optionsPaginate();

        $query = null;
        if (isset($this->params->query['query'])) {
            $query = $this->params->query['query'];
            $this->termOfSearch($query, array('Edition.year'));
        }
        $this->set('query', $query);

        $records = $this->paginate('Edition');
        $this->set('records', $records);
        
        $this->log(__('Acessando o index do edition'));
    }
    
    public function form() {
        $this->setTitle(__('Edition'));
        $this->Session->write('urlBack', $this->referer());
    }

    public function save($id = null) {
        $this->Crud->saveData($this->Edition, $this->request->data);
    }
    
    public function saveFiles($id = null) {
        $this->Edition->create();
        if ($this->Edition->saveAll($this->request->data, array('validate' => 'first'))) {
            $this->Session->setFlash(__('Successfully saved'), 'flash_success');
            return $this->redirect($this->Session->read('urlBack'));
        } else {
            $this->Session->setFlash(__('Unable to save the record'), 'flash_error');
            $this->render('/Editions/update');
        }
    }

    public function update($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->setTitle(__('Edition'));
        $this->Crud->loadData($this->Edition, $id, false);
        $this->set('edition_id', $this->request->data['Edition']['id']);
        $this->set('showButtonCoordinator', (empty($this->request->data['Coordinator']['file_certificate']) ? false : true));
        $this->set('showButtonPresenter', (empty($this->request->data['Presenter']['file_certificate']) ? false : true));
    }

    public function delete($id = null) {
        $this->Crud->deleteData($this->Edition, $id);
    }

    public function status($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->Crud->updateStatus($this->Edition, $id);
    }

    public function deleteMany() {
        $this->Crud->deleteMany($this->Edition, $this->request->data);
    }
    
    public function signup($id = null) {
        if (!$this->Edition->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }

        $event = $this->Edition->getEvent($id);
        $this->set('event', $event);


        $user = $this->Auth->user();

        if ($this->Edition->isRegistered($id, $user['id'])) {
            $this->Session->setFlash(__('You are already registered in this event'), 'flash_error');
        } else {
            $listenerUser = array(
                'user_id' => $user['id'],
                'listener_id' => $event['Listener']['id']
            );
            if ($this->ListenerUser->saveAll($listenerUser, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Your registration has been successful'), 'flash_success');
            }
        }
    }

    public function showCertificates($id = null) {
        $this->Session->write('urlBack', $this->referer());
        if ($this->request->is('post')) {
            $options = array('fields' => array('Edition.id', 'Edition.show_certificate'), 'conditions' => array('Edition.' . $this->Edition->primaryKey => $id));
            $registry = $this->Edition->find('first', $options);
            $registry['Edition']['show_certificate'] = !$registry['Edition']['show_certificate'];
            if ($this->Edition->saveAll($registry, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Successfully updated'), 'flash_success');
            }
        }
        return $this->redirect($this->Session->read('urlBack'));
    }
    
    public function courses($id = null) {
        $this->setTitle(__('Edition'));
        $this->Session->write('urlBack', $this->referer());

        if (!$this->Edition->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }
        
        $edition = $this->Edition->getEdition($id);
        $courses = $this->Course->loadCoursesByEdition($edition['Edition']['id']);
        
        $this->set('edition', $edition);
        $this->set('records', $courses);
        
    }
    
    public function formCourse($id = null) {
        $this->setTitle(__('Course'));
        $this->Session->write('urlBack', $this->referer());
        
        if (!$this->Edition->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }
        
        $edition = $this->Edition->getEdition($id);
        $this->set('edition', $edition);
    }
    
    public function saveCourse($id = null) {
        $this->Crud->saveData($this->Course, $this->request->data);
    }
    
    public function updateCourse($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->setTitle(__('Course'));
        $this->Crud->loadData($this->Course, $id, false);
        $this->set('course_id', $this->request->data['Course']['id']);
        $this->set('showButtonTeacher', (empty($this->request->data['Teacher']['file_certificate']) ? false : true));
        $this->set('showButtonStudent', (empty($this->request->data['Student']['file_certificate']) ? false : true));
    }
    
    public function saveFileCourse($id = null) {
        $this->Course->create();
        if ($this->Course->saveAll($this->request->data, array('validate' => 'first'))) {
            $this->Session->setFlash(__('Successfully saved'), 'flash_success');
            return $this->redirect($this->Session->read('urlBack'));
        } else {
            $this->Session->setFlash(__('Unable to save the record'), 'flash_error');
            $this->render('/Editions/updateCourse');
        }
    }
    
    
    public function peoples($id = null) {
        $this->setTitle(__('Edition'));
        $this->Session->write('urlBack', $this->referer());

        if (!$this->Edition->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }

        $edition = $this->Edition->getEdition($id);
        $coordinators = $this->Coordinator->loadCoordinatorsByEdition($edition['Edition']['id']);
        $presenters = $this->Presenter->loadPresentersByEdition($edition['Edition']['id']);
        $listeners = $this->Listener->loadListenersByEdition($edition['Edition']['id']);

        $this->set('edition', $edition);
        $this->set('coordinators', $coordinators);
        $this->set('presenters', $presenters);
        $this->set('listeners', $listeners);

        $this->set('totalOfCoordinators', $this->Coordinator->countCoordinators($edition['Edition']['id']));
        $this->set('totalOfPresenters', $this->Presenter->countPresenters($edition['Edition']['id']));
        $this->set('totalOfListeners', $this->Listener->countListeners($edition['Edition']['id']));
    }

    public function addCoordinatorUser() {
        $this->Session->write('urlBack', $this->referer());
        $this->__addUserOnEdition($this->CoordinatorUser, $this->Coordinator, 'coordinator_id');
    }

    public function deleteCoordinatorUser($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->__deleteUserOnEdition($this->CoordinatorUser, $id);
    }

    public function addPresenterUser() {
        $this->Session->write('urlBack', $this->referer());
        $this->__addUserOnEdition($this->PresenterUser, $this->Presenter, 'presenter_id');
    }

    public function deletePresenterUser($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->__deleteUserOnEdition($this->PresenterUser, $id);
    }

    public function addListenerUser() {
        $this->Session->write('urlBack', $this->referer());
        $this->__addUserOnEdition($this->ListenerUser, $this->Listener, 'listener_id');
    }

    public function deleteListenerUser($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->__deleteUserOnEdition($this->ListenerUser, $id);
    }

    private function __addUserOnEdition($modelEditionUser, $modelUser, $fieldNameUser) {
        $user_id = $this->request->data[$modelEditionUser->name]['id'];
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('User not found'));
        }
        $record_id = $this->request->data[$modelEditionUser->name][$fieldNameUser];
        if (!$modelUser->exists($record_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        $data = array($modelEditionUser->name => array('id' => null, 'user_id' => $user_id, $fieldNameUser => $record_id));
        if ($modelEditionUser->name === 'PresenterUser') {
            $data[$modelEditionUser->name]['title'] = $this->request->data[$modelEditionUser->name]['title'];
        }
        $modelEditionUser->create();
        try {
            if ($modelEditionUser->saveAll($data)) {
                $this->Session->setFlash(__('Successfully added'), 'flash_success');
            }
        } catch (Exception $exc) {
            $this->Session->setFlash(__('Unable to add this user'), 'flash_error');
        }
        return $this->redirect($this->Session->read('urlBack'));
    }

    private function __deleteUserOnEdition($modelEditionUser, $id) {
        if ($this->request->is('post')) {
            if ($modelEditionUser->delete($id)) {
                $this->Session->setFlash(__('Successfully deleted'), 'flash_success');
            }
        }
        return $this->redirect($this->Session->read('urlBack'));
    }

    public function attendListenerUser($listener_id, $user_id) {
        $this->Session->write('urlBack', $this->referer());
        if ($this->request->is('post')) {
            $record = $this->ListenerUser->getListenerUser($listener_id, $user_id);
            if ($record) {
                $record['ListenerUser']['attended'] = true;
                if ($this->ListenerUser->saveAll($record)) {
                    $this->Session->setFlash(__('Successfully updated'), 'flash_success');
                }
            }
        }
        return $this->redirect($this->Session->read('urlBack'));
    }

    public function viewListenerImage($id = null) {
        $this->autoLayout = false;
        if (!$this->Edition->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }
        $base64 = $this->Listener->base64_file($id);

        if ($base64) {
            $this->set('base64', $base64);
            $this->set('error', false);
        } else {
            $this->set('base64', null);
            $this->set('error', true);
        }
    }

    public function viewCoordinatorImage($id = null) {
        $this->autoLayout = false;
        if (!$this->Edition->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }
        $base64 = $this->Coordinator->base64_file($id);

        if ($base64) {
            $this->set('base64', $base64);
            $this->set('error', false);
        } else {
            $this->set('base64', null);
            $this->set('error', true);
        }
    }

    public function viewPresenterImage($id = null) {
        $this->autoLayout = false;
        if (!$this->Edition->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }
        $base64 = $this->Presenter->base64_file($id);

        if ($base64) {
            $this->set('base64', $base64);
            $this->set('error', false);
        } else {
            $this->set('base64', null);
            $this->set('error', true);
        }
    }
    
    public function viewTeacherImage($id = null) {
        $this->autoLayout = false;
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }
        $base64 = $this->Teacher->base64_file($id, 'course_id');

        if ($base64) {
            $this->set('base64', $base64);
            $this->set('error', false);
        } else {
            $this->set('base64', null);
            $this->set('error', true);
        }
    }
    
    public function viewStudentImage($id = null) {
        $this->autoLayout = false;
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }
        $base64 = $this->Student->base64_file($id, 'course_id');

        if ($base64) {
            $this->set('base64', $base64);
            $this->set('error', false);
        } else {
            $this->set('base64', null);
            $this->set('error', true);
        }
    }

    public function getCertificate($typeUser = null, $id = null, $hash_code = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->autoLayout = false;

        if ($typeUser == 'listener') {
            $record = $this->Listener->getInfoCertificate($id, $hash_code);
        } else if ($typeUser == 'coordinator') {
            $record = $this->Coordinator->getInfoCertificate($id, $hash_code);
        } else if ($typeUser == 'presenter') {
            $record = $this->Presenter->getInfoCertificate($id, $hash_code);
        } else {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Editions', 'action' => 'home'));
        }

        if (!$record) {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Editions', 'action' => 'home'));
        }

        $this->pdfConfig = array(
            'orientation' => 'landscape'
        );
        $base64 = null;

        if ($typeUser == 'listener') {
            $base64 = $this->Listener->base64_file($record['edition_id']);
        } else if ($typeUser == 'coordinator') {
            $base64 = $this->Coordinator->base64_file($record['edition_id']);
        } else if ($typeUser == 'presenter') {
            $base64 = $this->Presenter->base64_file($record['edition_id']);
        } else {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Editions', 'action' => 'home'));
        }

        $this->set('base64', $base64);
        $this->set('typeUser', $typeUser);
        $this->set('record', $record);
    }

    public function viewCertificateCoordinator($coordinator_id = null, $user_id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->autoLayout = false;

        if (!$this->Coordinator->exists($coordinator_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {

            $this->pdfConfig = array(
                'orientation' => 'landscape',
            );

            $coordinator = $this->Coordinator->getCoordinatorById($coordinator_id);
            $user = $this->User->getUserById($user_id);
            $coordinatorUser = $this->CoordinatorUser->getCoordinatorUser($coordinator_id, $user_id);

            $base64 = $this->Coordinator->base64_file($coordinator['Coordinator']['edition_id']);

            $this->set('coordinator', $coordinator);
            $this->set('user', $user);
            $this->set('coordinatorUser', $coordinatorUser);
            $this->set('base64', $base64);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    public function sendCertificateCoordinator($coordinator_id = null, $user_id = null) {
        $this->Session->write('urlBack', $this->referer());

        if (!$this->Coordinator->exists($coordinator_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $user = $this->User->getUserById($user_id);
            $coordinatorUser = $this->CoordinatorUser->getCoordinatorUser($coordinator_id, $user_id);
            $edition = $this->Edition->getEditionByCoordinator($coordinator_id);

            $vars = array();
            $vars['type'] = 'coordinator';
            $vars['fullname'] = $user['User']['fullname'];
            $vars['id'] = $coordinator_id;
            $vars['hash_code'] = $coordinatorUser['CoordinatorUser']['hash_code'];
            $vars['edition'] = $edition['Edition']['year'];

            $this->__sendEmailCertificate($user['User']['email'], $vars);

            $this->Session->setFlash(__('Email successfully sent'), 'flash_success');
        }

        return $this->redirect($this->Session->read('urlBack'));
    }

    public function viewCertificatePresenter($presenter_id = null, $user_id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->autoLayout = false;

        if (!$this->Presenter->exists($presenter_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {

            $this->pdfConfig = array(
                'orientation' => 'landscape'
            );

            $presenter = $this->Presenter->getPresenterById($presenter_id);
            $user = $this->User->getUserById($user_id);
            $presenterUser = $this->PresenterUser->getPresenterUser($presenter_id, $user_id);

            $base64 = $this->Presenter->base64_file($presenter['Presenter']['edition_id']);

            $this->set('presenter', $presenter);
            $this->set('user', $user);
            $this->set('presenterUser', $presenterUser);
            $this->set('base64', $base64);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    public function sendCertificatePresenter($presenter_id = null, $user_id = null) {
        $this->Session->write('urlBack', $this->referer());

        if (!$this->Presenter->exists($presenter_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $user = $this->User->getUserById($user_id);
            $presenterUser = $this->PresenterUser->getPresenterUser($presenter_id, $user_id);
            $edition = $this->Edition->getEditionByPresenter($presenter_id);

            $vars = array();
            $vars['type'] = 'presenter';
            $vars['fullname'] = $user['User']['fullname'];
            $vars['id'] = $presenter_id;
            $vars['hash_code'] = $presenterUser['PresenterUser']['hash_code'];
            $vars['edition'] = $edition['Edition']['year'];

            $this->__sendEmailCertificate($user['User']['email'], $vars);

            $this->Session->setFlash(__('Email successfully sent'), 'flash_success');
        }

        return $this->redirect($this->Session->read('urlBack'));
    }

    public function viewCertificateListener($listener_id = null, $user_id = null) {
        $this->Session->write('urlBack', $this->referer());

        $this->autoLayout = false;

        if (!$this->Listener->exists($listener_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {

            $this->pdfConfig = array(
                'orientation' => 'landscape'
            );

            $listener = $this->Listener->getListenerById($listener_id);
            $user = $this->User->getUserById($user_id);
            $listenerUser = $this->ListenerUser->getListenerUser($listener_id, $user_id);

            $base64 = $this->Listener->base64_file($listener['Listener']['edition_id']);

            $this->set('listener', $listener);
            $this->set('user', $user);
            $this->set('listenerUser', $listenerUser);
            $this->set('base64', $base64);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    public function sendCertificateListener($listener_id = null, $user_id = null) {
        $this->Session->write('urlBack', $this->referer());

        if (!$this->Listener->exists($listener_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $user = $this->User->getUserById($user_id);
            $listenerUser = $this->ListenerUser->getListenerUser($listener_id, $user_id);
            $edition = $this->Edition->getEditionByListener($listener_id);

            $vars = array();
            $vars['type'] = 'listener';
            $vars['fullname'] = $user['User']['fullname'];
            $vars['id'] = $listener_id;
            $vars['hash_code'] = $listenerUser['ListenerUser']['hash_code'];
            $vars['edition'] = $edition['Edition']['year'];

            $this->__sendEmailCertificate($user['User']['email'], $vars);

            $this->Session->setFlash(__('Email successfully sent'), 'flash_success');
        }

        return $this->redirect($this->Session->read('urlBack'));
    }

    public function verifyCertificate($typeUser = NULL, $id = NULL, $hash_code = NULL) {
        $record = array();

        if ($typeUser == 'listener') {
            $record = $this->Listener->getInfoCertificate($id, $hash_code);
        } else if ($typeUser == 'coordinator') {
            $record = $this->Coordinator->getInfoCertificate($id, $hash_code);
        } else if ($typeUser == 'presenter') {
            $record = $this->Presenter->getInfoCertificate($id, $hash_code);
        } else {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Editions', 'action' => 'home'));
        }

        if (!$record) {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Editions', 'action' => 'home'));
        }

        $this->set('record', $record);
    }

    public function reportCoordinador() {
        $this->Session->write('urlBack', $this->referer());

        $edition_id = $this->request->data['Edition']['id'];

        if (!$this->Edition->exists($edition_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $onlyActive = $this->request->data['onlyActive'];
            $edition = $this->Edition->getEdition($edition_id);
            $records = $this->Coordinator->loadCoordinatorsByEdition($edition_id, $onlyActive);
            $count = $this->Coordinator->countCoordinators($edition_id, $onlyActive);

            $this->set('edition', $edition);
            $this->set('records', $records);
            $this->set('count', $count);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    public function reportPresenter() {
        $this->Session->write('urlBack', $this->referer());

        $edition_id = $this->request->data['Edition']['id'];

        if (!$this->Edition->exists($edition_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $onlyActive = $this->request->data['onlyActive'];
            $edition = $this->Edition->getEdition($edition_id);
            $records = $this->Presenter->loadPresentersByEdition($edition_id, $onlyActive);
            $count = $this->Presenter->countPresenters($edition_id, $onlyActive);

            $this->set('edition', $edition);
            $this->set('records', $records);
            $this->set('count', $count);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    public function reportListener() {
        $this->Session->write('urlBack', $this->referer());

        $edition_id = $this->request->data['Edition']['id'];

        if (!$this->Edition->exists($edition_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $onlyActive = $this->request->data['onlyActive'];
            $onlyVerified = $this->request->data['onlyVerified'];
            $edition = $this->Edition->getEdition($edition_id);
            $records = $this->Listener->loadListenersByEdition($edition_id, $onlyActive, $onlyVerified);
            $count = $this->Listener->countListeners($edition_id, $onlyActive, $onlyVerified);

            $this->set('edition', $edition);
            $this->set('records', $records);
            $this->set('count', $count);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    private function __sendEmailCertificate($to, $vars) {
        $email = new CakeEmail();
        $email->config('ufpr');
        $email->template('certificate');
        $email->emailFormat('html');
        $email->helpers(array('Html'));
        $email->viewVars($vars);
        $email->to($to);
        $email->subject(__('UFPR - Certificate'));
        $email->send();
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('home', 'verifyCertificate', 'getCertificate', 'details');
    }

    public function isAuthorized($user = NULL) {
        if (parent::isAuthorized($user)) {
            return true;
        }

        if ($this->action === 'signup') {
            return true;
        }

        return false;
    }
    
    
}
