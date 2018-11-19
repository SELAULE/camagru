<?php
	// require_once 'core/init.php';

	class validate {
		private $_passed = false,
				$_errors = array(),
				$_db = null;

		public function __construct(){
			$this->_db = DB::getInstance();
		}

		public function check($source, $items = array()) {
			foreach ($items as $item => $rules) {
				foreach ($rules as $rule => $rule_value) {
					
					$value = trim($source[$item]);
					$item = escape($item);
					if ($rule === "required" && empty($value)) {
						$this->addError("{$item} is required");
					} else if(!empty($value)) {
						switch ($rule) {
							case 'min' :
							if (strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value}");
							}
							break;

							case 'unique' :
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if ($check->count()) {
								$this->addError("{$item} already exists.");
							}
							break;
							case 'max' :
							if (strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximun of {$rule_value}");
							}
							break;
							case 'matches' :
							if ($value != $source[$rule_value]){
								$this->addError("{$rule_value} must match {$item}");
							}
							break;
							case 'valid_email' :
							if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $value)){
								$this->addError("The email you have entered is invalid, please try again.");
							}
							break ;
						}
					} 
				}
			}
			if (empty($this->_errors)) {
				$this->_passed = true;
			}
			return $this;
		}

		private function addError($error) {
			return $this->_errors[] = $error;
		}

		public function errors() {
			return $this->_errors;
		}

		public function passed() {
			return $this->_passed;
		}
	}
?>