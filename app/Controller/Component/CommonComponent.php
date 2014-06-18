<?php
App::uses('CakeSession', 'Model/Datasource');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
class CommonComponent extends Component {
	protected $controller;
	
	public function startup(Controller $controller) {
		$this->controller = $controller;
	}
	
	public function initialize(Controller $controller) {
		$this->controller = $controller;
	}
	
	public function encodePassword($pwd){
		$blowfishPasswordHasher = new BlowfishPasswordHasher();
		return $blowfishPasswordHasher->hash($pwd);
	}
	
	public function sendEmail($to, $subject, $content){
		$email = new CakeEmail('email');
		$email->template('default', 'send_username');
		$email->emailFormat('html');
		$email->to($to);
		$email->subject($subject);
		return $email->send($content);
	}
}