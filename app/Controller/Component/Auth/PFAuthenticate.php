<?php
App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class PFAuthenticate extends BaseAuthenticate {
	/**
	 * Checks the fields to ensure they are supplied.
	 *
	 * @param CakeRequest $request The request that contains login information.
	 * @param string $model The model used for login verification.
	 * @param array $fields The fields to be checked.
	 * @return boolean False if the fields have not been supplied. True if they exist.
	 */
	protected function _checkFields(CakeRequest $request, $model, $fields) {
// 		pr($model);exit;
		if (empty($request->data[$model])) {
			return false;
		}
		
		foreach (array($fields['username'], $fields['password']) as $field) {
			$value = $request->data($model . '.' . $field);
			if (empty($value) || !is_string($value)) {
				return false;
			}
		}
		return true;
	}
	
	protected function _findUser($username, $password = null) {
		$userModel = $this->settings['userModel'];
		$userModelObj = ClassRegistry::init($userModel);
		$model = $userModelObj->alias;
		
		$fields = $this->settings['fields'];
		
		if (is_array($username)) {
			$conditions = $username;
		} else {
			$conditions = array(
					$model . '.' . $fields['username'] => $username
			);
		}

		if (!empty($this->settings['scope'])) {
			$conditions = array_merge($conditions, $this->settings['scope']);
		}

		$result = $userModelObj->find('first', array(
			'conditions' => $conditions,
			'recursive' => $this->settings['recursive'],
			'contain' => $this->settings['contain'],
		));
		
		if (empty($result[$model])) {
			$this->passwordHasher()->hash($password);
			return false;
		}
		$user = $result[$model];
		if ($password) {
			if (!$this->passwordHasher()->check($password, $user[$fields['password']])) {
				return false;
			}
			unset($user[$fields['password']]);
		}
		
		unset($result[$model]);
		return array_merge($user, $result);
	}
	
	/**
	 * Authenticates the identity contained in a request. Will use the `settings.userModel`, and `settings.fields`
	 * to find POST data that is used to find a matching record in the `settings.userModel`. Will return false if
	 * there is no post data, either username or password is missing, or if the scope conditions have not been met.
	 *
	 * @param CakeRequest $request The request that contains login information.
	 * @param CakeResponse $response Unused response object.
	 * @return mixed False on login failure. An array of User data on success.
	 */
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		
		$userModel = $this->settings['userModel'];
		$userModelObj = ClassRegistry::init($userModel);
		$model = $userModelObj->alias;
		$fields = $this->settings['fields'];
		if (!$this->_checkFields($request, $model, $fields)) {
			return false;
		}
		$username = $request->data[$model][$fields['username']];
		$password = $request->data[$model][$fields['password']];
		
		$user = $this->_findUser($username, $password);
		if(empty($user)) {
			return false;			
		}
		return $user;
	}
	
}