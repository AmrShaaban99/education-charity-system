<?php
$dsn='mysql:dbhost=localhost; dbname=education_charity_system';
$user = 'root';
$pass='';
$option=array(
PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'
);
try {
    $dbh = new PDO($dsn,$user,$pass,$option);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo 'failed To Connect'. $ex->getMessage();
    
}

?>











