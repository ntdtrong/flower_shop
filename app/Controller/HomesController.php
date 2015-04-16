<?php
App::uses('AppController', 'Controller');
class HomesController extends AppController {
	public $uses = array('Category', 'Flower', 'Banner', 'Visitor');
	public $helpers = array('Paging');
	
	const PAGE_SIZE = 100;
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'contact', 'all', 'shop', 'detail', 'about'));
	}
	public function index(){
		/*$this->set('banner1', $this->Banner->findById(1));
		$this->set('banner2', $this->Banner->findById(2));*/
		
		$clientIp = $this->request->clientIp();
		
		$trackedItem = $this->Visitor->find('first', array(
			'conditions' => array('ip_address' => $clientIp)
		));
		
		if ( empty($trackedItem) || Utils::moreThanHalfHourAgo($trackedItem['Visitor']['visited_timestamp']) ) {
			$record = array(
				'ip_address' => $clientIp,
				'visited_timestamp' => date('Y-m-d H:i:s')
			);
			$this->Visitor->create();
			$this->Visitor->save($record);
		}
		
		$this->layout = 'front';
	}
	
	public function shop() {
		return $this->redirect(array('action' => 'all'));
	}
	
	public function all($page = 1, $category = 0) {
		$this->layout = 'front';
		$data = array(
			'categories' => array(),
			'flowers' => array()
		);
		
		if($category == 0){
			$conditions = array();
			$joins = array();
		} else {
			$categoryName = $data['categories'][$category];
			$conditions = array('FlowerCategory.category_id' => $category);
			$joins = array(
				array(
					'table' => 'flower_categories',
					'alias' => 'FlowerCategory',
					'type' => 'inner',
					'conditions' => array('Flower.id = FlowerCategory.flower_id')
				)
			);
		}
		
		$data['category'] = $category;
		
		$total = $this->Flower->find('count', array(
			'conditions' => $conditions,
			'joins' => $joins
		));
		
		$pagingObj = $this->paginatorObj($total, (int)$page, self::PAGE_SIZE);
		
		$data['flowers'] = $this->Flower->find('all', array(
			'conditions' => $conditions,
			'joins' => $joins,
			'order' => array('Flower.id DESC'),
			'limit' => self::PAGE_SIZE,
			'offset' => ($pagingObj['current_page'] - 1) * self::PAGE_SIZE
			)
		);
		
		$this->set('data', $data);
		$this->set('pagingObj', $pagingObj);
	}
	
	public function contact(){
		$this->layout = 'front';
	}
	
	public function detail($id){
		$this->layout = 'front';
		$this->set('item', $this->Flower->findById($id));
	}
	
	public function about() {
		$this->layout = 'front';
	}
}
