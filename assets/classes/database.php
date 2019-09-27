<?php

// Database Class is wrote for create connection to DB
class database {

    static public $db;

	static public function connect() {

	    global $host, $user_db, $pass_db, $database;

        $db = mysqli_connect($host, $user_db, $pass_db, $database);

        if( $db )
            return $db;
        return false;

        //self::$db = $db;
	}

}