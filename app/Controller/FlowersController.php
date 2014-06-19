<?php
App::uses('AppController', 'Controller');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::uses('File', 'Utility');
class FlowersController extends AppController {
	public $uses = array('Category', 'Flowers', 'FlowerCategory');
	public $helpers = array('Form', 'Html');
	public function index() {
		$this->redirect('add');
	}
	/*
	public function dialogAdd() {
		$data = array('error' => null, 'success' => null);
		if ($this->request->is('post')) {
			$data['flower'] = $this->request->data;
			//	pr($data);exit;
			if(!is_numeric($data['flower']['price'])){
				$data['error'] = 'Nhập giá tiền không hợp lệ';
			}
				
			if(empty($data['flower']['name'])){
				$data['error'] = 'Nhập tên giỏ hoa';
			}
				
			$categoriesSelected = @$data['flower']['categories_selected'];
			if(empty($categoriesSelected)){
				$data['error'] = 'Chọn danh mục';
			}
				
			if(empty($_FILES['image']) || $_FILES['image']['error'] > 0){
				$data['error'] = 'Chọn hình ảnh';
			}
				
			if(empty($data['error'])){
				// up hinh
				$data['flower']['image'] = $this->_sizeAndUploadFile($_FILES['image']);
				$data['flower']['thumb'] = $data['flower']['image'];
		
				if($data['flower']['image'] && $data['flower']['thumb']){
					$this->Flowers->create();
					if ($this->Flowers->save($data['flower'])){
						$flowerId = $this->Flowers->id;
		
						foreach ($categoriesSelected as $key => $value){
							$item = array(
									'flower_id' => $flowerId,
									'category_id' => $key
							);
							$this->FlowerCategory->create();
							$this->FlowerCategory->save($item);
						}
						$data['success'] = 'Tạo giỏ hoa thành công.';
						$data['flower'] = array();
					}
					else {
						$data['error'] = 'Tạo giỏ hoa bị lỗi.';
					}
				}
				else
					$data['error'] = 'Đăng tải hình ảnh bị lỗi';
		
			}
			// 			pr($_FILES);
			// 			pr($this->request->data);
		}
		
		
		$data['categories'] = $this->Category->find('all');
		$data['categories_selected'] = array();
		if(!empty($data['flower']['categories_selected'])){
			foreach ($data['flower']['categories_selected'] as $key => $value){
				$data['categories_selected'][] = $key;
			}
		}
		
		$this->set('data', $data);
	}
	
	*/
	public function add($id = 0) {
		$data = array('error' => null, 'success' => null);
		$data['categories_selected'] = array();
		if ($this->request->is('post')) {
			$data['flower'] = $this->request->data;
//			pr($_FILES['image']);
//	pr($data);exit;
			if(!is_numeric($data['flower']['price'])){
				$data['error'] = 'Nhập giá tiền không hợp lệ';
			}
			
			if(empty($data['flower']['name'])){
				$data['error'] = 'Nhập tên giỏ hoa';
			}
			
			$categoriesSelected = @$data['flower']['categories_selected'];
			if(empty($categoriesSelected)){
				$data['error'] = 'Chọn danh mục';
			}
			else{
				foreach ($categoriesSelected as $key => $value){
					$data['categories_selected'][] = $key;
				}
			}
			
			if(empty($data['flower']['id'])){
				if(empty($_FILES['image']) || $_FILES['image']['error'] > 0){
					$data['error'] = 'Chọn hình ảnh';
				}
			}
			else {
				unset($data['flower']['image']);
				unset($data['flower']['thumb']);
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
		
		
		$data['categories'] = $this->Category->find('all');
		
		$this->set('data', $data);
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
				echo "OK";
			}
		}
		else{
			echo "Xóa giỏ hoa bị lỗi";
		}
		exit;
	}
	
	private function _uploadFile($fileName = null)
	{
		$fileName =  $this->Common->uploadFile($_FILES['image'], IMAGE_FLOWER_DIR, $fileName);
		if($fileName){
			$fileName = $this->Common->resizeAndUploadFile($_FILES['image'], IMAGE_FLOWER_THUMB_WIDTH, IMAGE_FLOWER_THUMB_HEIGHT, IMAGE_FLOWER_THUMB_DIR, $fileName);
		}
		return $fileName;
	}
/*	
	public function _sizeAndUploadFile($file, $dir = 'image' , $id = null)
	{
		$regWidth = 300;
		$regHeight = 250;
		
		if(empty($id)){
			$id = time();
		}
		$fileName = $id.'.jpg';
		
		$newNamePrefix = time() . '_';
		$manipulator = new ImageManipulator($file['tmp_name']);
		$uploads_dir = APP. 'webroot'. DS .'img' . DS . 'image' . DS . $fileName;
		$manipulator->save($uploads_dir);
		
		$width  = $manipulator->getWidth();
		$height = $manipulator->getHeight();
		
		if($width > $regWidth || $height > $regHeight){
			
			if($width > $regWidth && $height > $regHeight){
				$w = $regWidth;
				$h = $regHeight;
				if($width/$regWidth > $height/$regHeight){
					$w = $width * $regHeight / $height;
				}
				else{
					$h = $height * $regWidth / $width;
				}
				$width = $w;
				$height = $h;
				$manipulator->resample($w, $h);
			}
			else{
				if($width  < $regWidth){
					$regHeight = $regHeight * $width/$regWidth;
					$regWidth = $width;
						
				}
				else{
					$regWidth = $regWidth * $height/$regHeight;
					$regHeight = $height;
				}
			}
		}
		else{
			$regHeight = $regHeight * $width / $regWidth;
			$regWidth = $width;
		}
		
		
		$centreX = round($width / 2);
		$centreY = round($height / 2);
		// our dimensions will be 200x130
		$x1 = $centreX - $regWidth/2;
		$y1 = $centreY - $regHeight/2;
		
		$x2 = $centreX + $regWidth/2;
		$y2 = $centreY + $regHeight/2;
		
		// center cropping to 200x130
		$manipulator->crop($x1, $y1, $x2, $y2);
		
		// saving file to uploads folder
		$uploads_dir_thumd = APP. 'webroot'. DS .'img' . DS . 'thumb' . DS . $fileName;
		$manipulator->save($uploads_dir_thumd);
		return $fileName;
	}
	*/
}
