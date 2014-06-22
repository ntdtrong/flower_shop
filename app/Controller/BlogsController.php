<?php
App::uses('AppController', 'Controller');
class BlogsController extends AppController {
	var $uses = array('Blog', 'Category');
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function index($id = 0) {
		$data = array();
		if($this->request->is('post')){
			$data['blog'] = $this->request->data;
			$rs = $this->_save($data['blog']);
			if(!empty($rs['success'])){
				$data['success'] = $rs['success'];
				unset($data['blog']);
			}
			else{
				$data['error'] = $rs['error'];
			}
		}
		$data['categories'] = $this->Category->find('all',
					array( 'conditions' => array(
						'Category.type' => CATEGORY_TYPE_BLOG,
						'Category.is_active' => ACTIVE
					))
				);
		
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
			echo "OK";
		}
		else{
			echo "Blog này không tồn tại.";
		}
		exit;
	}
}
