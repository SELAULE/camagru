<?php

	class User {
		private $_db,
				$_data;

		public function __construct($user = null) {
			$this->_db = DB::getInstance();
			$this->_sessionName = Config::get('session/session_name');
		}

		public function create($fields = array()) {
			if (!$this->_db->insert('users', $fields)) {
				throw new Exception("There was an error creating the account.");
			}
		}

		public function find($user = null) {
			if ($user) {
				$field = (is_numeric($user)) ? 'user_id' : 'username';
				$data = $this->_db->get('users', array($field, '=', $user));

				if ($data->count()) {
					$this->_data = $data->first();
					return true;
				}
			}
		}

		public function login($username = null, $password = null) {
			$user = $this->find($username);

			if ($user){
				if ($this->data()->password === Hash::make($password, $this->data()->salt)) {

				} 
			}
			return false;
		}

		public function data() {
			return $this->_data;
		}
	}
?>