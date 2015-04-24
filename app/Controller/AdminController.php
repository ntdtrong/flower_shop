<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {
	public $uses = array('Category', 'Flower', 'Banner', 'Feedback');
	public $helpers = array('Paging');
	const PAGE_SIZE = 100;
	
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
	
	public function feedbacks($page = 1) {
		$conditions = array('Feedback.hidden' => 0);
		
		$total = $this->Feedback->find('count', array(
			'conditions' => $conditions
		));
		
		$pagingObj = $this->paginatorObj($total, (int)$page, self::PAGE_SIZE);
		
		$data = $this->Feedback->find('all', array(
			'conditions' => $conditions,
			'order' => array('Feedback.id DESC'),
			'limit' => self::PAGE_SIZE,
			'offset' => ($pagingObj['current_page'] - 1) * self::PAGE_SIZE
		));
		
		$this->set('data', $data);
		$this->set('pagingObj', $pagingObj);
	}
	
	public function feedback($id) {
		
		$item = $this->Feedback->findById($id);
		
		if (empty($item) || $item['Feedback']['hidden'] == 1) {
			$this->Session->setFlash('<div class="alert alert-danger" role="alert">Không tìm thấy ý kiến.</div>');
			$this->redirect(array('controller' => 'admin', 'action' => 'feedbacks'));
		}
		
		$item['Feedback']['viewed'] = 1;
		
		$this->Feedback->id = $id;
		$this->Feedback->save($item);
		
		$this->set('item', $item);
	}
	
	public function delete_feedback($id) {
		$this->Feedback->delete($id);
		$this->redirect(array('controller' => 'admin', 'action' => 'feedbacks'));
	}
}
