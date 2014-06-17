<?php
App::uses('AppController', 'Controller');
class HomesController extends AppController {
	public $uses = array('Category', 'Flower');
	public function index($category = 0) {
		$data = array(
			'categories' => array(),
			'flowers' => array()
		);
		$data['categories'] = $this->Category->find('all');
		if($category === 0 && !empty($data['categories'])){
			$category = $data['categories'][0]['Category']['id'];
		}
	//	$category = 24;
		$data['category'] = $category;
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
	//	pr($data['flowers']);exit;
//		$list = array();
//		for($i = 1; $i <= 50; $i++){
//			$list[] = array(
//				'id' => $i,
//				'name' => 'Hoa tuoi tham thiet tinh me. Nhan ngay mother day '.$i,
//				'price' => (10000*$i),
//				'des' => 'Detail information, introduction...'
//			);
//		}
//		$data['flowers'] = $list;
		
		$this->set('data', $data);
	}
}
