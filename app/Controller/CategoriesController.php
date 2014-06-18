<?php
App::uses('AppController', 'Controller');
App::uses('ErrorObject', 'Vendor/error-object');
class CategoriesController extends AppController {
	public $uses = array('Category');
	public $helpers = array('Html');
	public function index($id = 0) {
		$data = array('categories' => array());
		
		if ($this->request->is('post')) {
			$data['category'] = $this->request->data;
// 			pr($data['user']);
			$rs = $this->_save($data['category']);
			if(!empty($rs['category'])){
				$data['category'] = array();
				$data['success'] = 'Lưu tài khoản thành công';
			}
			else{
				$data['error'] = $rs['error'];
			}
		}
		else if($this->request->is('get')){
			if(is_numeric($id) && intval($id) > 0){
				$cate = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
				$data['category'] = @$cate['Category'];
			}
		}
		
		$data['categories'] = $this->Category->find('all');
		$this->set('data', $data);
	}

	public function add(){
		if ($this->request->is('post')) {
			$name = $this->request->data['name'];
			if(empty($name)){
				$this->redirect('index/'.ErrorObject::C_CATEGORY_NULL);
			}
			$cate = $this->Category->find('first', array('conditions' => array('name' => $name)));
			if($cate){
				$this->redirect('index/'.ErrorObject::C_CATEGORY_DUPLICATE);
			}
			else{
				$this->Category->create();
				if ($this->Category->save($this->request->data)){
					$this->redirect('index');
				}
				else {
					$this->redirect('index/'.ErrorObject::C_CATEGORY_SAVE_FAIL);
				}
			}
		}
	}

	public function edit($id){
		if ($this->request->is('post')) {
			$name = $this->request->data['name'];
			if(empty($name)){
				$this->redirect('index/'.ErrorObject::C_CATEGORY_NULL);
			}
			$cate = $this->Category->find('first', array('conditions' => array('name' => $name)));
			if($cate){
				$this->redirect('index/'.ErrorObject::C_CATEGORY_DUPLICATE);
			}
			
			
			if(!$id){ //ADD
				
				$this->Category->create();
				if ($this->Category->save($this->request->data)){
					$this->redirect('index');
				}
				else {
					$this->redirect('index/'.ErrorObject::C_CATEGORY_SAVE_FAIL);
				}	
			}
			else{
				//edit
				$cate = $this->Category->find('first', array('conditions' => array('id' => $id)));
				if(!$cate){
					$this->redirect('index/'.ErrorObject::C_CATEGORY_DUPLICATE);
				}
				else{
					$this->Category->id = $id;
					if ($this->Category->save($this->request->data)){
						$this->redirect('index');
					}
					else {
						$this->redirect('index/'.ErrorObject::C_CATEGORY_SAVE_FAIL);
					}
				}
			}
		}
	}

	public function delete($id){
		$cate = $this->Category->find('first', array('conditions' => array('id' => $id)));
		if($cate){
			$this->Category->delete($id);
			echo "OK";
		}
		else{
			echo ErrorObject::$MESSAGE[ErrorObject::C_CATEGORY_NOT_EXIST];
		}
		exit;
	}

}
