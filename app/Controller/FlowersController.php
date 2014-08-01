<?php
App::uses('AppController', 'Controller');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::uses('File', 'Utility');
class FlowersController extends AppController {
	public $uses = array('Category', 'Flowers', 'FlowerCategory');
	public $helpers = array('Form', 'Html');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	
	public function index() {
		$this->redirect('add');
	}
	
	public function add() {
		$data = array();
		$data['categories_selected'] = array();
		if ($this->request->is('post')) {
			$data['flower'] = $this->request->data;
			$rs = $this->_save($data['flower']);
			if(!empty($rs['success'])){
				$this->Session->setFlash(__('Lưu giỏ hoa thành công.'), 'flash_success');
				return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
			}
			else{
				$data['categories_selected'] = @$rs['categories_selected'];
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
			
		}
		
		$data['categories'] = $this->Category->find('all',
					array( 'conditions' => array(
							'Category.type' => CATEGORY_TYPE_FLOWER,
							'Category.is_active' => ACTIVE
							))
				);
		
		$this->set('data', $data);
	}
	public function edit($id) {
		$data = array();
		$data['categories_selected'] = array();
		if ($this->request->is('post')) {
			$data['flower'] = $this->request->data;
			$rs = $this->_save($data['flower']);
			if(!empty($rs['success'])){
				$this->Session->setFlash(__('Lưu giỏ hoa thành công.'), 'flash_success');
				return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
			}
			else{
				$data['categories_selected'] = @$rs['categories_selected'];
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
			
		} else if($this->request->is('get')){
			if($id){
				$conditions = array('Flowers.id' => $id);
				$flower = $this->Flowers->find('first', array(
						'conditions' => $conditions
						)
					);
				if($flower){
					$data['flower'] = $flower['Flowers'];
				}
				
				$conditions = array('FlowerCategory.flower_id' => $id);
				$flowerCate = $this->FlowerCategory->find('all', array(
						'conditions' => $conditions
						)
					);
				if($flowerCate){
					foreach ($flowerCate as $value){
						$data['categories_selected'][] = $value['FlowerCategory']['category_id'];
					}
				}
			}
		}
		$data['categories'] = $this->Category->find('all',
					array( 'conditions' => array(
							'Category.type' => CATEGORY_TYPE_FLOWER,
							'Category.is_active' => ACTIVE
							))
				);
		
		$this->set('data', $data);
	}
	
	private function _save($flower) {
		$data = array('error' => null, 'success' => null);
		if ($this->request->is('post')) {
			$data['flower'] = $flower;
			$categoriesSelected = @$data['flower']['categories_selected'];
			if(empty($categoriesSelected)){
				$data['error'] = 'Bạn chưa chọn danh mục.';
				$data['categories_selected'] = array();
			}
			else{
				foreach ($categoriesSelected as $key => $value){
					$data['categories_selected'][] = $key;
				}
			}
			
			if(empty($data['flower']['id'])){
				if(empty($_FILES['image']) || $_FILES['image']['error'] > 0){
					$data['error'] = 'Bạn phải chọn hình ảnh.';
				}
			}
			else {
				unset($data['flower']['image']);
				unset($data['flower']['thumb']);
			}
			$data['flower']['price'] = 0;
			if(!is_numeric($data['flower']['price'])){
				$data['error'] = 'Bạn nhập giá tiền không hợp lệ.';
			}
				
			if(empty($data['flower']['name'])){
				$data['error'] = 'Bạn chưa nhập tên giỏ hoa.';
			}
			
			if(empty($data['error'])){
				if(!empty($data['flower']['id']) && intval($data['flower']['id']) > 0){ // edit
					
					// up hinh
					if($_FILES['image']['error'] == 0){
						$data['flower']['image'] = $this->_uploadFile();
						$data['flower']['thumb'] = $data['flower']['image'];
					}
					
					$this->Flowers->id = $data['flower']['id'];
					$id = $data['flower']['id'];
					if ($this->Flowers->save($data['flower'])){
						$this->FlowerCategory->deleteAll(array('FlowerCategory.flower_id' => $id), true);
						$data['success'] = 'Lưu giỏ hoa thành công.';
					}
				}
				else{ //add
					
					// up hinh
					if($_FILES['image']['error'] == 0){
						$data['flower']['image'] = $this->_uploadFile();
						$data['flower']['thumb'] = $data['flower']['image'];
					}
					
					if($data['flower']['image'] && $data['flower']['thumb']){
						$this->Flowers->create();
						if ($this->Flowers->save($data['flower'])){
							$id = $this->Flowers->id;
							$data['success'] = 'Lưu giỏ hoa thành công.';
							
						}
						else {
							$data['error'] = 'Lưu giỏ hoa bị lỗi.';
						}
					}
					else
						$data['error'] = 'Đăng tải hình ảnh bị lỗi';
				}
				if($data['success']){
					foreach ($categoriesSelected as $key => $value){
						$item = array(
								'flower_id' => $id,
								'category_id' => $key
								);
						$this->FlowerCategory->create();
						$this->FlowerCategory->save($item);
					}
					$data['flower'] = array();
					$data['categories_selected'] = array();
				}
			}
		}
		
		return $data;
	}
	
	public function delete($id){
		$flower = $this->Flowers->find('first', array('conditions' => array('id' => $id)));
		if($flower){
			$fileImage = new File(IMAGE_UPLOAD_DIR.IMAGE_FLOWER_DIR.$flower['Flowers']['image'], true, 0777);
			if($fileImage->exists())
				 $fileImage->delete();
			
			$fileThumb = new File(IMAGE_UPLOAD_DIR.IMAGE_FLOWER_THUMB_DIR.$flower['Flowers']['thumb'], true, 0777);
			if($fileThumb->exists()&& $fileThumb->delete()){
				$this->Flowers->delete($id, true);
				$this->FlowerCategory->deleteAll(array('FlowerCategory.flower_id' => $id), true);
				$this->Session->setFlash(__('Xóa giỏ hoa thành công.'), 'flash_success');
			}
		}
		else{
			echo "";
			$this->Session->setFlash(__('Xóa giỏ hoa bị lỗi. Hãy thử lại.'), 'flash_error');
		}
		return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
	}
	
	private function _uploadFile($fileName = null)
	{
		$fileName =  $this->Common->uploadFile($_FILES['image'], IMAGE_FLOWER_DIR, $fileName);
		if($fileName){
			$fileName = $this->Common->resizeAndUploadFile($_FILES['image'], IMAGE_FLOWER_THUMB_WIDTH, IMAGE_FLOWER_THUMB_HEIGHT, IMAGE_FLOWER_THUMB_DIR, $fileName);
		}
		return $fileName;
	}
}
