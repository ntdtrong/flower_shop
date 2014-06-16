<?php
App::uses('AppController', 'Controller');
App::uses('ErrorObject', 'Vendor/error-object');
class CategoriesController extends AppController {
	public $uses = array('Category');
	public $helpers = array('Html');
	public function index($error = 0) {
		$list = $this->Category->find('all');
		$this->set('list', $list);
		$this->set('error', @ErrorObject::$MESSAGE[$error]);
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
