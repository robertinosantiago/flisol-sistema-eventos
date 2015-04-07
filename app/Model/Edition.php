<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');
App::uses('DateFormatBehavior', 'Model/Behavior');

/**
 * CakePHP Edition
 * @author robertino
 */
class Edition extends AppModel {

    //public $actsAs = array('DateFormat');
    public $hasOne = array('Listener', 'Coordinator', 'Presenter');
    public $hasMany = array('Course');
    public $validate = array(
        'year' => array('rule' => 'notEmpty', 'required' => 'create'),
        'registration_begin' => array('rule' => 'notEmpty', 'required' => 'create'),
        'registration_end' => array('rule' => 'notEmpty', 'required' => 'create'),
        'date_of' => array('rule' => 'notEmpty', 'required' => 'create')
    );
    public $virtualFields = array(
        'registration' => 'CONCAT(DATE_FORMAT(Edition.registration_begin, "%d/%m/%Y"), " - ", DATE_FORMAT(Edition.registration_end, "%d/%m/%Y"))'
    );

    public function optionsPaginate() {
        $options = array(
            'limit' => 25,
            'fields' => array('Edition.id', 'Edition.year', 'Edition.registration', 'Edition.date_of', 'Edition.active', 'Edition.show_certificate'),
            'conditions' => array('Edition.deleted = 0'),
            'order' => array('Edition.date_of' => 'asc', 'Edition.title' => 'asc')
        );
        return $options;
    }

    public function getEdition($id = null) {
        $options = array(
            'fields' => array('Edition.id', 'Edition.year', 'Presenter.id', 'Listener.id', 'Coordinator.id', 'Edition.registration', 'Edition.date_of', 'Edition.show_certificate'),
            'conditions' => array('Edition.deleted = 0', 'Edition.id' => $id)
        );
        return $this->find('first', $options);
    }

    public function getEditionByListener($listener_id) {
        $options = array(
            'fields' => array('Edition.id', 'Edition.year'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'listeners',
                    'alias' => 'Listener',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Listener.edition_id')
                )
            ),
            'conditions' => array('Listener.id' => $listener_id),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getEditionByPresenter($presenter_id) {
        $options = array(
            'fields' => array('Edition.id', 'Edition.year'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'presenters',
                    'alias' => 'Presenter',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Presenter.edition_id')
                )
            ),
            'conditions' => array('Presenter.id' => $presenter_id),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getEditionByCoordinator($coordinator_id) {
        $options = array(
            'fields' => array('Edition.id', 'Edition.year'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'coordinators',
                    'alias' => 'Coordinator',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Coordinator.edition_id')
                )
            ),
            'conditions' => array('Coordinator.id' => $coordinator_id),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getEditionsActualYear() {
        $today = new DateTime();
        $year = $today->format('Y-m-d');
        $options = array(
            'fields' => array('Edition.id', 'Edition.year', 'Edition.registration', 'Edition.date_of'),
            'conditions' => array(
                'Edition.year =' => $year,
                'Edition.deleted = 0',
                'Edition.active = 1'
            ),
            'order' => array(
                'Edition.registration_end' => 'asc',
                'Edition.date_of' => 'asc',
                'Edition.year' => 'asc'
            ),
            'recursive' => -1
        );
        return $this->find('all', $options);
    }

    public function isRegistered($edition_id, $user_id) {
        $options = array(
            'fields' => array('Edition.id'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'listeners',
                    'alias' => 'Listener',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Listener.edition_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'listener_users',
                    'alias' => 'ListenerUser',
                    'type' => 'inner',
                    'conditions' => array('Listener.id = ListenerUser.listener_id')
                )
            ),
            'conditions' => array(
                'Listener.edition_id' => $edition_id,
                'ListenerUser.user_id' => $user_id
            ),
            'recursive' => -1
        );

        $record = $this->find('all', $options);

        if (empty($record)) {
            return false;
        }
        return true;
    }
    
    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $value) {
            if (isset($value['Edition']['active'])) {
                $results[$key]['Edition']['activeText'] = ($results[$key]['Edition']['active'] ? __('Yes') : __('No'));
            }
            if (isset($value['Edition']['show_certificate'])) {
                $results[$key]['Edition']['showCertificateText'] = ($results[$key]['Edition']['show_certificate'] ? __('Yes') : __('No'));
            }
            if (isset($value['Edition']['date_of'])) {
                $formater = new DateFormatBehavior();
                $results[$key]['Edition']['dateText'] = $formater->dateFormat($value['Edition']['date_of']);
            }
        }
        return parent::afterFind($results, $primary);
    }

}
