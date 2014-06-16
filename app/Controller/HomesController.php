<?php
App::uses('AppController', 'Controller');
class HomesController extends AppController {
	public $uses = array('Category');
	public function index($category = 0) {
		$data = array();
		$data['categories'] = $this->Category->find('all');
		
		$list = array();
		for($i = 1; $i <= 50; $i++){
			$list[] = array(
				'id' => $i,
				'name' => 'Hoa tuoi tham thiet tinh me. Nhan ngay mother day '.$i,
				'price' => (10000*$i),
				'des' => 'Detail information, introduction...'
			);
		}
		$data['flowers'] = $list;
		
		$this->set('data', $data);
	}
}
