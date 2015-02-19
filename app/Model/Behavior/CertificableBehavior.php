<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');
APP::uses('ModelBehavior', 'Model');
App::uses('LitlePasswordHasher', 'Controller/Component/Auth');

/**
 * Description of CertificableBehavior
 *
 * @author robert
 */
class CertificableBehavior extends ModelBehavior {

    public function beforeSave(\Model $model, $options = array()) {

        if (isset($model->data[$model->alias]['file_certificate']) && !empty($model->data[$model->alias]['file_certificate']) && $model->data[$model->alias]['file_certificate']['error'] == 0) {
            $model->data[$model->alias]['file_certificate'] = $this->upload($model->alias, $model->data[$model->alias]['file_certificate']);
        } else {
            unset($model->data[$model->alias]['file_certificate']);
        }

        if (isset($model->data[$model->alias]['fullname_position']) && !empty($model->data[$model->alias]['fullname_position'])) {
            
        }

        return parent::beforeSave($model, $options);
    }

    private function upload($name, $image = array(), $directory = 'Certificates') {
        $directory = APP . $directory . DS;

        if ($image['error'] != 0 && $image['size'] == 0) {
            throw new Exception(__('File not sent to server'));
        }

        $this->verifyDirectory($directory);
        $newImage = $this->verifyName($image, $directory, $name);
        $this->moveFile($newImage, $directory);

        return $newImage['name'];
    }

    private function verifyDirectory($directory) {
        App::uses('Folder', 'Utility');
        $folder = new Folder();
        if (!is_dir($directory)) {
            $folder->create($directory);
        }
    }

    private function verifyName($image, $directory, $name) {
        $hasher = new LitlePasswordHasher();
        $extension = $this->getExtension($image);
        $image_info = pathinfo($directory . $name . '-' . $hasher->hash(time() . rand()) . $extension);
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

    /**
     * @todo Ajustar para funcionar para Students e Teachers que não possuem edition_id
     * @param Model $model
     * @param type $id
     * @return string|boolean
     */
    public function base64_file(Model $model, $id, $field = 'edition_id') {
        $options = array(
            'fields' => array($model->alias . '.file_certificate'),
            'conditions' => array($model->alias . '.' . $field => $id),
            'recursive' => -1
        );
        $record = $model->find('first', $options);
        if ($record) {
            $path = APP . 'Certificates' . DS . $record[$model->alias]['file_certificate'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }
        return false;
    }

}
