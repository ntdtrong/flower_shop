<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {
	public $uses = array('Category', 'Flower', 'Banner');
	public $helpers = array('Paging');
	const PAGE_SIZE = 10;
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	public function index(){
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
}
