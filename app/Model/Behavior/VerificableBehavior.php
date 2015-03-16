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
 * CakePHP VerificableBehavior
 * @author robert
 */
class VerificableBehavior extends ModelBehavior {

    public function beforeSave(Model $model, $options = array()) {
        if (array_key_exists('id', $model->data[$model->alias]) && empty($model->data[$model->alias]['id'])) {
            $hasher = new LitlePasswordHasher();
            $model->data[$model->alias]['hash_code'] = $hasher->hash(time(). rand());
        }
        return parent::beforeSave($model, $options);
    }
    
    

}
