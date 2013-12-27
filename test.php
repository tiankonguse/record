<?php
define('DB_HOST','127.0.0.1');
define('DB_USER','tiankong_site');
define('DB_NAME','tiankong_site');
define('DB_PASS','4nMuNnZX');
define('SALT','tiankonguse');
try {
	//PDO::exec("SET NAMES 'utf8';");
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';"));
    foreach($dbh->query('SELECT * from timeline_project') as $row) {
       // var_dump($row);
    }
    var_dump("next");
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
var_dump(PHP_VERSION_ID);
var_dump(mysql_real_escape_string("\ d "));

?>