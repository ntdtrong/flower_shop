<?php
App::uses('AppController', 'Controller');
class CompaniesController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	
	public function index() {
		return $this->redirect(array( 'action' => 'edit'));
	}
	public function edit() {
		$data = array();
		if($this->request->is('post')){
			$company = $this->request->data;
			$error = false;
			if(empty($company['name'])){
				$error = true;
				$this->Session->setFlash(__('Tên của hàng không hợp lệ.'), 'flash_error');
			}
			
			if(empty($company['full_name'])){
				$error = true;
				$this->Session->setFlash(__('Tên đầy đủ không hợp lệ.'), 'flash_error');
			}
			
			if(empty($company['address'])){
				$error = true;
				$this->Session->setFlash(__('Địa chỉ cửa hàng không hợp lệ.'), 'flash_error');
			}
			
			if(!$error && !empty($company['id'])){
				$this->Company->id = $company['id'];
				if($this->Company->save($company)){
					$this->Session->setFlash(__('Cập nhật thông tin của hàng thành công.'), 'flash_success');
					$this->set('company', $company);
				}
				else{
					$this->Session->setFlash(__('Cập nhật thông tin của hàng thất bại. Hãy thử lại.'), 'flash_error');
				}
			}
		}
		$company = $this->Company->find('first');
		$data['company'] = @$company['Company'];
		$this->set('data', $data);
	}
}
