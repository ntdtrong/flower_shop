<?php
App::uses('AppController', 'Controller');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::uses('File', 'Utility');
class BannersController extends AppController {
	public $uses = array('Banner');
	public function index($id = 0) {
		$data = array();
		
		if ($this->request->is('post')) {
			$data['banner'] = $this->request->data;
			$rs = $this->_save($data['banner']);
			if(!empty($rs['banner'])){
				$data['banner'] = array();
				$data['success'] = 'Lưu tài khoản thành công';
			}
			else{
				$data['error'] = $rs['error'];
			}
		}
		else if($this->request->is('get')){
			if(is_numeric($id) && intval($id) > 0){
				$item = $this->Banner->find('first', array('conditions' => array('id' => $id)));
				$data['banner'] = @$item['Banner'];
			}
		}
		
		$data['banners'] = $this->Banner->find('all');
		$this->set('data', $data);
	}
	
	private function _save($banner){
		$rs = array();
		if(!empty($banner['id']) && intval($banner['id']) > 0){ //edit
			$oldCate = $this->Banner->find('first', array(
					'conditions' => array('id' => $banner['id'])
			));
			
			if(!$oldCate){
				$rs['error'] = 'Danh muc nay khong ton tai';
				return $rs;
			}
			
			if((!empty($_FILES['image']) && intval($_FILES['image']['error'] == 0))){
				$banner['image'] = $this->_uploadBanner(@$oldCate['Banner']['image']);
				if(!$banner['image']){
					$rs['error'] = 'Dang tai hinh bi loi. Hay thu lai';
					return $rs;
				}
			}
			else{
				$banner['image'] = @$oldCate['Banner']['image'];
			}
			
			if(empty($banner['image'])){
				$rs['error'] = 'Ban phai chon hinh de lam banner';
				return $rs;
			}
			
			$this->Banner->id = $banner['id'];
			if($this->Banner->save($banner)){
				$rs['banner'] = $banner;
			}
		}
		else{ // add
			
			if((!empty($_FILES['image']) && intval($_FILES['image']['error'] == 0))){
				$banner['image'] = $this->_uploadBanner();
				if(!$banner['image']){
					$rs['error'] = 'Dang tai hinh bi loi. Hay thu lai';
					return $rs;
				}
			}
			
			if(empty($banner['image'])){
				$rs['error'] = 'Ban phai chon hinh de lam banner';
				return $rs;
			}
			
			$this->Banner->create();
			if($this->Banner->save($banner)){
				$rs['banner'] = $banner;
			}
		}
		return $rs;
	}
	
	public function delete($id){
		$cate = $this->Banner->find('first', array('conditions' => array('id' => $id)));
		if($cate){
			if($cate['Banner']['image']){
				$fileImage = new File(IMAGE_UPLOAD_DIR.IMAGE_BANNER_DIR.$cate['Banner']['image'], true, 0777);
				if($fileImage->exists())
					$fileImage->delete();
			}
			
			$this->Banner->delete($id);
			echo "OK";
		}
		else{
			echo 'Banner nay khong ton tai';
		}
		exit;
	}
	
	/***
	 * Resize and upload banner
	 * width : 800
	 * height : 300
	 * dir : banner
	 */
	private function _uploadBanner($fileName = null){
		return $this->Common->resizeAndUploadFile($_FILES['image'], IMAGE_BANNER_WIDTH, IMAGE_BANNER_HEIGHT, IMAGE_BANNER_DIR, $fileName);
	}
}
