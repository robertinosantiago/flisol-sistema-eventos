<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

/**
 * Description of HmacPasswordHasher
 *
 * @author robertino
 */
class HmacPasswordHasher extends AbstractPasswordHasher  {
    
    
    public function check($password, $hashedPassword) {
        return $hashedPassword === $this->hash($password);
    }

    public function hash($password) {
        return hash_hmac('sha256', $password, Configure::read('Security.salt'), false);
    }

}
