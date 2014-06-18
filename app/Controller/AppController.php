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
	public $helpers = array('Html', 'Form', 'Session');
	var $uses = array('User');
	public $components = array(
			'Session',
			'Common',
			'Auth' => array(
					'authenticate'=> array(
							'all' => array('userModel' => 'User'),
							'PF' => array(
									//TP-326 Update to bcrypt
									'passwordHasher' => 'Blowfish',
									//Code review TP-327
									'fields' => array(
											'username' => 'email'
									),
							)
					),
					'loginRedirect' => array(
		                'controller' => 'homes',
		                'action' => 'index'
		            ),
		            'logoutRedirect' => array(
		                'controller' => 'users',
		                'action' => 'login'
		            )
			)
	);
	
	
// 	public $components = array(
// 			'Session',
// 			'Common',
// 			'Auth' => array(
// 					'authenticate'=> array(
// 							'Form' => array(
// 									'passwordHasher' => 'Blowfish',
// 									'fields' => array('username' => 'email')
// 							)
// 					),
// 					'loginRedirect' => array(
// 							'controller' => 'homes',
// 							'action' => 'index'
// 					),
// 					'logoutRedirect' => array(
// 							'controller' => 'users',
// 							'action' => 'login'
// 					)
// 			)
// 	);

	
	public function beforeFilter() {
		parent::beforeFilter();
	
		if($this->Auth->user('id')){
			$user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
			$this->set('current_user', $user['User']);
		}
		
	}
}
