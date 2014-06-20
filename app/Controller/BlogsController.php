<?php
App::uses('AppController', 'Controller');
class BlogsController extends AppController {
	var $uses = array('Blog', 'Category');
	public function beforeFilter() {
		parent::beforeFilter();
	
		$this->Auth->allow(array('index', 'save'));
	}
	
	public function index($id = 0) {
		$data = array();
		if($this->request->is('post')){
			$data['blog'] = $this->request->data;
			if(empty($data['blog']['content'])){
				$data['error'] = 'Nhập nội dung blog';
			}
			
			if(empty($data['blog']['title'])){
				$data['error'] = 'Nhập tiêu đề blog';
			}
			
			if(empty($data['blog']['category_id'])){
				$data['error'] = 'Chọn danh mục cho blog';
			}
			if(empty($data['error'])){
				if(!empty($data['blog']['id']) && intval($data['blog']['id']) > 0){ //edit
					$this->Blog->id = $data['blog']['id'];
					if($this->Blog->save($data['blog'])){
						$data['success'] = 'Lưu blog thành công';
						$data['blog'] = array();
					}
				}
				else{ // add
					$this->Blog->create();
					if($this->Blog->save($data['blog'])){
						$data['success'] = 'Lưu blog thành công';
						$data['blog'] = array();
					}
				}
			}
			
		}
		$data['categories'] = $this->Category->find('all');
		
		$joins = array(
				array(
						'table' => 'categories',
						'alias' => 'Category',
						'type' => 'inner',
						'conditions' => array('Category.id = Blog.category_id')
				)
		);
		$fields = array('Blog.*', 'Category.name');
		$data['blogs'] = $this->Blog->find('all', array(
				'fields' => $fields,
				'joins' => $joins
			)
		);
		
		if(intval($id) > 0){
			$data['blog'] = $this->Blog->find('first', array(
					'conditions' => array('id' => $id)
			)
			);
			if($data['blog']){
				$data['blog'] = $data['blog']['Blog'];
			}
		}
		$this->set('data', $data);
	}
	
	public function save(){
		$data = array();
		if($this->request->is('post')){
			$data['blog'] = $this->request->data;
			if(empty($data['blog']['content'])){
				$data['error'] = 'Nhập nội dung cho blog';
			}
			
			if(empty($data['blog']['title'])){
				$data['error'] = 'Nhập tiêu đề cho blog';
			}
			
			if(empty($data['blog']['category'])){
				$data['error'] = 'Chọn danh mục cho blog';
			}
			
			if(!empty($data['blog']['id']) && intval($data['blog']['id']) > 0){ //edit
				$this->Blog->id = $data['blog']['id'];
				if($this->Blog->save($data['blog'])){
					$data['success'] = 'Lưu blog thành công';
					$data['blog'] = array();
				}
			}
			else{ // add
				$this->Blog->create();
				if($this->Blog->save($data['blog'])){
					$data['success'] = 'Lưu blog thành công';
					$data['blog'] = array();
				}
			}
		}
		
		$this->set('data', $data);
	}
}
