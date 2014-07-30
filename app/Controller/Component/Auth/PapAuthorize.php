<?php
App::uses('BaseAuthorize', 'Controller/Component/Auth');
App::uses('CakeSession', 'Model/Datasource');
class PapAuthorize extends BaseAuthorize {
	public function authorize($user, CakeRequest $request) {
		pr('vo day');
		if ($request->params['action'] == 'logout') {
			return true;
		}
		
		$this->_Controller->Session->write('Auth.User', $user);
		return true;
	}
}