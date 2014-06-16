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
		$data['category'] = $category;
		$data['flowers'] = $this->Flower->find('all', array('conditions' => array('category' => $category)));
		//pr($data);
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
