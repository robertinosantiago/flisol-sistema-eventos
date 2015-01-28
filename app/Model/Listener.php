<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Listener
 * @author robertino
 */
class Listener extends AppModel {

    public $belongsTo = array('Event');
    public $hasMany = array('ListenerUser');

    public function getListenerById($id) {
        $options = array(
            'fields' => array('Listener.id', 'Listener.file_certificate', 'Listener.fullname_position', 'Listener.event_id', 'Listener.has_back', 'Listener.back_content'),
            'conditions' => array(
                'Listener.id' => $id
            ),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getListenerByUser($user_id) {
        $options = array(
            'fields' => array('Event.title', 'Event.start_date', 'Event.closing_date', 'Listener.id', 'ListenerUser.hash_code', 'ListenerUser.attended'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'listener_users',
                    'alias' => 'ListenerUser',
                    'type' => 'inner',
                    'conditions' => array('Listener.id = ListenerUser.listener_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'events',
                    'alias' => 'Event',
                    'type' => 'inner',
                    'conditions' => array('Event.id = Listener.event_id')
                )
            ),
            'conditions' => array(
                'ListenerUser.user_id' => $user_id,
                'ListenerUser.attended' => true,
                'Event.show_certificate' => true
            ),
            'recursive' => -1
        );
        return $this->find('all', $options);
    }

    public function getInfoCertificate($id, $hash_code) {
        $return = array();
        $options = array(
            'fields' => array('User.fullname', 'Listener.id', 'ListenerUser.hash_code', 'Event.id', 'Event.title', 'Listener.fullname_position', 'Listener.has_back', 'Listener.back_content'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'events',
                    'alias' => 'Event',
                    'type' => 'inner',
                    'conditions' => array('Event.id = Listener.event_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'listener_users',
                    'alias' => 'ListenerUser',
                    'type' => 'inner',
                    'conditions' => array('Listener.id = ListenerUser.listener_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = ListenerUser.user_id')
                )
            ),
            'conditions' => array(
                'Listener.id' => $id,
                'ListenerUser.hash_code' => $hash_code,
                'Event.show_certificate' => true
            ),
            'recursive' => -1
        );
        $record = $this->find('first', $options);
        if ($record) {
            $return['hash_code'] = $record['ListenerUser']['hash_code'];
            $return['fullname'] = $record['User']['fullname'];
            $return['title'] = $record['Event']['title'];
            $return['fullname_position'] = $record['Listener']['fullname_position'];
            $return['event_id'] = $record['Event']['id'];
            $return['id'] = $record['Listener']['id'];
            $return['has_back'] = $record['Listener']['has_back'];
            $return['back_content'] = $record['Listener']['back_content'];
        }
        return $return;
    }

    public function loadListenersByEvent($event_id, $onlyActive = true, $onlyVerified = false) {
        $options = array(
            'fields' => array('User.id', 'User.fullname', 'User.document', 'Listener.id', 'Event.id', 'ListenerUser.id', 'ListenerUser.attended'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'listener_users',
                    'alias' => 'ListenerUser',
                    'type' => 'inner',
                    'conditions' => array('Listener.id = ListenerUser.listener_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = ListenerUser.user_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'events',
                    'alias' => 'Event',
                    'type' => 'inner',
                    'conditions' => array('Event.id = Listener.event_id')
                )
            ),
            'conditions' => array(
                'User.deleted = 0',
                'Listener.event_id' => $event_id
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

    public function countListeners($id = NULL, $onlyActive = true, $onlyVerified = false) {
        $options = array(
            'fields' => array('COUNT(ListenerUser.id) AS quantity'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'listener_users',
                    'alias' => 'ListenerUser',
                    'type' => 'inner',
                    'conditions' => array('Listener.id = ListenerUser.listener_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array('User.id = ListenerUser.user_id')
                )
            ),
            'conditions' => array(
                'Listener.event_id' => $id
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

    public function base64_file($event_id) {
        $options = array(
            'fields' => array('Listener.file_certificate'),
            'conditions' => array('Listener.event_id' => $event_id),
            'recursive' => -1
        );
        $record = $this->find('first', $options);
        if ($record) {
            $path = APP . 'Certificates' . DS . $record['Listener']['file_certificate'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }
        return false;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data['Listener']['file_certificate']) && !empty($this->data['Listener']['file_certificate']) && $this->data['Listener']['file_certificate']['error'] == 0) {
            $this->data['Listener']['file_certificate'] = $this->upload($this->data['Listener']['event_id'], $this->data['Listener']['file_certificate']);
        } else {
            unset($this->data['Listener']['file_certificate']);
        }

        if (isset($this->data['Listener']['fullname_position']) && !empty($this->data['Listener']['fullname_position'])) {
            
        }

        return parent::beforeSave($options);
    }

    private function upload($event_id, $image = array(), $directory = 'Certificates') {
        $directory = APP . $directory . DS;

        if ($image['error'] != 0 && $image['size'] == 0) {
            throw new Exception(__('File not sent to server'));
        }

        $this->verifyDirectory($directory);

        $image = $this->verifyName($event_id, $image, $directory);

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

    private function verifyName($event_id, $image, $directory) {
        $extension = $this->getExtension($image);
        $image_info = pathinfo($directory . 'event-' . $event_id . '-listener' . $extension);
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

    public function afterFind($results, $primary = false) {
        if (isset($value['Event']['start_date'])) {
            $results[$key]['Event']['start_date'] = $this->__dateFormat($results[$key]['Event']['start_date']);
        }
        if (isset($value['Event']['closing_date'])) {
            $results[$key]['Event']['closing_date'] = $this->__dateFormat($results[$key]['Event']['closing_date']);
        }
        
        return parent::afterFind($results, $primary);
    }
    
    private function __dateFormat($date = null, $originalFormat = 'Y-m-d', $newFormat = 'd/m/Y') {
        return $this->__date_create_from_format($originalFormat, $date)->format($newFormat);
    }

    private function __date_create_from_format($dformat, $dvalue) {

        $schedule = $dvalue;
        $schedule_format = str_replace(array('Y', 'm', 'd', 'H', 'i', 'a'), array('%Y', '%m', '%d', '%I', '%M', '%p'), $dformat);
        // %Y, %m and %d correspond to date()'s Y m and d.
        // %I corresponds to H, %M to i and %p to a
        $ugly = strptime($schedule, $schedule_format);
        $ymd = sprintf(
                // This is a format string that takes six total decimal
                // arguments, then left-pads them with zeros to either
                // 4 or 2 characters, as needed
                '%04d-%02d-%02d %02d:%02d:%02d', $ugly['tm_year'] + 1900, // This will be "111", so we need to add 1900.
                $ugly['tm_mon'] + 1, // This will be the month minus one, so we add one.
                $ugly['tm_mday'], $ugly['tm_hour'], $ugly['tm_min'], $ugly['tm_sec']
        );
        $new_schedule = new DateTime($ymd);

        return $new_schedule;
    }

}
