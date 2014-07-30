<?php
App::uses('AppModel', 'Model');
class Flower extends AppModel {
	var $name = 'Flower';
	
	public $hasMany = array(
		'FlowerCategory' => array(
				'className' => 'FlowerCategory',
				'foreignKey' => 'flower_id',
				'dependent' => true
		)
	);
}