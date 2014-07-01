<?php
App::uses('AppController', 'Controller');
class HomesController extends AppController {
	public $uses = array('Category', 'Flower', 'Banner');
	public $helpers = array('Paging');
	
	const PAGE_SIZE = 10;
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'contact', 'all', 'shop'));
	}
	public function index(){
		$this->set('banner1', $this->Banner->findById(1));
		$this->set('banner2', $this->Banner->findById(2));
		$this->layout = 'front';
	}
	
	public function shop() {
		return $this->redirect(array('action' => 'all'));
	}
	
	public function all($page = 1, $category = 0) {
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
		
	}
}
