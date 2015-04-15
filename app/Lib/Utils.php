<?php
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');
App::uses('CakeSession', 'Model/Datasource');
class Utils {
	const FLOWER_CATEGORY_PARENT_BY_DESIGN = 'by_design';
	const FLOWER_CATEGORY_PARENT_BY_TOPIC = 'by_topic';
	
	protected static $rootCategoriesDisplay = array(
		self::FLOWER_CATEGORY_PARENT_BY_DESIGN => 'Hoa Thiết Kế',
		self::FLOWER_CATEGORY_PARENT_BY_TOPIC => 'Hoa Theo Chủ Đề'
	);
	
	public static function getRootCategoriesDisplay($parentId) {
		if (array_key_exists($parentId, self::$rootCategoriesDisplay)) {
			return self::$rootCategoriesDisplay[$parentId];
		} else {
			return '';
		}
	}
	
	public static function strRemoveLast($source, $patterns) {
		foreach ($patterns as $p) {
			$pos = strrpos($source, $p);
			$len = strlen($source) - strlen($p);
			if ($pos == $len) {
				return substr($source, 0, $len);
			}
		}
		return $source;
	}

	public static function formatDateForDisplay($date) {
		return date( "F j, Y", strtotime($date));
	}

	public static function generatePassword($length = 9, $strength = 0, $bNumber = false, $yodleePass = false) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		$numbers = '23456789';

		if ($strength & 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength & 2) {
			$vowels .= 'AEUY';
		}
		if ($strength & 4) {
			$consonants .= '23456789';
		}
		if ($strength & 8) {
			$consonants .= '@#$%';
		}

		$password = '';
		$alt = time() % 2;

		if ($yodleePass) {
			// Yodlee Restriction: Does not contain the same letter/number three or more times in a row
			// So prepend $alt before the new-generated char will help

			for ($i = 0; $i < $length; $i++) {
				if ($alt == 1) {
					$password .= $alt . $consonants[(rand() % strlen($consonants))];
					$alt = 0;
				} else {
					$password .= $alt . $vowels[(rand() % strlen($vowels))];
					$alt = 1;
				}
			}
		} else {
			for ($i = 0; $i < $length; $i++) {
				if ($alt == 1) {
					$password .= $consonants[(rand() % strlen($consonants))];
					$alt = 0;
				} else {
					$password .= $vowels[(rand() % strlen($vowels))];
					$alt = 1;
				}
			}
		}

		if ($bNumber) {
			$password .= $numbers[(rand() % strlen($numbers))];
		}

