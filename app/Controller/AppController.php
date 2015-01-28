<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Acl',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email',
                        'password' => 'password',
                        'role' => 'role'
                    ),
                    'userModel' => 'User',
                    'scope' => array('User.active' => 1),
                    'passwordHasher' => 'Hmac'
                )
            ),
            'loginAction' => array(
                'controller' => 'Users',
                'action' => 'login'
            ),
            'logoutAction' => array(
                'controller' => 'Users',
                'action' => 'logout'
            ),
            'authorize' => array('Controller')
        )
    );

    public function setTitle($title = 'UFPR') {
        $this->set('title_for_layout', $title);
    }

    protected function termOfSearch($term = null, $fields = array()) {
        if ($term != null && !empty($term)) {
            $terms = explode(" ", $term);
            foreach ($terms as $value) {
                $conditions = array();
                foreach ($fields as $field) {
                    $conditions['OR'][] = array($field . ' LIKE' => "%$value%");
                }
                $this->paginate['conditions'][] = $conditions;
            }
            $this->set('activeClear', true);
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();

        if (is_null($this->Auth->user())) {
            $this->Auth->authError = __('Your session has expired. Please enter your details again.');
        } else {
            $this->Auth->authError = __('You do not have privileges to access this content.');
        }

        $this->Auth->deny();
    }

    public function isAuthorized($user = NULL) {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        return false;
    }

}
