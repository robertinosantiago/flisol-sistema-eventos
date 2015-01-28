<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('Component', 'Controller');

/**
 * Description of CrudComponent
 *
 * @author robert
 */
class CrudComponent extends Component {

    public $components = array('Session');
    private $controller;

    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }

    public function saveData($model = null, $data = array()) {
        if ($this->controller->request->is('post')) {
            $model->create();
            if ($model->saveAll($data, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Successfully saved'), 'flash_success');
                return $this->controller->redirect($this->Session->read('urlBack'));
            } else {
                $this->Session->setFlash(__('Unable to save the record'), 'flash_error');
                $this->controller->render('/' . $this->controller->name . '/form');
                
            }
        } else {
            return $this->controller->redirect($this->Session->read('urlBack'));
        }
    }

    public function loadData($model = null, $primaryKey = null, $renderForm = true) {
        if (!$model->exists($primaryKey)) {
            throw new NotFoundException(__('Record not found'));
        }
        if ($this->controller->request->is('post')) {
            $options = array('conditions' => array($model->name . '.' . $model->primaryKey => $primaryKey));
            $this->controller->request->data = $model->find('first', $options);
            if ($renderForm) {
                $this->controller->render('/' . $this->controller->name . '/form');
            }
        } else {
            return $this->controller->redirect($this->Session->read('urlBack'));
        }
    }

    public function deleteData($model = null, $primaryKey = null) {
        if (!$model->exists($primaryKey)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->controller->request->is('post')) {
            $options = array('fields' => array($model->name .'.id', $model->name . '.deleted'), 'conditions' => array($model->name . '.' . $model->primaryKey => $primaryKey));
            $registry = $model->find('first', $options);
            $registry[$model->name]['deleted'] = 1;
            if ($model->saveAll($registry, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Successfully deleted'), 'flash_success');
            }
        }
        return $this->controller->redirect(array('action' => 'index'));
    }

    public function updateStatus($model = null, $primaryKey = null) {
        if (!$model->exists($primaryKey)) {
            throw new NotFoundException(__('Record not found'));
        }

        if ($this->controller->request->is('post')) {
            $options = array('fields' => array($model->name .'.id', $model->name . '.active'), 'conditions' => array($model->name . '.' . $model->primaryKey => $primaryKey));
            $registry = $model->find('first', $options);
            $registry[$model->name]['active'] = !$registry[$model->name]['active'];
            if ($model->saveAll($registry, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Successfully updated'), 'flash_success');
            }
        }
        return $this->controller->redirect($this->Session->read('urlBack'));
    }

    public function deleteMany($model = null, $data = array()) {
        $erro = array();
        if ($this->controller->request->is('post')) {
            foreach ($data['Records']['id'] as $key => $value) {
                $options = array('conditions' => array($model->name . '.' . $model->primaryKey => $value));
                $registry = $model->find('first', $options);
                $registry[$model->name]['deleted'] = 1;
                if (!$model->saveAll($registry, array('validate' => 'first'))) {
                    $erro[count($erro)] = $value;
                }
            }
            if (count($erro) == 0) {
                $this->Session->setFlash(__("Successfully deleted"), 'flash_success');
            } else {
                $this->Session->setFlash(__("An error occurred while deleting the following records: %s", implode(",", $erro)), 'flash_error');
            }
        }
        $this->controller->redirect(array('action' => 'index'));
    }

}
