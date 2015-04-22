<?php
App::uses('CakeSession', 'Model/Datasource');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
App::uses('ImageManipulator', 'Vendor/image-utils');
App::import('Lib', 'Utils');
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
	
	/**
	 * Require login to use this function
	 * @param unknown $accountId
	 * @param unknown $newPassword
	 * @param unknown $oldPassword
	 * @return boolean
	 */
	public function changePwd($accountId,  $newPassword, $oldPassword) {
		Utils::useModels($this, array('User'));
		$account = $this->User->find('first', array('conditions'=>array(
				'User.id' => $accountId
		)));
		if (!empty($account)) {
			//validate old password
			$blowfishPasswordHasher = new BlowfishPasswordHasher();
			if ($blowfishPasswordHasher->check($oldPassword, $account['User']['password'])) {
				//update password
				$this->User->id = $accountId;
				$this->User->saveField('password', $blowfishPasswordHasher->hash($newPassword));
				return true;
			}
	
		}
		return false;
	}
	
	public function sendEmail($to, $subject, $content){
		$email = new CakeEmail('email');
		$email->template('default', 'send_username');
		$email->emailFormat('html');
		$email->to($to);
		$email->subject($subject);
		return $email->send($content);
	}
	
	public function resizeAndUploadFile($file, $regWidth = 800, $regHeight = 300,  $dir = 'banner' , $fileName = null)
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
	
	
		/*$centreX = round($width / 2);
		$centreY = round($height / 2);
	
		// our dimensions will be 200x130
		$x1 = $centreX - $regWidth/2;
		$y1 = $centreY - $regHeight/2;
	
		$x2 = $centreX + $regWidth/2;
		$y2 = $centreY + $regHeight/2;
	
		// center cropping to 200x130
		$manipulator->crop($x1, $y1, $x2, $y2);*/
	
		// saving file to uploads folder
		$uploads_dir = IMAGE_UPLOAD_DIR . $dir . $fileName;
		$manipulator->save($uploads_dir);
		return $fileName;
	}
	
	public function uploadFile($file, $dir = 'image' , $fileName = null)
	{
		if(empty($fileName)){
			$fileName = time().'.jpg';
		}
		$manipulator = new ImageManipulator($file['tmp_name']);
		// saving file to uploads folder
		$uploads_dir = IMAGE_UPLOAD_DIR . $dir . $fileName;
		$manipulator->save($uploads_dir);
		return $fileName;
	}
}