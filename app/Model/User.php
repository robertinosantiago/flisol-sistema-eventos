<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');
App::uses('HmacPasswordHasher', 'Controller/Component/Auth');

/**
 * CakePHP User
 * @author robertino
 */
class User extends AppModel {

    public $validate = array(
        'fullname' => array('rule' => 'notEmpty'),
        'email' => array(
            'required' => array(
                'rule' => 'notEmpty'
            ),
            'email' => array('rule' => 'email'),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create'
            )
        ),
        'password' => array('rule' => 'notEmpty'),
        'document' => array('rule' => 'notEmpty')
    );

    public function getUserById($id) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.email', 'User.verified', 'User.document', 'User.hash_code_verified'),
            'conditions' => array(
                'User.deleted = 0',
                'User.id' => $id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getUserByEmailAndPassword($email, $password) {
        $hasher = new HmacPasswordHasher();
        
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.email'),
            'conditions' => array(
                'User.deleted = 0',
                'User.email' => $email,
                'User.password' => $hasher->hash($password)
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getUserByHashCode($hash_code) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.email', 'User.verified'),
            'conditions' => array(
                'User.deleted = 0',
                'User.hash_code_verified' => $hash_code
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getUsersByFullname($fullname = null) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.document'),
            'conditions' => array(
                'User.deleted = 0',
                'User.fullname LIKE' => '%' . $fullname . '%'
            ),
            'recursive' => -1
        );
        $records = $this->find('all', $options);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                'id' => $record['User']['id'],
                'fullname' => $record['User']['fullname'],
                'document' => $record['User']['document']
            );
        }
        return $data;
    }

    public function getUserByEmail($email) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.email', 'User.password'),
            'conditions' => array(
                'User.deleted = 0',
                'User.email' => $email
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function beforeSave($options = array()) {
        $hasher = new HmacPasswordHasher();

        if (isset($this->data['User']['password']) && !empty($this->data['User']['password'])) {
            $this->data['User']['password'] = $hasher->hash($this->data['User']['password']);
        }

        if (isset($this->data['User']['id']) && empty($this->data['User']['id'])) {
            $date = new DateTime('now');
            $this->data['User']['hash_code_verified'] = $hasher->hash(rand() . $date->format('YmdHisu'));
        }

        return parent::beforeSave();
    }

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $value) {
            if (isset($value['User']['verified'])) {
                $results[$key]['User']['verifiedText'] = ($results[$key]['User']['verified'] ? __('Yes') : __('No'));
            }
            if (isset($value['User']['active'])) {
                $results[$key]['User']['activeText'] = ($results[$key]['User']['active'] ? __('Yes') : __('No'));
            }
        }
        return parent::afterFind($results, $primary);
    }

    public function optionsPaginate() {
        $options = array(
            'limit' => 25,
            'fields' => array('User.id', 'User.fullname', 'User.document', 'User.verified', 'User.active', 'User.role'),
            'conditions' => array('User.deleted = 0'),
            'order' => array('User.role' => 'asc', 'User.fullname' => 'asc')
        );
        return $options;
    }

}
