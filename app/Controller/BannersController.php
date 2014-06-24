<?php
App::uses('AppController', 'Controller');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::uses('File', 'Utility');
class BannersController extends AppController {
	public $uses = array('Banner');
	public function index($id = 0) {
		$data = array();
		$data['banners'] = $this->Banner->find('all');
		$this->set('data', $data);
	}
	
	public function add(){
		$data = array();
		if ($this->request->is('post')) {
			$data['banner'] = $this->request->data;
			$rs = $this->_save($data['banner']);
			if(!empty($rs['banner'])){
				$this->Session->setFlash(__('Lưu banner thành công.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		$this->set('data', $data);
	}
	
	public function edit($id){
		$data = array();
		if ($this->request->is('post')) {
			$data['banner'] = $this->request->data;
			$rs = $this->_save($data['banner']);
			if(!empty($rs['banner'])){
				$this->Session->setFlash(__('Lưu banner thành công.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		else{
			if(is_numeric($id) && intval($id) > 0){
				$item = $this->Banner->find('first', array('conditions' => array('id' => $id)));
				$data['banner'] = @$item['Banner'];
			}
		}
		$this->set('data', $data);
	}
	
	private function _save($banner){
		$rs = array();
		if(!empty($banner['id']) && intval($banner['id']) > 0){ //edit
			$oldCate = $this->Banner->find('first', array(
					'conditions' => array('id' => $banner['id'])
			));
			
			if(!$oldCate){
				$rs['error'] = 'Danh mục này không tồn tại';
				return $rs;
			}
			
			if((!empty($_FILES['image']) && intval($_FILES['image']['error'] == 0))){
				$banner['image'] = $this->_uploadBanner(@$oldCate['Banner']['image']);
				if(!$banner['image']){
					$rs['error'] = 'Tải hình lên bị lỗi. Hãy thử lại.';
					return $rs;
				}
			}
			else{
				$banner['image'] = @$oldCate['Banner']['image'];
			}
			
			if(empty($banner['image'])){
				$rs['error'] = 'Bạn phải chọn hình để làm banner.';
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
					$rs['error'] = 'Tải hình lên bị lỗi. Hãy thử lại.';
					return $rs;
				}
			}
			
			if(empty($banner['image'])){
				$rs['error'] = 'Bạn phải chọn hình để làm banner.';
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
			$this->Session->setFlash(__('Xóa banner thành công.'), 'flash_success');
		}
		else{
			$this->Session->setFlash(__('Banner này không tồn tại.'), 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
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
