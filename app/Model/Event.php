<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Event
 * @author robertino
 */
class Event extends AppModel {

    public $hasOne = array('Listener', 'Coordinator', 'Presenter');
    public $validate = array(
        'title' => array('rule' => 'notEmpty', 'required' => 'create'),
        'registration_begin' => array('rule' => 'notEmpty', 'required' => 'create'),
        'registration_end' => array('rule' => 'notEmpty', 'required' => 'create'),
        'start_date' => array('rule' => 'notEmpty', 'required' => 'create'),
        'closing_date' => array('rule' => 'notEmpty', 'required' => 'create')
    );
    public $virtualFields = array(
        'registration' => 'CONCAT(DATE_FORMAT(Event.registration_begin, "%d/%m/%Y"), " - ", DATE_FORMAT(Event.registration_end, "%d/%m/%Y"))',
        'period' => 'CONCAT(DATE_FORMAT(Event.start_date, "%d/%m/%Y"), " - ", DATE_FORMAT(Event.closing_date, "%d/%m/%Y"))'
    );

    public function optionsPaginate() {
        $options = array(
            'limit' => 25,
            'fields' => array('Event.id', 'Event.title', 'Event.registration', 'Event.period', 'Event.active', 'Event.show_certificate'),
            'conditions' => array('Event.deleted = 0'),
            'order' => array('Event.start   _date' => 'asc', 'Event.title' => 'asc')
        );
        return $options;
    }

    public function getEvent($id = null) {
        $options = array(
            'fields' => array('Event.id', 'Event.title', 'Event.description', 'Presenter.id', 'Listener.id', 'Coordinator.id', 'Event.registration', 'Event.period', 'Event.show_certificate'),
            'conditions' => array('Event.deleted = 0', 'Event.id' => $id)
        );
        return $this->find('first', $options);
    }

    public function getEventByListener($listener_id) {
        $options = array(
            'fields' => array('Event.id', 'Event.title'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'listeners',
                    'alias' => 'Listener',
                    'type' => 'inner',
                    'conditions' => array('Event.id = Listener.event_id')
                )
            ),
            'conditions' => array('Listener.id' => $listener_id),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getEventByPresenter($presenter_id) {
        $options = array(
            'fields' => array('Event.id', 'Event.title'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'presenters',
                    'alias' => 'Presenter',
                    'type' => 'inner',
                    'conditions' => array('Event.id = Presenter.event_id')
                )
            ),
            'conditions' => array('Presenter.id' => $presenter_id),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getEventByCoordinator($coordinator_id) {
        $options = array(
            'fields' => array('Event.id', 'Event.title'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'coordinators',
                    'alias' => 'Coordinator',
                    'type' => 'inner',
                    'conditions' => array('Event.id = Coordinator.event_id')
                )
            ),
            'conditions' => array('Coordinator.id' => $coordinator_id),
            'recursive' => -1
        );
        return $this->find('first', $options);
    }

    public function getActiveEvents() {
        $todayDate = new DateTime();
        $today = $todayDate->format('Y-m-d');
        $options = array(
            'fields' => array('Event.id', 'Event.title', 'Event.description', 'Event.registration', 'Event.period'),
            'conditions' => array(
                'Event.registration_begin <=' => $today,
                'Event.registration_end >=' => $today,
                'Event.deleted = 0',
                'Event.active = 1'
            ),
            'order' => array(
                'Event.registration_end' => 'asc',
                'Event.start_date' => 'asc',
                'Event.title' => 'asc'
            ),
            'recursive' => -1
        );
        return $this->find('all', $options);
    }

    public function getNextEvents() {
        $todayDate = new DateTime();
        $today = $todayDate->format('Y-m-d');
        $options = array(
            'fields' => array('Event.id', 'Event.title', 'Event.description', 'Event.registration', 'Event.period'),
            'conditions' => array(
                'Event.registration_begin >' => $today,
                'Event.deleted = 0'
            ),
            'order' => array(
                'Event.registration_end' => 'asc',
                'Event.start_date' => 'asc',
                'Event.title' => 'asc',
                'Event.active = 1'
            ),
            'recursive' => -1
        );
        return $this->find('all', $options);
    }

    public function isRegistered($event_id, $user_id) {
        $options = array(
            'fields' => array('Event.id'),
            'joins' => array(
                array(
                    'table' => $this->tablePrefix . 'listeners',
                    'alias' => 'Listener',
                    'type' => 'inner',
                    'conditions' => array('Event.id = Listener.event_id')
                ),
                array(
                    'table' => $this->tablePrefix . 'listener_users',
                    'alias' => 'ListenerUser',
                    'type' => 'inner',
                    'conditions' => array('Listener.id = ListenerUser.listener_id')
                )
            ),
            'conditions' => array(
                'Listener.event_id' => $event_id,
                'ListenerUser.user_id' => $user_id
            ),
            'recursive' => -1
        );

        $record = $this->find('all', $options);

        if (empty($record)) {
            return false;
        }
        return true;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data['Event']['registration_begin'])) {
            $this->data['Event']['registration_begin'] = $this->__dateFormat($this->data['Event']['registration_begin'], 'd/m/Y', 'Y-m-d');
        }
        if (isset($this->data['Event']['registration_end'])) {
            $this->data['Event']['registration_end'] = $this->__dateFormat($this->data['Event']['registration_end'], 'd/m/Y', 'Y-m-d');
        }
        if (isset($this->data['Event']['start_date'])) {
            $this->data['Event']['start_date'] = $this->__dateFormat($this->data['Event']['start_date'], 'd/m/Y', 'Y-m-d');
        }
        if (isset($this->data['Event']['closing_date'])) {
            $this->data['Event']['closing_date'] = $this->__dateFormat($this->data['Event']['closing_date'], 'd/m/Y', 'Y-m-d');
        }

        return true;
    }

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $value) {
            if (isset($value['Event']['registration_begin'])) {
                $results[$key]['Event']['registration_begin'] = $this->__dateFormat($results[$key]['Event']['registration_begin']);
            }
            if (isset($value['Event']['registration_end'])) {
                $results[$key]['Event']['registration_end'] = $this->__dateFormat($results[$key]['Event']['registration_end']);
            }
            if (isset($value['Event']['start_date'])) {
                $results[$key]['Event']['start_date'] = $this->__dateFormat($results[$key]['Event']['start_date']);
            }
            if (isset($value['Event']['closing_date'])) {
                $results[$key]['Event']['closing_date'] = $this->__dateFormat($results[$key]['Event']['closing_date']);
            }
            if (isset($value['Event']['active'])) {
                $results[$key]['Event']['activeText'] = ($results[$key]['Event']['active'] ? __('Yes') : __('No'));
            }
            if (isset($value['Event']['show_certificate'])) {
                $results[$key]['Event']['showCertificateText'] = ($results[$key]['Event']['show_certificate'] ? __('Yes') : __('No'));
            }
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
