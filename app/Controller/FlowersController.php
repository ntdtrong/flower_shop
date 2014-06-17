<?php
App::uses('AppController', 'Controller');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::uses('File', 'Utility');
class FlowersController extends AppController {
	public $uses = array('Category', 'Flowers', 'FlowerCategory');
	public $helpers = array('Form', 'Html');
	public function index() {
		//$this->redirect('add');
	}
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
	public function add() {
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
	
	public function delete($id){
		$flower = $this->Flowers->find('first', array('conditions' => array('id' => $id)));
		if($flower){
			$file = new File(IMAGE_URL.$flower['Flowers']['image'], true, 0755);
			if($file->exists())
				$file->delete();
			
			$file = new File(IMAGE_URL.$flower['Flowers']['thumb'], true, 0755);
			if($file->exists())
				$file->delete();
			
			$this->Flowers->delete($id, true);
			$this->FlowerCategory->deleteAll(array('FlowerCategory.flower_id' => $id), true);
			echo "OK";
		}
		else{
			echo "Xóa giỏ hoa bị lỗi";
		}
		exit;
	}
	
	public function _uploadFile($file, $dir = 'image' , $id = null)
	{
		$tmp_name = $file["tmp_name"];
		$name =$file["name"];
		if(empty($id)){
			$id = time();
		}
		$fileName = $id.'.jpg';
		$uploads_dir = APP. 'webroot'. DS .'img' . DS . $dir . DS . $fileName;
		move_uploaded_file($tmp_name, $uploads_dir);
		return $fileName;
	}
	
	public function _sizeAndUploadFile($file, $dir = 'image' , $id = null)
	{
		//require_once('ImageManipulator.php');
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
			
			if($width  < $regWidth)
				$regWidth = $width;
			if($height < $regHeight)
				$regHeight = $height;
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
}
