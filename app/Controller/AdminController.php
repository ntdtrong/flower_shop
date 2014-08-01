<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {
	public $uses = array('Category', 'Flower', 'Banner');
	public $helpers = array('Paging');
	const PAGE_SIZE = 10;
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	
	public function index(){
		return $this->redirect(array('action' => 'all'));
	}
	
	public function all($page = 1, $category = 0) {
		$data = array(
			'categories' => array(),
			'flowers' => array()
		);
		$categories = array();
		$categories[] = array('Category' => array('id' => 0, 'name' => 'Tất cả'));
		$categoriesInDB = $this->Category->find('all',
					array( 'conditions' => array(
								'Category.type' => CATEGORY_TYPE_FLOWER,						
								'Category.is_active' => ACTIVE
								),
							'fields' => array('Category.id', 'Category.name')
					)
				);
		$categories = array_merge($categories, $categoriesInDB);
		$categoryName = "Tất cả";
		if(!empty($categories)){
			foreach ($categories as $cate){
				if($cate['Category']['id'] == $category){
					$categoryName = $cate['Category']['name'];
				}
			}
		}
		$data['categories'] = $categories;
		$data['category'] = $category;
		$data['category_name'] = $categoryName;
		
// 		$data['banners'] = $this->Banner->find('all', array(
// 				'conditions' => array('is_active' => ACTIVE)
// 				));
// 		pr($data['banners']);
		
		if($category == 0){
			$joins = array();
			$conditions = array();
		}
		else{
			$joins = array(
					array(
							'table' => 'flower_categories',
							'alias' => 'FlowerCategory',
							'type' => 'inner',
							'conditions' => array('Flower.id = FlowerCategory.flower_id')
					)
			);
			$conditions = array('FlowerCategory.category_id' => $category);
		}
		
		
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
