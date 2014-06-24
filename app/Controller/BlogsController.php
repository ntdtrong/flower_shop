<?php
App::uses('AppController', 'Controller');
class BlogsController extends AppController {
	var $uses = array('Blog', 'Category');
	public $helpers = array('Paging');
	const PAGE_SIZE = 10;
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function index() {
		return $this->redirect(array('action' => 'all'));
	}
	
	public function all($page = 1) {
		$data = array();
		
		// get categories
		$data['categories'] = $this->Category->find('all',
					array( 'conditions' => array(
						'Category.type' => CATEGORY_TYPE_BLOG,
						'Category.is_active' => ACTIVE
					))
				);
		
		// get blogs
		$joins = array(
				array(
						'table' => 'categories',
						'alias' => 'Category',
						'type' => 'inner',
						'conditions' => array('Category.id = Blog.category_id')
				)
		);
		$fields = array('Blog.*', 'Category.name');
		
		$total = $this->Blog->find('count', array(
				'joins' => $joins
		));
		
		$pagingObj = $this->paginatorObj($total, (int)$page, self::PAGE_SIZE);
		
		$data['blogs'] = $this->Blog->find('all', array(
				'fields' => $fields,
				'joins' => $joins,
				'order' => array('Blog.id DESC'),
				'limit' => self::PAGE_SIZE,
				'offset' => ($pagingObj['current_page'] - 1) * self::PAGE_SIZE
			)
		);
		
		$this->set('data', $data);
		$this->set('pagingObj', $pagingObj);
	}
	
	public function add(){
		$data = array();
		if($this->request->is('post')){
			$data['blog'] = $this->request->data;
			$rs = $this->_save($data['blog']);
			if(!empty($rs['success'])){
				$this->Session->setFlash(__('Lưu blog thành công.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		
		$data['categories'] = $this->Category->find('all',
					array( 'conditions' => array(
						'Category.type' => CATEGORY_TYPE_BLOG,
						'Category.is_active' => ACTIVE
					))
				);
		
		$this->set('data', $data);
	}
	
	public function edit($id){
		$data = array();
		if($this->request->is('post')){
			$data['blog'] = $this->request->data;
			$rs = $this->_save($data['blog']);
			if(!empty($rs['success'])){
				$this->Session->setFlash(__('Lưu blog thành công.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		else{
			if(intval($id) > 0){
				$data['blog'] = $this->Blog->find('first', array(
						'conditions' => array('id' => $id)
				)
				);
				if($data['blog']){
					$data['blog'] = $data['blog']['Blog'];
				}
			}
		}
		
		$data['categories'] = $this->Category->find('all',
					array( 'conditions' => array(
						'Category.type' => CATEGORY_TYPE_BLOG,
						'Category.is_active' => ACTIVE
					))
			);
		$this->set('data', $data);
	}
	
	private function _save($blog){
		$data = array();
		if(empty($blog['content'])){
			$data['error'] = 'Nhập nội dung blog';
		}
		
		if(empty($blog['title'])){
			$data['error'] = 'Nhập tiêu đề blog';
		}
		
		if(empty($blog['category_id'])){
			$data['error'] = 'Chọn danh mục cho blog';
		}
		if(empty($data['error'])){
			if(!empty($blog['id']) && intval($blog['id']) > 0){ //edit
				$this->Blog->id = $blog['id'];
				if($this->Blog->save($blog)){
					$data['success'] = 'Lưu blog thành công';
				}
			}
			else{ // add
				$this->Blog->create();
				if($this->Blog->save($blog)){
					$data['success'] = 'Lưu blog thành công';
				}
			}
		}
		return $data;
	}
	
	public function delete($id){
		$blog = $this->Blog->find('first', array('conditions' => array('id' => $id)));
		if($blog){
			$this->Blog->delete($id);
			$this->Session->setFlash(__('Xóa blog thành công.'), 'flash_success');
		}
		else{
			$this->Session->setFlash(__("Blog này không tồn tại."), 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}
}
