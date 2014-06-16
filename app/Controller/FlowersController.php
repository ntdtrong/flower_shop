<?php
App::uses('AppController', 'Controller');
App::uses('ImageManipulator', 'Vendor/image-utils');
class FlowersController extends AppController {
	public $uses = array('Category', 'Flowers');
	public function index() {
		$this->redirect('add');
	}
	
	public function add() {
		$data = array('error' => null, 'success' => null);
		if ($this->request->is('post')) {
			$data['flower'] = $this->request->data;
			if(!is_numeric($data['flower']['price'])){
				$data['error'] = 'Nhập giá tiền không hợp lệ';
			}
			
			if(empty($data['flower']['name'])){
				$data['error'] = 'Nhập tên giỏ hoa';
			}
			
			if(empty($data['flower']['category'])){
				$data['error'] = 'Chọn danh mục';
			}
			
			if(empty($_FILES['image']) || $_FILES['image']['error'] > 0){
				$data['error'] = 'Chọn hình ảnh';
			}
			
			if(empty($data['error'])){
				// up hinh
				$data['flower']['image'] = $this->_sizeAndUploadFile($_FILES['image']);
			//	$data['flower']['thumb'] = $this->_uploadFile($_FILES['image'], 'thumb');
				
				$this->Flowers->create();
				if ($this->Flowers->save($data['flower'])){
					$data['success'] = 'Tạo giỏ hoa thành công.';
					$data['flower'] = array();
				}
				else {
					$data['error'] = 'Tạo giỏ hoa bị lỗi.';
				}
			}
// 			pr($_FILES);
// 			pr($this->request->data);
		}
		
		
		$data['categories'] = $this->Category->find('all');
		if(empty($data['flower']['category']) && $data['categories']){
			$data['flower']['category'] = @$data['categories'][0]['Category']['id'];
		}
		$this->set('data', $data);
	}
	
	public function _uploadFile($file, $dir = 'image' , $id = null)
	{
		require_once('ImageManipulator.php');
		
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
		$width  = $manipulator->getWidth();
		$height = $manipulator->getHeight();
		
		if($width >$regWidth || $height > $regHeight){
			
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
			
			$centreX = round($width / 2);
			$centreY = round($height / 2);
			// our dimensions will be 200x130
			$x1 = $centreX - $regWidth/2;
			$y1 = $centreY - $regHeight/2;
			
			$x2 = $centreX + $regWidth/2;
			$y2 = $centreY + $regHeight/2;
			
			// center cropping to 200x130
			$manipulator->crop($x1, $y1, $x2, $y2);
		}
		// saving file to uploads folder
		$uploads_dir = APP. 'webroot'. DS .'img' . DS . $dir . DS . $fileName;
		$uploads_dir_thumd = APP. 'webroot'. DS .'img' . DS . 'thumb' . DS . $fileName;
		$manipulator->save($uploads_dir);
		$manipulator->save($uploads_dir_thumd);
		return $fileName;
	}
}
