<?php
App::uses('AppController', 'Controller');
class DashboardsController extends AppController {
	public $uses = array();

	public function index(){
		$result = array('data' => 12121212313);
		$this->viewClass = 'Json';
		$this->set(compact('result'));
		$this->set('_serialize', array('result'));
	}
}
