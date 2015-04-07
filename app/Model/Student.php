<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Student
 * @author robert
 */
class Student extends AppModel {

    public $actsAs = array('DateFormat', 'Certificable');
    public $belongsTo = array('Course');
    public $hasMany = array('TeacherUser');

    public function getStudentById($id) {
        $options = array(
            'fields' => array('Student.id', 'Student.file_certificate', 'Student.fullname_position', 'Student.course_id', 'Student.has_back', 'Student.back_content'),
            'conditions' => array(
                'Student.id' => $id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function loadStudentsByCourse($course_id, $onlyActive = true, $onlyVerified = false) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.document', 'Student.id', 'Course.id', 'StudentUser.id', 'StudentUser.attended'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'student_users',
                    'alias' => 'StudentUser',
                    'type' => 'inner',
                    'conditions' => array('Student.id = StudentUser.student_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = StudentUser.user_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'courses',
                    'alias' => 'Course',
                    'type' => 'inner',
                    'conditions' => array('Course.id = Student.course_id')
                )
            ),
            'conditions' => array(
                'User.deleted = 0',
                'Student.course_id' => $course_id
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

    public function countStudents($course_id = NULL, $onlyActive = true, $onlyVerified = false) {
        $options = array(
            'fields' => array('COUNT(StudentUser.id) AS quantity'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'student_users',
                    'alias' => 'StudentUser',
                    'type' => 'inner',
                    'conditions' => array('Student.id = StudentUser.student_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = StudentUser.user_id')
                )
            ),
            'conditions' => array(
                'Student.course_id' => $course_id
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
            'fields' => array('User.fullname', 'Student.id', 'StudentUser.hash_code', 'Edition.id', 'Edition.year', 'Course.id', 'Student.fullname_position', 'Student.has_back', 'Student.back_content'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'courses',
                    'alias' => 'Course',
                    'type' => 'inner',
                    'conditions' => array('Course.id = Student.course_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Course.edition_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'student_users',
                    'alias' => 'StudentUser',
                    'type' => 'inner',
                    'conditions' => array('Student.id = StudentUser.student_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = StudentUser.user_id')
                )
            ),
            'conditions' => array(
                'Student.id' => $id,
                'StudentUser.hash_code' => $hash_code,
                'Edition.show_certificate' => true
            ),
            'recursive' => -1
        );
        $record = $this->find('first', $options);
        if ($record) {
            $return['hash_code'] = $record['StudentUser']['hash_code'];
            $return['fullname'] = $record['User']['fullname'];
            $return['year'] = $record['Edition']['year'];
            $return['fullname_position'] = $record['Student']['fullname_position'];
            $return['edition_id'] = $record['Edition']['id'];
            $return['course_id'] = $record['Course']['id'];
            $return['id'] = $record['Student']['id'];
            $return['has_back'] = $record['Student']['has_back'];
            $return['back_content'] = $record['Student']['back_content'];
        }
        return $return;
    }

}
