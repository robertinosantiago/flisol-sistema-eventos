<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Presenter
 * @author robertino
 */
class Presenter extends AppModel {

    public $actsAs = array('DateFormat', 'Certificable');
    public $belongsTo = array('Edition');
    public $hasMany = array('PresenterUser');

    public function getPresenterById($id) {
        $options = array(
            'fields' => array('Presenter.id', 'Presenter.file_certificate', 'Presenter.fullname_position', 'Presenter.title_position', 'Presenter.edition_id', 'Presenter.has_back', 'Presenter.back_content'),
            'conditions' => array(
                'Presenter.id' => $id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }
    
    public function getPresenterByUser($user_id) {
        $options = array(
            'fields' => array('Edition.year', 'Edition.date_of', 'Presenter.id', 'PresenterUser.hash_code', 'PresenterUser.title'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'presenter_users',
                    'alias' => 'PresenterUser',
                    'type' => 'inner',
                    'conditions' => array('Presenter.id = PresenterUser.presenter_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Presenter.edition_id')
                )
            ),
            'conditions' => array(
                'PresenterUser.user_id' => $user_id,
                'Edition.show_certificate' => true
            ),
            'recursive' => -1
        );
        return $this->find('all', $options);
    }

    public function getInfoCertificate($id, $hash_code) {
        $return = array();
        $options = array(
            'fields' => array('User.fullname', 'Presenter.id', 'PresenterUser.hash_code', 'Edition.id', 'Edition.year', 'Presenter.fullname_position', 'Presenter.title_position', 'PresenterUser.title', 'Presenter.has_back', 'Presenter.back_content'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Presenter.edition_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'presenter_users',
                    'alias' => 'PresenterUser',
                    'type' => 'inner',
                    'conditions' => array('Presenter.id = PresenterUser.presenter_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = PresenterUser.user_id')
                )
            ),
            'conditions' => array(
                'Presenter.id' => $id,
                'PresenterUser.hash_code' => $hash_code,
                'Edition.show_certificate' => true
            ),
            'recursive' => -1
        );
        $record = $this->find('first', $options);
        if ($record) {
            $return['hash_code'] = $record['PresenterUser']['hash_code'];
            $return['fullname'] = $record['User']['fullname'];
            $return['year'] = $record['Edition']['year'];
            $return['title_presentation'] = $record['PresenterUser']['title'];
            $return['fullname_position'] = $record['Presenter']['fullname_position'];
            $return['title_position'] = $record['Presenter']['title_position'];
            $return['edition_id'] = $record['Edition']['id'];
            $return['id'] = $record['Presenter']['id'];
            $return['has_back'] = $record['Presenter']['has_back'];
            $return['back_content'] = $record['Presenter']['back_content'];
        }
        return $return;
    }

    public function loadPresentersByEdition($edition_id, $onlyActive = true) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.document', 'Presenter.id', 'Edition.id', 'PresenterUser.id', 'PresenterUser.title'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'presenter_users',
                    'alias' => 'PresenterUser',
                    'type' => 'inner',
                    'conditions' => array('Presenter.id = PresenterUser.presenter_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = PresenterUser.user_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Presenter.edition_id')
                )
            ),
            'conditions' => array(
                'User.deleted = 0',
                'Presenter.edition_id' => $edition_id
            ),
            'order' => array('User.fullname' => 'asc'),
            'recursive' => -1
        );
        
        if ($onlyActive) {
            $options['conditions']['User.active'] = true;
        }
        
        return $this->find('all', $options);
    }

    public function countPresenters($id = NULL, $onlyActive = true) {
        $options = array(
            'fields' => array('COUNT(PresenterUser.id) AS quantity'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'presenter_users',
                    'alias' => 'PresenterUser',
                    'type' => 'inner',
                    'conditions' => array('Presenter.id = PresenterUser.presenter_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = PresenterUser.user_id')
                )
            ),
            'conditions' => array(
                'Presenter.edition_id' => $id
            ),
            'recursive' => -1
        );
        
        if ($onlyActive) {
            $options['conditions']['User.active'] = true;
        }

        $record = $this->find('first', $options);
        if ($record) {
            return $record[0]['quantity'];
        }
        return 0;
    }

}
