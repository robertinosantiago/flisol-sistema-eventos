<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Teacher
 * @author robert
 */
class Teacher extends AppModel {

    public $actsAs = array('DateFormat', 'Certificable');
    public $belongsTo = array('Course');
    public $hasMany = array('TeacherUser');
    
    public function getTeacherById($id) {
        $options = array(
            'fields' => array('Teacher.id', 'Teacher.file_certificate', 'Teacher.fullname_position', 'Teacher.course_id', 'Teacher.has_back', 'Teacher.back_content'),
            'conditions' => array(
                'Teacher.id' => $id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function loadTeachersByCourse($course_id, $onlyActive = true, $onlyVerified = false) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.document', 'Teacher.id', 'Course.id', 'TeacherUser.id'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'teacher_users',
                    'alias' => 'TeacherUser',
                    'type' => 'inner',
                    'conditions' => array('Teacher.id = TeacherUser.teacher_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = TeacherUser.user_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'courses',
                    'alias' => 'Course',
                    'type' => 'inner',
                    'conditions' => array('Course.id = Teacher.course_id')
                )
            ),
            'conditions' => array(
                'User.deleted = 0',
                'Teacher.course_id' => $course_id
            ),
            'order' => array('User.fullname' => 'asc'),
            'recursive' => -1
        );

        if ($onlyActive) {
            $options['conditions']['User.active'] = true;
        }

        if ($onlyVerified) {
            $options['conditions']['User.verified'] = true;
        }

        return $this->find('all', $options);
    }

    public function countTeachers($course_id = NULL, $onlyActive = true, $onlyVerified = false) {
        $options = array(
            'fields' => array('COUNT(TeacherUser.id) AS quantity'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'teacher_users',
                    'alias' => 'TeacherUser',
                    'type' => 'inner',
                    'conditions' => array('Teacher.id = TeacherUser.teacher_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = TeacherUser.user_id')
                )
            ),
            'conditions' => array(
                'Teacher.course_id' => $course_id
            ),
            'recursive' => -1
        );
        
        if ($onlyActive) {
            $options['conditions']['User.active'] = true;
        }

        if ($onlyVerified) {
            $options['conditions']['User.verified'] = true;
        }

        $record = $this->find('first', $options);
        if ($record) {
            return $record[0]['quantity'];
        }
        return 0;
    }
    
    public function getInfoCertificate($id, $hash_code) {
        $return = array();
        $options = array(
            'fields' => array('User.fullname', 'Teacher.id', 'TeacherUser.hash_code', 'Edition.id', 'Edition.year', 'Course.id', 'Teacher.fullname_position', 'Teacher.has_back', 'Teacher.back_content'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'courses',
                    'alias' => 'Course',
                    'type' => 'inner',
                    'conditions' => array('Course.id = Teacher.course_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Course.edition_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'teacher_users',
                    'alias' => 'TeacherUser',
                    'type' => 'inner',
                    'conditions' => array('Teacher.id = TeacherUser.teacher_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = TeacherUser.user_id')
                )
            ),
            'conditions' => array(
                'Teacher.id' => $id,
                'TeacherUser.hash_code' => $hash_code,
                'Edition.show_certificate' => true
            ),
            'recursive' => -1
        );
        $record = $this->find('first', $options);
        if ($record) {
            $return['hash_code'] = $record['TeacherUser']['hash_code'];
            $return['fullname'] = $record['User']['fullname'];
            $return['year'] = $record['Edition']['year'];
            $return['fullname_position'] = $record['Teacher']['fullname_position'];
            $return['edition_id'] = $record['Edition']['id'];
            $return['course_id'] = $record['Course']['id'];
            $return['id'] = $record['Teacher']['id'];
            $return['has_back'] = $record['Teacher']['has_back'];
            $return['back_content'] = $record['Teacher']['back_content'];
        }
        return $return;
    }
    
}
