<?php
App::import('Lib', 'Utils');
App::uses('AppController', 'Controller');
class UsersController extends AppController {
	public $uses = array('User');
	
	public function beforeFilter() {
		parent::beforeFilter();
	
		$this->Auth->allow(array('login', 'logout', 'index'));
	}
	
	public function index() {
		$data = array(
			'users' => array()
		);
		
// 		if ($this->request->is('post')) {
// 			$data['user'] = $this->request->data;
// // 			pr($data['user']);
// 			$rs = $this->_save($data['user']);
// 			if(!empty($rs['user'])){
// 				if(empty($data['user']['id']))
// 					$data['success'] = 'Lưu tài khoản thành công. Mật khẩu mặc định là: 12345678';
// 				else
// 					$data['success'] = 'Lưu tài khoản thành công';
// 				$data['user'] = array();
// 			}
// 			else{
// 				$data['error'] = $rs['error'];
// 			}
// 		}
// 		else if($this->request->is('get')){
// 			if(is_numeric($id) && intval($id) > 0){
// 				$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
// 				$data['user'] = @$user['User'];
// 				unset($data['user']['password']);
// 			}
				
// 		}
		
		
		$data['users'] = $this->User->find('all');
		$this->set('data', $data);
	}
	
	public function add(){
		$data = array();
		if ($this->request->is('post')) {
			$data['user'] = $this->request->data;
			$rs = $this->_save($data['user']);
			if(!empty($rs['user'])){
				$this->Session->setFlash(__('Lưu tài khoản thành công. Mật khẩu mặc định là: 12345678'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$data['error'] = $rs['error'];
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		
		$this->set('data', $data);
	}
	
	public function edit($id){
		$data = array();
		if ($this->request->is('post')) {
			$data['user'] = $this->request->data;
			$rs = $this->_save($data['user']);
			if(!empty($rs['user'])){
				$this->Session->setFlash(__('Lưu tài khoản thành công.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$data['error'] = $rs['error'];
				$this->Session->setFlash(__($rs['error']), 'flash_error');
			}
		}
		else{
			if(is_numeric($id) && intval($id) > 0){
				$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
				$data['user'] = @$user['User'];
				unset($data['user']['password']);
			}
		}
		
		$this->set('data', $data);
	}
	private function _save($user){
		$rs = array();
		if(empty($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)){
			$rs['error'] = 'Email không hợp lệ';
			return $rs;
		}
		
		if(empty($user['first_name'])){
			$rs['error'] = 'Họ không hợp lệ';
			return $rs;
		}
		if(empty($user['last_name'])){
			$rs['error'] = 'Tên không hợp lệ';
			return $rs;
		}
		
		if(!empty($user['id']) && intval($user['id'])){ // edit
			unset($user['password']);
			unset($user['role']);
			
			$oldUser = $this->User->find('first', array('conditions' => array('User.email' => $user['email'])));
			if($oldUser && $oldUser['User']['id'] !== $user['id']){
				$rs['error'] = 'Email đã được sử dụng';
				return $rs;
			}
			
			$this->User->id = $user['id'];
			if($this->User->save($user)){
				$rs['user'] = $user;
			}
			else{
				$rs['error'] = 'Lưu tài khoản không thành công';
			}
		}
		else{ // add
// 			if(empty($user['password']) || strlen($user['password']) < 8){
// 				$rs['error'] = 'Mật khẩu không hợp lệ. Mật khẩu phải có ít nhất 8 ký tự';
// 				return $rs;
// 			}
// 			if($user['password'] !== $user['password_confirm']){
// 				$rs['error'] = 'Mật khẩu xác nhận không đúng';
// 				return $rs;
// 			}
			
			Utils::useComponents($this, array('Common'));
			$password = '12345678';//Utils::generatePassword();
			$user['password'] = $this->Common->encodePassword($password);
			
			$oldUser = $this->User->find('first', array('conditions' => array('User.email' => $user['email'])));
			if($oldUser){
				$rs['error'] = 'Email đã được sử dụng';
				return $rs;
			}
			
			$user['role'] = ROLE_MANAGER;
			
			$this->User->create();
			if($this->User->save($user)){
				$rs['user'] = $user;
				try {
					$this->Common->sendEmail($user['email'], 'Shop Hoa', $password);
				} catch (Exception $e) {
				}
			}
			else{
				$rs['error'] = 'Lưu tài khoản không thành công';
			}
			
		}
		return $rs;
	}
	
	public function delete($id){
		$user = $this->User->find('first', array('conditions' => array('id' => $id)));
		if($user){
			$this->User->delete($id);
			$this->Session->setFlash(__('Xóa tài khoản thành công.'), 'flash_success');
		}
		else{
			$this->Session->setFlash(__("Tài khoản này không tồn tại."), 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function resetpwd($id){
		$user = $this->User->find('first', array('conditions' => array('id' => $id)));
		if($user){
			Utils::useComponents($this, array('Common'));
			$password = '12345678';//Utils::generatePassword();
			$user['User']['password'] = $this->Common->encodePassword($password);
			
			$this->User->id = $user['User']['id'];
			if($this->User->save($user)){
				try {
					$this->Common->sendEmail($user['User']['email'], 'Shop Hoa', $password);
				} catch (Exception $e) {
				}
				$this->Session->setFlash(__('Reset mật khẩu thành công. Mật khẩu mặc định là: 12345678'), 'flash_success');
			}
			else{
				$this->Session->setFlash(__("Reset mật khẩu không thành công."), 'flash_error');
			}
		}
		else{
			$this->Session->setFlash(__("Tài khoản này không tồn tại."), 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function changepwd(){
		if(!$this->Auth->user('id')){
			return $this->redirect($this->Auth->logout());
		}
		if ($this->request->is('post')) {
			$error = false;
			$user = $this->request->data;
			if(empty($user['new_password']) || strlen($user['new_password']) < 8){
				$error = true;
				$this->Session->setFlash(__("Mật khẩu không hợp lệ. Mật khẩu phải có ít nhất 8 ký tự."), 'flash_error');
			}
			if($user['new_password'] !== $user['confirm']){
				$error = true;
				$this->Session->setFlash(__("Mật khẩu xác nhận không đúng."), 'flash_error');
			}
			
			if(!$error){
				if($this->Common->changePwd($this->Auth->user('id'), $user['new_password'], $user['old_password'])){
					$this->Session->setFlash(__('Mật khẩu đã được thay đổi.'), 'flash_success');
				}
				else{
					$this->Session->setFlash(__("Mật khẩu hiện tại không đúng."), 'flash_error');
				}
			}
		}
	}
	
	public function login() {
		if ($this->request->is('post')) {
			$error = false;
			if(empty($this->request->data['User']['password'])){
				$this->Session->setFlash(__("Hãy nhập mật khẩu."), 'flash_error');
				$error = true;
			}
			if(empty($this->request->data['User']['email'])){
				$this->Session->setFlash(__("Hãy nhập email."), 'flash_error');
				$error = true;
			}
			if(!$error){
				if ($this->Auth->login()) {
					return $this->redirect('/homes');
				} else {
					$this->Session->setFlash(__("Email hoặc mật khẩu không đúng. Hãy thử lại."), 'flash_error');
				}
			}
			
		} else {
			if ( $this->Auth->user('id') ) {
				return $this->redirect($this->Auth->redirect());
			}
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
