<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
    function __construct() {
        $this->connect();
    }
 
    function __destruct() {
        $this->close();
    }
 
    function connect() {
        include 'db_config.php';
       
         $con = mysql_connect(localhost, root) or die(mysql_error());
 
        $db = mysql_select_db(eshop) or die(mysql_error()) or die(mysql_error());
 
        return $con;
    }
 
    function close() {
        mysql_close();
    }
 
}
 
?>