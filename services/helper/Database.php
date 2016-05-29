<?php
/**
 * Resources access for the application.
 *
 * @author Hatim Kamaal
 *
 */
class Database {
	private $conn;

	/**
	 * Private constructor
	 * so nobody else can instance it
	 */
	private function __construct() {
		$this->conn = mysqli_connect ( "localhost", "root", "", "omega_competition" );
		//$this->conn = mysqli_connect ( "localhost", "root", "", "ammar" );
	}

	/**
	 * Call this method to get single instance of class.
	 *
	 * @return Paths
	 */
	public static function getInst() {
		static $inst = null;
		if ($inst === null) {
			$inst = new Database ();
		}
		return $inst;
	}
	/**
	 *
	 * @param unknown $query
	 * @return mysqli_result
	 */
	public function getResultSet($query) {
		$rs = $this->run ( $query );
		if ($rs instanceof mysqli_result) {
			if (mysqli_num_rows ( $rs ) > 0) {
				return $rs;
			}
		}
	}

	/**
	 */
	public function getErrorMsg() {
		return $this->conn->error;
	}

	/**
	 *
	 * @param unknown $query
	 */
	public function run($query) {
		return $this->conn->query ( $query );
	}

	/**
	 *
	 * @param unknown $fname
	 * @param unknown $lname
	 * @return NULL
	 */
	public function update($query) {
		if (! $this->run ( $query )) {
			return false;
		} else {
			return true;
		}
	}
}
// Global veriable for easy access.
$db = Database::getInst ();
