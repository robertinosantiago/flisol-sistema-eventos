<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

/**
 * Description of LitlePasswordHasher
 *
 * @author robert
 */
class LitlePasswordHasher extends AbstractPasswordHasher {

    public function check($password, $hashedPassword) {
        return $hashedPassword === $this->hash($password);
    }

    public function hash($password) {
        return $this->base_encode($password);
    }

    private function base_encode($val, $base = 62, $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $str = '';
        do {
            $i = fmod($val, $base);
            $str = $chars[intval($i)] . $str;
            $val = ($val - $i) / $base;
        } while ($val > 0);
        return $str;
    }

}
