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
    
    
}
