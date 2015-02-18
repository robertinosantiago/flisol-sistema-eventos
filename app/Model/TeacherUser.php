<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP TeacherUser
 * @author robert
 */
class TeacherUser extends AppModel {
    
    public $actsAs = array('Verificable');
    public $belongsTo = array('User', 'Teacher');
    
    public function getTeacherUser($teacher_id, $user_id) {
        $options = array(
            'fields' => array('TeacherUser.id', 'TeacherUser.hash_code'),
            'conditions' => array(
                'TeacherUser.teacher_id' => $teacher_id,
                'TeacherUser.user_id' => $user_id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }
    
}
