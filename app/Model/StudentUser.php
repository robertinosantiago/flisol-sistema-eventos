<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP StudentUser
 * @author robert
 */
class StudentUser extends AppModel {
    
    public $actsAs = array('Verificable');
    public $belongsTo = array('User', 'Student');
    
    public function getStudentUser($student_id, $user_id) {
        $options = array(
            'fields' => array('StudentUser.id', 'StudentUser.hash_code'),
            'conditions' => array(
                'StudentUser.student_id' => $student_id,
                'StudentUser.user_id' => $user_id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }
    
    /**
     * Check if a user is registered in a course as a student
     * @param int $course_id
     * @param int $user_id
     * @return boolean
     */
    public function isRegistered($course_id, $user_id) {
        $options = array(
            'fields' => array('StudentUser.id'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'students',
                    'alias' => 'Student',
                    'type' => 'inner',
                    'conditions' => 'Student.id = StudentUser.student_id'
                )
            ),
            'conditions' => array(
                'Student.course_id' => $course_id,
                'StudentUser.user_id' => $user_id
            ),
            'recursive' => -1
        );
        
        $record = $this->find('first', $options);
        
        if (!empty($record)) {
            return true;
        }
        
        return false;
    }
    
}
