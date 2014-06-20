<?php
App::uses('AppController', 'Controller');
class CompaniesController extends AppController {
	public function index($category = 0) {
		$data = array();
		if($this->request->is('post')){
			$company = $this->request->data;
			if(empty($company['address'])){
				$data['error'] = 'Địa chỉ không hợp lệ';
			}
			
			if(empty($company['full_name'])){
				$data['error'] = 'Tên đầy đủ không hợp lệ';
			}
			
			if(empty($company['name'])){
				$data['error'] = 'Tên của hàng không hợp lệ';
			}
			
			if(empty($data['error']) && !empty($company['id'])){
				$this->Company->id = $company['id'];
				if($this->Company->save($company)){
					$data['success'] = 'Cập nhật thông tin của hàng thành công';
					$this->set('company', $company);
				}
				else{
					$data['error'] = 'Cập nhật thông tin của hàng thất bại. Hãy thử lại';
				}
			}
		}
		$company = $this->Company->find('first');
		$data['company'] = @$company['Company'];
		$this->set('data', $data);
	}
}
