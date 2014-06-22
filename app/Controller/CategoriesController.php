<?php
App::uses('AppController', 'Controller');
App::uses('ErrorObject', 'Vendor/error-object');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::uses('File', 'Utility');
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
	
	private function _save($category){
		$rs = array();
// 		pr($category);
// 		pr($_FILES);
		if(empty($category['name'])){
			$rs['error'] = 'Ten danh muc khong hop le';
			return $rs;
		}
		
		if(!empty($category['id']) && intval($category['id']) > 0){ //edit
			$oldCate = $this->Category->find('first', array(
					'conditions' => array('id' => $category['id'])
			));
			
			if(!$oldCate){
				$rs['error'] = 'Danh muc nay khong ton tai';
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
/*
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
*/
	public function delete($id){
		$cate = $this->Category->find('first', array('conditions' => array('id' => $id)));
		if($cate){
			if($cate['Category']['image']){
				$fileImage = new File(IMAGE_UPLOAD_DIR.IMAGE_BANNER_DIR.$cate['Category']['image'], true, 0777);
				if($fileImage->exists())
					$fileImage->delete();
			}
			
			$this->Category->delete($id);
			echo "OK";
		}
		else{
			echo ErrorObject::$MESSAGE[ErrorObject::C_CATEGORY_NOT_EXIST];
		}
		exit;
	}
	
	/***
	 * Resize and upload banner
	 * width : 800
	 * height : 300
	 * dir : banner
	 */
	
	/*
	private function _uploadBanner($fileName = null){
		return $this->Common->resizeAndUploadFile($_FILES['image'], IMAGE_BANNER_WIDTH, IMAGE_BANNER_HEIGHT, IMAGE_BANNER_DIR, $fileName);
	}
	*/
	
	
	/*
	public function _resizeAndUploadFile($file, $regWidth = 800, $regHeight = 300,  $dir = 'banner' , $fileName = null)
	{
		if(empty($fileName)){
			$fileName = time().'.jpg';
		}
	
		$manipulator = new ImageManipulator($file['tmp_name']);
	
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
		$uploads_dir = APP. 'webroot'. DS .'img' . DS . $dir . DS . $fileName;
		$manipulator->save($uploads_dir);
		return $fileName;
	}
*/
}
