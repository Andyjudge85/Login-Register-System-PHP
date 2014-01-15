<?php
$connect_error='We\'re having some connection issues.';
$server='localhost';
$user='root';
$password='';
$dbName='lr';

mysql_connect($server, $user, $password) or die($connect_error);
mysql_select_db($dbName) or die($connect_error);
mysql_query('SET NAMES UTF8');
?>