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
    
    public $uses = array('Edition');
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
    }
    
    public function form() {
        $this->setTitle(__('Edition'));
        $this->Session->write('urlBack', $this->referer());
    }

    public function save($id = null) {
        $this->Crud->saveData($this->Edition, $this->request->data);
    }
    
    
}
