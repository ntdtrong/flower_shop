<?php
App::uses('AppModel', 'Model');
class FlowerCategory extends AppModel {
	var $name = 'FlowerCategory';
	
	public $belongsTo = array(
				'Flower' => array(
						'className' => 'Flower',
						'foreignKey' => 'flower_id',
						'dependent' => true
				)
			);
}