		return $password;
	}
	
	public static function encodePassword($rawPassword) {
		return Security::hash($rawPassword, 'blowfish', false);
	}

	public static function formatScore($score){
		return round($score*100, 1);
	}

	public static function matchString($description, $key){
		if (empty($key) || empty($description)) {
			return false;
		}

		$description = strtolower($description);
		$key = strtolower($key);
		if ( strpos($description, $key) !== FALSE ||
		strpos($key, $description) !== FALSE ) {
			return true;
		}
		return false;
	}

	public static function useModels($obj, $modelNames = array(), $cached = true) {
		if (is_subclass_of($obj, 'Controller') || is_subclass_of($obj, 'Shell')) {
			foreach ($modelNames as $modelClass) {
				$obj->loadModel($modelClass);
			}
		} else {
			foreach ($modelNames as $modelClass) {
				list($plugin, $modelClass) = pluginSplit($modelClass, true);
				if ( $cached && isset($obj->$modelClass) ) {
					continue;
				}

				$obj->{$modelClass} = ClassRegistry::init(array(
						'class' => $plugin . $modelClass, 'alias' => $modelClass
				));
				if (!$obj->{$modelClass}) {
					throw new MissingModelException($modelClass);
				}
			}

		} 
	}

	public static function useComponents($obj, $componentNames = array(), $cached = true) {
		$controller = $obj;
		if (is_subclass_of($obj, 'Controller')) {
			foreach ($componentNames as $componentName) {
				list($plugin, $com) = pluginSplit($componentName, true);
				$obj->$com = $obj->Components->load($componentName);
				if (method_exists($obj->$com, 'initialize')) {
					$obj->$com->initialize($controller);
				}
				if (method_exists($obj->$com, 'startup')) {
					$obj->$com->startup($controller);
				}
			}

		} else {
			App::import('Core', 'Controller');
			$controller =& new Controller();
			foreach ($componentNames as $componentName) {
				list($plugin, $com) = pluginSplit($componentName, true);
				if ( $cached && isset($obj->$com) ) {
					continue;
				}
				$obj->$com = $controller->Components->load($componentName);

				if (method_exists($obj->$com, 'initialize')) {
					$obj->$com->initialize($controller);
				}
				if (method_exists($obj->$com, 'startup')) {
					$obj->$com->startup($controller);
				}
			}

		}


	}
	/**
	 * remove leading, trailing
	 * and "more than one" space in between words
	 *
	 * @param String $string
	 * @return trim space string
	 */
	private static function trimSpace($string) {
		$pat[0] = "/^\s+/u";
		$pat[1] = "/\s{2,}/u";
		$pat[2] = "/\s+\$/u";
		$rep[0] = "";
		$rep[1] = " ";
		$rep[2] = "";
		$str = preg_replace($pat,$rep,$string);
		return $str;
	}
	public static function cleanupFreeText($str){
		// remove html tags
		// trim spaces
		return Utils::trimSpace(strip_tags($str));
	}
	/**
	 * Sanitize Int before import into database
	 *
	 * @param String $str
	 * @return sanitized int
	 */
	public static function sanitizeInt($str) {
		$ret = 0;
		$input = $str;
		if(is_numeric($input)) {
			$ret = @intval($input);
		}
		return $ret;
	}

	public static function renderCurrency($amount, $default = '') {
		if ($amount < 0) {
			return '-$' . number_format(-$amount, 2);
		} else if ($amount > 0) {
			return '$' . number_format($amount, 2);
		} else {
			return $default;
		}
	}

	public static function stringToNumber($s, $decimals = 2) {
		return number_format($s, $decimals, '.', '');
	}

	public static function formatNumber($s, $decimals = 2, $thousandsSep = true) {
		return number_format($s, $decimals, '.', $thousandsSep ? ',' : '');
	}

	public static function getPercentage($number, $precision = 0) {
		return round($number * 100, $precision)  ;
	}

	public static function roundNumber($number, $precision = 1) {
		return round($number, $precision);
	}
	public static function plusDays($date, $n = 1) {
		return strtotime($date . " + $n days");
	}

	public static function subtractDays($date, $n = 1) {
		return strtotime($date . " - $n days");
	}

	static function formatClientTime($dateTime, $timeZone = null, $format = CLIENT_COMMON_DATE_FORMAT) {
		if ( !$timeZone) {
			$timeZone = date_default_timezone_get();
		}
		return CakeTime::format($format, $dateTime, null,  new DateTimeZone($timeZone));
	}

	/**
	 * Sanitize text before import into database
	 *
	 * @param String $str
	 * @return sanitized string
	 */
	public static function sanitize($input,$options = array()) {
		if (!is_array($input)) {
			if (trim($input) == '') {
				return '';
			}
			//remove redundant spaces support UTF-8
			$str = preg_replace('/[\h]+/u', " ", trim($input));
			$options = array_merge(
					array(
							//not allow html tags
							'HTML.Allowed' => ''
					),
					$options);
			$config = HTMLPurifier_Config::createDefault();
			if (!empty($options)) {
				foreach ($options as $key => $value) {
					$config->set($key, $value);
				}
			}
			return HTMLPurifier::getInstance()->purify($str, $config);
		} else {
			foreach ($input as $k => $v) {
				$input[$k] = preg_replace('/[\h]+/u', ' ', trim($v));
			}

			$options = array_merge(
					array(
							//not allow html tags
							'HTML.Allowed' => ''
					),
					$options);
			$config = HTMLPurifier_Config::createDefault();
			if (!empty($options)) {
				foreach ($options as $key => $value) {
					$config->set($key, $value);
				}
			}
			return HTMLPurifier::getInstance()->purifyArray($input, $config);
		}
		return false;
	}

	public static function jsonEncode($input, $encoding = JSON_UNESCAPED_UNICODE) {
		return json_encode($input, $encoding);
	}

	public static function dateDiff($d1, $d2, $options = array()) {
		$default = array('text'=> false);
		$options = array_merge($default, $options);
		$datetime1 = new DateTime($d1);
		$datetime2 = new DateTime($d2);
		$interval = $datetime1->diff($datetime2);
		$result = $interval;

		if ($options['text'] == true) {
			if($interval->invert == 0 || $interval->d == 0){
				$result = $interval->d." days Remain";
			}else{
				$result = "Overdue  ".$interval->d." days";
			}
		}
		return $result;
	}

	public static function getUserIP() {
		$ip = null;
		//TP-88	Enhance Registration process
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	public static function mb_ucwords($str) {
		$str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
		return ($str);
	}

	public static function mb_lower($str) {
		$str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
		return ($str);
	}
   
    public static function array_ikey_exists($key, $array){

    	$result = false;

	    if(preg_match("/".$key."/i", implode("|", array_keys($array))))
	        $result = true;

	    return $result;
	}
	
	public static function timeAgoInWords($dateTime, $timeZone = 'UTC') {
		return CakeTime::timeAgoInWords($dateTime, array('timezone'=>$timeZone,  'format' => CLIENT_COMMON_DATE_FORMAT, 'end' => '+1 day'));
	}
	
}
