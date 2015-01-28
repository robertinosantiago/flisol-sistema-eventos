<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP ListenerUser
 * @author robertino
 */
class ListenerUser extends AppModel {
    
    public $belongsTo = array('User', 'Listener');
    
    public function getListenerUser($listener_id, $user_id) {
        $options = array(
            'fields' => array('ListenerUser.id', 'ListenerUser.attended', 'ListenerUser.hash_code'),
            'conditions' => array(
                'ListenerUser.listener_id' => $listener_id,
                'ListenerUser.user_id' => $user_id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }
    
    public function beforeSave($options = array()) {
        if (array_key_exists('id', $this->data['ListenerUser']) && empty($this->data['ListenerUser']['id'])) {
            $date = new DateTime('now');
            $hasher = new HmacPasswordHasher();
            $this->data['ListenerUser']['hash_code'] = $hasher->hash(rand() . $date->format('YmdHis'));
        }
        return parent::beforeSave($options);
    }
    
}
