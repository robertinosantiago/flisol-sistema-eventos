<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Course
 * @author robert
 */
class Course extends AppModel {
    
    public $actsAs = array('DateFormat', 'Certificable');
    public $belongsTo = array('Edition');
    public $hasOne  = array('Teacher', 'Student');
    
    
    public function loadCoursesByEdition($edition_id) {
        $options = array(
            'fields' => array('Course.id', 'Course.title', 'Course.hours', 'Edition.id'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Course.edition_id')
                )
            ),
            'conditions' => array(
                'Course.edition_id' => $edition_id
            ),
            'order' => array('Course.title' => 'asc'),
            'recursive' => -1
        );

        return $this->find('all', $options);
    }
    
    
}
