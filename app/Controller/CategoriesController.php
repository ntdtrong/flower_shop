<?php
App::uses('AppController', 'Controller');
App::uses('ErrorObject', 'Vendor/error-object');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::uses('File', 'Utility');
class CategoriesController extends AppController {
	public $uses = array('Category');
	public $helpers = array('Html');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	
	public function index($id = 0) {
		$data = array('categories' => array());
		$data['categories'] = $this->Category->find('all');
		$this->set('data', $data);
	}
	
	public function add(){
		$data = array();
		if ($this->request->is('post')) {
			$data['category'] = $this->request->data;
			$rs = $this->_save($data['category']);
			if(!empty($rs['category'])){
				$this->Session->setFlash(__('Lưu danh mục thành công.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		
		$data['categories'] = $this->Category->find('all');
		$this->set('data', $data);
	}
	
	public function edit($id){
		$data = array();
		if ($this->request->is('post')) {
			$data['category'] = $this->request->data;
			$rs = $this->_save($data['category']);
			if(!empty($rs['category'])){
				$this->Session->setFlash(__('Lưu danh mục thành công.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		else{
			if(is_numeric($id) && intval($id) > 0){
				$cate = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
				$data['category'] = @$cate['Category'];
			}
		}
		
		$data['categories'] = $this->Category->find('all');
		$this->set('data', $data);
	}
	
	private function _save($category){
		$rs = array();
		if(empty($category['name'])){
			$rs['error'] = 'Tên danh mục không hợp lệ.';
			return $rs;
		}
		
		if(!empty($category['id']) && intval($category['id']) > 0){ //edit
			$oldCate = $this->Category->find('first', array(
					'conditions' => array('id' => $category['id'])
			));
			
			if(!$oldCate){
				$rs['error'] = 'Danh mục này không tồn tại.';
				return $rs;
			}
			
			$this->Category->id = $category['id'];
			if($this->Category->save($category)){
				$rs['category'] = $category;
			}
		}
		else{ // add
			$this->Category->create();
			if($this->Category->save($category)){
				$rs['category'] = $category;
			}
		}
		return $rs;
	}
	
	public function delete($id){
		$cate = $this->Category->find('first', array('conditions' => array('id' => $id)));
		if($cate){
			if($cate['Category']['image']){
				$fileImage = new File(IMAGE_UPLOAD_DIR.IMAGE_BANNER_DIR.$cate['Category']['image'], true, 0777);
				if($fileImage->exists())
					$fileImage->delete();
			}
			
			$this->Category->delete($id);
			$this->Session->setFlash(__('Xóa danh mục thành công.'), 'flash_success');
		}
		else{
			$this->Session->setFlash(__('Danh mục này không tồn tại.'), 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}
}
