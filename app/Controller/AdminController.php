<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {
	public $uses = array();
	public function index() {
		$list = array();
		for($i = 1; $i <= 50; $i++){
			$list[] = array(
				'id' => $i,
				'name' => 'Hoa tuoi tham thiet tinh me. Nhan ngay mother day '.$i,
				'price' => (10000*$i),
				'des' => 'Detail information, introduction...'
			);
		}
		$this->set('list', $list);
	}
	
	public function flower() {
		
	}
	
	public function category() {
		
	}
}
