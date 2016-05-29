<?php

/**
 * Resources access for the application.
 *
 * @author Hatim Kamaal
 *
 */
class DBHelper {
	private $conn;
	//private $queries;

	/**
	 * Private constructor
	 * so nobody else can instance it
	 */
	private function __construct() {
		//$this->queries = parse_ini_file ( "queries.ini", true );
		//$this->conn = mysqli_connect ( "localhost", "olivezrt_counsel", "C@unsell0r", "olivezrt_counselling" );
		//$this->conn = mysqli_connect ( "localhost", "root", "", "ammar" );
		
		//$dbconn = pg_connect("host=localhost dbname=competition user=hatim password=hatim")
		$this->conn = pg_connect("host=$DB_HOST dbname=$DB_NAME user=$DB_USER password=$DB_CODE");
	}

	/**
	 * Call this method to get single instance of class.
	 *
	 * @return Paths
	 */
	public static function getInst() {
		static $inst = null;
		if ($inst === null) {
			$inst = new DBHelper ();
		}
		return $inst;
	}
	/**
	 *
	 * @param unknown $query
	 * @return mysqli_result
	 */
	public function getResultSet($query) {
		$result = pg_query($query);// or die('Query failed: ' . pg_last_error());
		if( pg_num_rows($result) > 0  ) {
			return $result; 
		}
		/*
		$rs = $this->run ( $query );
		if ($rs instanceof mysqli_result) {
			if (mysqli_num_rows ( $rs ) > 0) {
				return $rs;
			}
		}
		*/
	}
	/**
	 * This method should be used to make sql string
	 *
	 * @param unknown $options
	 * @param unknown $string
	 * @return unknown
	 */
	private function makeString($code, $params = null) {
		$string = $this->queries [$code];

		if( !isset($params) ) {
			return $string;
		}

		$options = $params->getData ();
		if (is_array ( $options ) && count ( $options ) > 0) {
			foreach ( array_keys ( $options ) as $opt ) {
				$string = str_replace ( "~$opt~", mysqli_real_escape_string ( $this->conn, $options [$opt] ), $string );
			}
		}
		return $string;
	}

	/**
	 */
	public function getErrorMsg() {
		return pg_last_error();
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
	 * @param unknown $query
	 * @param unknown $options
	 */
	public function runOptions($query, $options) {
		return $this->run ( $this->makeString ( $query, $options ) );
	}

	/**
	 *
	 * @return mysqli_result
	 */
	public function read($qcode, $params=null) {
		return $this->getResultSet ( $this->makeString ( $qcode, $params ) );
	}

	/**
	 *
	 * @param unknown $fname
	 * @param unknown $lname
	 * @return NULL
	 */
	public function update($qcode, $params = null) {
		
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
// 		$query = $this->makeString ( $qcode, $params );
// 		//echo $query;
// 		if (! $this->run ( $query )) {
// 			return false;
// 		} else {
// 			return true;
// 		}
	}
}
// Global veriable for easy access.
$db = DBHelper::getInst ();

?>