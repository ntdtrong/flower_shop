<?php
App::uses('AppController', 'Controller');
class HomesController extends AppController {
	public $uses = array('Category', 'Flower', 'Banner');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'contact'));
	}
	
	public function index($category = 0) {
		$data = array(
			'categories' => array(),
			'flowers' => array()
		);
		$data['categories'] = $this->Category->find('all',
					array( 'conditions' => array(
							'Category.type' => CATEGORY_TYPE_FLOWER,						
							'Category.is_active' => ACTIVE
						))
				);
		if($category === 0 && !empty($data['categories'])){
			$category = $data['categories'][0]['Category']['id'];
		}
		$data['category'] = $category;
		
		$data['banners'] = $this->Banner->find('all', array(
				'conditions' => array('is_active' => ACTIVE)
				));
// 		pr($data['banners']);
		
		$joins = array(
				array(
						'table' => 'flower_categories',
						'alias' => 'FlowerCategory',
						'type' => 'inner',
						'conditions' => array('Flower.id = FlowerCategory.flower_id')
				)
			);
		$conditions = array('FlowerCategory.category_id' => $category);
		$data['flowers'] = $this->Flower->find('all', array(
				'conditions' => $conditions,
				'joins' => $joins
				)
			);
		$this->set('data', $data);
	}
	
	public function contact(){
		
	}
}
