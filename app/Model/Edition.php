<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Edition
 * @author robertino
 */
class Edition extends AppModel {

    public $actsAs = array('DateFormat');
    public $virtualFields = array(
        'registration' => 'CONCAT(DATE_FORMAT(Edition.registration_begin, "%d/%m/%Y"), " - ", DATE_FORMAT(Edition.registration_end, "%d/%m/%Y"))'
    );

    public function optionsPaginate() {
        $options = array(
            'limit' => 25,
            'fields' => array('Edition.id', 'Edition.year', 'Edition.registration', 'Edition.date_of', 'Edition.active', 'Edition.show_certificate'),
            'conditions' => array('Edition.deleted = 0'),
            'order' => array('Edition.date_of' => 'asc', 'Edition.title' => 'asc')
        );
        return $options;
    }

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $value) {
            if (isset($value['Edition']['active'])) {
                $results[$key]['Edition']['activeText'] = ($results[$key]['Edition']['active'] ? __('Yes') : __('No'));
            }
            if (isset($value['Edition']['show_certificate'])) {
                $results[$key]['Edition']['showCertificateText'] = ($results[$key]['Edition']['show_certificate'] ? __('Yes') : __('No'));
            }
        }
        return parent::afterFind($results, $primary);
    }

}
