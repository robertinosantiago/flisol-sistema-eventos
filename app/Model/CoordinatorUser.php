<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');
App::uses('HmacPasswordHasher', 'Controller/Component/Auth');

/**
 * CakePHP CoordinatorUser
 * @author robertino
 */
class CoordinatorUser extends AppModel {

    public $belongsTo = array('User', 'Coordinator');
    
    public function getCoordinatorUser($coordinator_id, $user_id) {
        $options = array(
            'fields' => array('CoordinatorUser.id', 'CoordinatorUser.hash_code'),
            'conditions' => array(
                'CoordinatorUser.coordinator_id' => $coordinator_id,
                'CoordinatorUser.user_id' => $user_id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }
    
    public function getCoordinatorUserById($id) {
        $options = array(
            'fields' => array('CoordinatorUser.id'),
            'conditions' => array('CoordinatorUser.id' => $id),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function beforeSave($options = array()) {
        if (array_key_exists('id', $this->data['CoordinatorUser']) && empty($this->data['CoordinatorUser']['id'])) {
            $date = new DateTime('now');
            $hasher = new HmacPasswordHasher();
            $this->data['CoordinatorUser']['hash_code'] = $hasher->hash(rand() . $date->format('YmdHis'));
        }
        return parent::beforeSave($options);
    }

}
