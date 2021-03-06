 <?php
	class DB {
		private static $_instance = null;
		private $_pdo,
				$_query,
				$_error = false,
				$_results,
				$_count = 0;
		
		
		private function __construct(){
			try {
				$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' .Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
				$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);			
			} catch (PDOException $e) {
			die ($e->getMessage());
		}
	}

		public static function getInstance() {
			if (!isset(self::$_instance)) {
				self::$_instance = new DB();
			}
			return self::$_instance;
		}

		public function query($sql, $params = array()) {
			$this->_error = false;
			if ($this->_query = $this->_pdo->prepare($sql)) {
				$x = 1;
				if (count($params)) {
					foreach($params as $param) {
						$this->_query->bindValue($x, $param);
						$x++;
					}
				}

				if ($this->_query->execute()) { //if they query is executed
					if (strpos($sql, "SELECT") !== false) {
						$this->_results = $this->_query->fetchALL(PDO::FETCH_OBJ);
					}
					$this->_count = $this->_query->rowCount();
				} else {
					$this->_error = true;
				}
			}
			return $this;
		}

		public function action($action, $table, $where = array()) {
			if (count($where) === 3) {
				$operators = array ( '=', '>', '<', '>=', '<=');

				$field = $where[0];
				$operator = $where[1];
				$value = $where[2];

				if (in_array($operator, $operators)) {
					$sql = " {$action} FROM {$table} WHERE {$field} {$operator} ?";

					if (!$this->query($sql, array($value))->error()){
						return $this;
					}
				}
			}
			return false;
		}

		public function get($table, $where) {
			return $this->action('SELECT *', $table, $where);
		}

		public function delete ($table, $where) {
			return $this->delete( 'SELECT *', $table, $where);
		}

		public function insert($table, $fields = array()) {
			if (count($fields)) {
				$keys = array_keys($fields);
				$value = '';
				$x = 1;

				foreach ($fields as $field) {
					$value .= '?'; //Apends "?" to $value
					if ($x < count($fields)){
						$value .= ', '; //Apends "," after every "?"
					}
					$x++;
				}
				// $value = $fields;
				$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES({$value})";
				if (!$this->query($sql, $fields)->error()){
					return true;
				}
			}
			return false;
		}

		public function update($table, $id, $fields) {
			$set = '';
			$x = 1;

			foreach ($fields as $name => $value) {
				$set .= "{$name} = ?";
				if($x < count($fields)) {
					$set .= ', ';
				}
				$x++;
			}
			$sql = "UPDATE {$table} SET {$set} WHERE user_id = {$id}";


			if (!$this->query($sql, $fields)->error()){
				return true;
			}
			return false;
		}

		public function update_group($table, $id, $fields) {
			$set = '';
			$x = 1;

			foreach ($fields as $name => $value) {
				$set .= "`{$name}` = ?";
				if($x < count($fields)) {
					$set .= ', ';
				}
				$x++;
			}
			$sql = "UPDATE {$table} SET {$set} WHERE `user_id` = {$id}";
			$n = 1;
			if($this->_pdo->prepare($sql)->execute([$n])){
				return true;
		//	if (!$this->query($sql, $fields)->error()){
		//		return true;
			}
			return false;
		}

		public function results() {
			return $this->_results;
		}

		public function first() {
			return $this->results()[0];
		}

		public function error() {
			return $this->_error;
		}

		public function count() {
			return $this->_count;
		}
	}
?>