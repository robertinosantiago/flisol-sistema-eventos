<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP PresenterUser
 * @author robertino
 */
class PresenterUser extends AppModel {
    
    public $actsAs = array('Verificable');
    public $belongsTo = array('User', 'Presenter');
    
    public function getPresenterUser($presenter_id, $user_id) {
        $options = array(
            'fields' => array('PresenterUser.id', 'PresenterUser.title', 'PresenterUser.hash_code'),
            'conditions' => array(
                'PresenterUser.presenter_id' => $presenter_id,
                'PresenterUser.user_id' => $user_id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }
    
}
