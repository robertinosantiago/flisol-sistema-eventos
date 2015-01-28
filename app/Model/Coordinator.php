<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Coordinator
 * @author robertino
 */
class Coordinator extends AppModel {

    public $actsAs = array('DateFormat');
    public $belongsTo = array('Edition');
    public $hasMany = array('CoordinatorUser');
    
    public function getCoordinatorById($id) {
        $options = array(
            'fields' => array('Coordinator.id', 'Coordinator.file_certificate', 'Coordinator.fullname_position', 'Coordinator.edition_id', 'Coordinator.has_back', 'Coordinator.back_content'),
            'conditions' => array(
                'Coordinator.id' => $id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }
    
    public function getCoordinatorByUser($user_id) {
        $options = array(
            'fields' => array('Edition.year', 'Edition.date_of', 'Coordinator.id', 'CoordinatorUser.hash_code'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'coordinator_users',
                    'alias' => 'CoordinatorUser',
                    'type' => 'inner',
                    'conditions' => array('Coordinator.id = CoordinatorUser.coordinator_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Coordinator.edition_id')
                )
            ),
            'conditions' => array(
                'CoordinatorUser.user_id' => $user_id,
                'Edition.show_certificate' => true
            ),
            'recursive' => -1
        );
        return $this->find('all', $options);
    }
    
    public function getInfoCertificate($id, $hash_code) {
        $return = array();
        $options = array(
            'fields' => array('User.fullname', 'Coordinator.id', 'CoordinatorUser.hash_code', 'Edition.id', 'Edition.year', 'Coordinator.fullname_position', 'Coordinator.has_back', 'Coordinator.back_content'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Coordinator.edition_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'coordinator_users',
                    'alias' => 'CoordinatorUser',
                    'type' => 'inner',
                    'conditions' => array('Coordinator.id = CoordinatorUser.coordinator_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = CoordinatorUser.user_id')
                )
            ),
            'conditions' => array(
                'Coordinator.id' => $id,
                'CoordinatorUser.hash_code' => $hash_code,
                'Edition.show_certificate' => true
            ),
            'recursive' => -1
        );
        $record = $this->find('first', $options);
        if ($record) {
            $return['hash_code'] = $record['CoordinatorUser']['hash_code'];
            $return['fullname'] = $record['User']['fullname'];
            $return['year'] = $record['Edition']['year'];
            $return['fullname_position'] = $record['Coordinator']['fullname_position'];
            $return['edition_id'] = $record['Edition']['id'];
            $return['id'] = $record['Coordinator']['id'];
            $return['has_back'] = $record['Coordinator']['has_back'];
            $return['back_content'] = $record['Coordinator']['back_content'];
        }
        return $return;
    }

    public function loadCoordinatorsByEdition($edition_id, $onlyActive = true) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.document', 'Coordinator.id', 'Edition.id', 'CoordinatorUser.id'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'coordinator_users',
                    'alias' => 'CoordinatorUser',
                    'type' => 'inner',
                    'conditions' => array('Coordinator.id = CoordinatorUser.coordinator_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = CoordinatorUser.user_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'editions',
                    'alias' => 'Edition',
                    'type' => 'inner',
                    'conditions' => array('Edition.id = Coordinator.edition_id')
                )
            ),
            'conditions' => array(
                'User.deleted = 0',
                'Coordinator.edition_id' => $edition_id,
            ),
            'order' => array('User.fullname' => 'asc'),
            'recursive' => -1
        );
        
        if ($onlyActive) {
            $options['conditions']['User.active'] = true;
        }
        
        return $this->find('all', $options);
    }

    public function countCoordinators($id = NULL, $onlyActive = true) {
        $options = array(
            'fields' => array('COUNT(CoordinatorUser.id) AS quantity'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'coordinator_users',
                    'alias' => 'CoordinatorUser',
                    'type' => 'inner',
                    'conditions' => array('Coordinator.id = CoordinatorUser.coordinator_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = CoordinatorUser.user_id')
                )
            ),
            'conditions' => array(
                'Coordinator.edition_id' => $id,
            ),
            'recursive' => -1
        );
        
        if ($onlyActive) {
            $options['conditions']['User.active'] = true;
        }

        $record = $this->find('first', $options);
        if ($record) {
            return $record[0]['quantity'];
        }
        return 0;
    }
    
    public function base64_file($edition_id) {
        $options = array(
            'fields' => array('Coordinator.file_certificate'),
            'conditions' => array('Coordinator.edition_id' => $edition_id),
            'recursive' => -1
        );
        $record = $this->find('first', $options);
        if ($record) {
            $path = APP . 'Certificates'. DS . $record['Coordinator']['file_certificate'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }
        return false;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data['Coordinator']['file_certificate']) && !empty($this->data['Coordinator']['file_certificate']) && $this->data['Coordinator']['file_certificate']['error'] == 0) {
            $this->data['Coordinator']['file_certificate'] = $this->upload($this->data['Coordinator']['edition_id'], $this->data['Coordinator']['file_certificate']);
        } else {
           unset($this->data['Coordinator']['file_certificate']); 
        }
        
        if (isset($this->data['Coordinator']['fullname_position']) && !empty($this->data['Coordinator']['fullname_position'])) {
            
        }
        
        return parent::beforeSave($options);
    }

    private function upload($edition_id, $image = array(), $directory = 'Certificates') {
        $directory = APP . $directory . DS;

        if ($image['error'] != 0 && $image['size'] == 0) {
            throw new Exception(__('File not sent to server'));
        }

        $this->verifyDirectory($directory);

        $image = $this->verifyName($edition_id, $image, $directory);

        $this->moveFile($image, $directory);

        return $image['name'];
    }

    private function verifyDirectory($directory) {
        App::uses('Folder', 'Utility');
        $folder = new Folder();
        if (!is_dir($directory)) {
            $folder->create($directory);
        }
    }

    private function verifyName($edition_id, $image, $directory) {
        $extension = $this->getExtension($image);
        $image_info = pathinfo($directory . 'edition-' . $edition_id . '-coordinator' . $extension);
        $image_name = $image_info['filename'] . $extension;
        $image['name'] = $image_name;
        return $image;
    }

    private function moveFile($image, $directory) {
        App::uses('File', 'Utility');
        $file = new File($image['tmp_name']);
        $file->copy($directory . $image['name']);
        $file->close();
    }
    
    private function getExtension($image) {
        $jpg = array('image/jpg', 'image/jpeg', 'image/pjpeg');
        $png = array('image/png');
        $gif = array('image/gif');
        $svg = array('image/svg+xml');
        if (in_array($image['type'], $jpg)) {
            return '.jpg';
        }
        if (in_array($image['type'], $png)) {
            return '.png';
        }
        if (in_array($image['type'], $gif)) {
            return '.gif';
        }
        if (in_array($image['type'], $svg)) {
            return '.svg';
        }
        return '.error';
    }
    
}
