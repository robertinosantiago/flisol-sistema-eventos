<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * CakePHP Events
 * @author robertino
 */
class EventsController extends AppController {

    public $uses = array('Event', 'User', 'Coordinator', 'CoordinatorUser', 'Presenter', 'PresenterUser', 'Listener', 'ListenerUser');
    public $helpers = array('SearchBox');
    public $components = array('Session', 'Crud', 'RequestHandler');
    public $paginate = array();

    public function index() {
        $this->setTitle(__('Events'));
        $this->Session->write('urlBack', $this->request->here());

        $this->paginate = $this->Event->optionsPaginate();

        $query = null;
        if (isset($this->params->query['query'])) {
            $query = $this->params->query['query'];
            $this->termOfSearch($query, array('Event.title'));
        }
        $this->set('query', $query);

        $records = $this->paginate('Event');
        $this->set('records', $records);
    }

    public function home() {
        $this->setTitle(__('Events'));

        $events = $this->Event->getActiveEvents();
        $nextEvents = $this->Event->getNextEvents();

        $this->set('events', $events);
        $this->set('nextEvents', $nextEvents);
    }

    public function signup($id = null) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }

        $event = $this->Event->getEvent($id);
        $this->set('event', $event);


        $user = $this->Auth->user();

        if ($this->Event->isRegistered($id, $user['id'])) {
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

    public function details($id = null) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }

        $event = $this->Event->getEvent($id);
        $presenters = $this->Presenter->loadPresentersByEvent($id);

        $this->set('event', $event);
        $this->set('presenters', $presenters);

        $this->setTitle($event['Event']['title']);
        $this->set('description_for_layout', $event['Event']['description']);
    }

    public function form() {
        $this->setTitle(__('Event'));
        $this->Session->write('urlBack', $this->referer());
    }

    public function save($id = null) {
        $this->Crud->saveData($this->Event, $this->request->data);
    }

    public function saveFiles($id = null) {
        $this->Event->create();
        if ($this->Event->saveAll($this->request->data, array('validate' => 'first'))) {
            $this->Session->setFlash(__('Successfully saved'), 'flash_success');
            return $this->redirect($this->Session->read('urlBack'));
        } else {
            $this->Session->setFlash(__('Unable to save the record'), 'flash_error');
            $this->render('/Events/update');
        }
    }

    public function update($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->setTitle(__('Event'));
        $this->Crud->loadData($this->Event, $id, false);
        $this->set('event_id', $this->request->data['Event']['id']);
        $this->set('showButtonCoordinator', (empty($this->request->data['Coordinator']['file_certificate']) ? false : true));
        $this->set('showButtonPresenter', (empty($this->request->data['Presenter']['file_certificate']) ? false : true));
    }

    public function delete($id = null) {
        $this->Crud->deleteData($this->Event, $id);
    }

    public function status($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->Crud->updateStatus($this->Event, $id);
    }

    public function deleteMany() {
        $this->Crud->deleteMany($this->Serie, $this->request->data);
    }

    public function showCertificates($id = null) {
        $this->Session->write('urlBack', $this->referer());
        if ($this->request->is('post')) {
            $options = array('fields' => array('Event.id', 'Event.show_certificate'), 'conditions' => array('Event.' . $this->Event->primaryKey => $id));
            $registry = $this->Event->find('first', $options);
            $registry['Event']['show_certificate'] = !$registry['Event']['show_certificate'];
            if ($this->Event->saveAll($registry, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Successfully updated'), 'flash_success');
            }
        }
        return $this->redirect($this->Session->read('urlBack'));
    }

    public function peoples($id = null) {
        $this->setTitle(__('Event'));
        $this->Session->write('urlBack', $this->referer());

        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Record not found'));
        }

        $event = $this->Event->getEvent($id);
        $coordinators = $this->Coordinator->loadCoordinatorsByEvent($event['Event']['id']);
        $presenters = $this->Presenter->loadPresentersByEvent($event['Event']['id']);
        $listeners = $this->Listener->loadListenersByEvent($event['Event']['id']);

        $this->set('event', $event);
        $this->set('coordinators', $coordinators);
        $this->set('presenters', $presenters);
        $this->set('listeners', $listeners);

        $this->set('totalOfCoordinators', $this->Coordinator->countCoordinators($event['Event']['id']));
        $this->set('totalOfPresenters', $this->Presenter->countPresenters($event['Event']['id']));
        $this->set('totalOfListeners', $this->Listener->countListeners($event['Event']['id']));
    }

    public function addCoordinatorUser() {
        $this->Session->write('urlBack', $this->referer());
        $this->__addUserOnEvent($this->CoordinatorUser, $this->Coordinator, 'coordinator_id');
    }

    public function deleteCoordinatorUser($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->__deleteUserOnEvent($this->CoordinatorUser, $id);
    }

    public function addPresenterUser() {
        $this->Session->write('urlBack', $this->referer());
        $this->__addUserOnEvent($this->PresenterUser, $this->Presenter, 'presenter_id');
    }

    public function deletePresenterUser($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->__deleteUserOnEvent($this->PresenterUser, $id);
    }

    public function addListenerUser() {
        $this->Session->write('urlBack', $this->referer());
        $this->__addUserOnEvent($this->ListenerUser, $this->Listener, 'listener_id');
    }

    public function deleteListenerUser($id = null) {
        $this->Session->write('urlBack', $this->referer());
        $this->__deleteUserOnEvent($this->ListenerUser, $id);
    }

    private function __addUserOnEvent($modelEventUser, $modelUser, $fieldNameUser) {
        $user_id = $this->request->data[$modelEventUser->name]['id'];
        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('User not found'));
        }
        $record_id = $this->request->data[$modelEventUser->name][$fieldNameUser];
        if (!$modelUser->exists($record_id)) {
            throw new NotFoundException(__('Record not found'));
        }
        $data = array($modelEventUser->name => array('id' => null, 'user_id' => $user_id, $fieldNameUser => $record_id));
        if ($modelEventUser->name === 'PresenterUser') {
            $data[$modelEventUser->name]['title'] = $this->request->data[$modelEventUser->name]['title'];
        }
        $modelEventUser->create();
        try {
            if ($modelEventUser->saveAll($data)) {
                $this->Session->setFlash(__('Successfully added'), 'flash_success');
            }
        } catch (Exception $exc) {
            $this->Session->setFlash(__('Unable to add this user'), 'flash_error');
        }
        return $this->redirect($this->Session->read('urlBack'));
    }

    private function __deleteUserOnEvent($modelEventUser, $id) {
        if ($this->request->is('post')) {
            if ($modelEventUser->delete($id)) {
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
        if (!$this->Event->exists($id)) {
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
        if (!$this->Event->exists($id)) {
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
        if (!$this->Event->exists($id)) {
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
            return $this->redirect(array('controller' => 'Events', 'action' => 'home'));
        }

        if (!$record) {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Events', 'action' => 'home'));
        }

        $this->pdfConfig = array(
            'orientation' => 'landscape'
        );
        $base64 = null;

        if ($typeUser == 'listener') {
            $base64 = $this->Listener->base64_file($record['event_id']);
        } else if ($typeUser == 'coordinator') {
            $base64 = $this->Coordinator->base64_file($record['event_id']);
        } else if ($typeUser == 'presenter') {
            $base64 = $this->Presenter->base64_file($record['event_id']);
        } else {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Events', 'action' => 'home'));
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

            $base64 = $this->Coordinator->base64_file($coordinator['Coordinator']['event_id']);

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
            $event = $this->Event->getEventByCoordinator($coordinator_id);

            $vars = array();
            $vars['type'] = 'coordinator';
            $vars['fullname'] = $user['User']['fullname'];
            $vars['id'] = $coordinator_id;
            $vars['hash_code'] = $coordinatorUser['CoordinatorUser']['hash_code'];
            $vars['event'] = $event['Event']['title'];

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

            $base64 = $this->Presenter->base64_file($presenter['Presenter']['event_id']);

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
            $event = $this->Event->getEventByPresenter($presenter_id);

            $vars = array();
            $vars['type'] = 'presenter';
            $vars['fullname'] = $user['User']['fullname'];
            $vars['id'] = $presenter_id;
            $vars['hash_code'] = $presenterUser['PresenterUser']['hash_code'];
            $vars['event'] = $event['Event']['title'];

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

            $base64 = $this->Listener->base64_file($listener['Listener']['event_id']);

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
            $event = $this->Event->getEventByListener($listener_id);

            $vars = array();
            $vars['type'] = 'listener';
            $vars['fullname'] = $user['User']['fullname'];
            $vars['id'] = $listener_id;
            $vars['hash_code'] = $listenerUser['ListenerUser']['hash_code'];
            $vars['event'] = $event['Event']['title'];

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
            return $this->redirect(array('controller' => 'Events', 'action' => 'home'));
        }

        if (!$record) {
            $this->Session->setFlash(__('Invalid certificate'), 'flash_error');
            return $this->redirect(array('controller' => 'Events', 'action' => 'home'));
        }

        $this->set('record', $record);
    }

    public function reportCoordinador() {
        $this->Session->write('urlBack', $this->referer());

        $event_id = $this->request->data['Event']['id'];

        if (!$this->Event->exists($event_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $onlyActive = $this->request->data['onlyActive'];
            $event = $this->Event->getEvent($event_id);
            $records = $this->Coordinator->loadCoordinatorsByEvent($event_id, $onlyActive);
            $count = $this->Coordinator->countCoordinators($event_id, $onlyActive);

            $this->set('event', $event);
            $this->set('records', $records);
            $this->set('count', $count);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    public function reportPresenter() {
        $this->Session->write('urlBack', $this->referer());

        $event_id = $this->request->data['Event']['id'];

        if (!$this->Event->exists($event_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $onlyActive = $this->request->data['onlyActive'];
            $event = $this->Event->getEvent($event_id);
            $records = $this->Presenter->loadPresentersByEvent($event_id, $onlyActive);
            $count = $this->Presenter->countPresenters($event_id, $onlyActive);

            $this->set('event', $event);
            $this->set('records', $records);
            $this->set('count', $count);
        } else {
            return $this->redirect($this->Session->read('urlBack'));
        }
    }

    public function reportListener() {
        $this->Session->write('urlBack', $this->referer());

        $event_id = $this->request->data['Event']['id'];

        if (!$this->Event->exists($event_id)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->request->is('post')) {
            $onlyActive = $this->request->data['onlyActive'];
            $onlyVerified = $this->request->data['onlyVerified'];
            $event = $this->Event->getEvent($event_id);
            $records = $this->Listener->loadListenersByEvent($event_id, $onlyActive, $onlyVerified);
            $count = $this->Listener->countListeners($event_id, $onlyActive, $onlyVerified);

            $this->set('event', $event);
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
