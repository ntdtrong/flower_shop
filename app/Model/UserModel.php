<?php
App::uses('AppModel', 'Model');
class User extends AppModel {
	var $name = 'User';
	var $alias = 'User';
	
	public function anonymous(){
		return array(
				'User' => array(
						'id' => 0,
						'role' => 0,
						'password' => '12345678'
						)
				);
	}
}