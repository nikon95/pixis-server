<?php 
header('Content-Type:text/html; charset=utf8');
require_once('Connections/test.php'); ?>
<?php
// Type of element to delete: Place = 1, Category =2, Service = 3
$type=$_GET['delete'];
$element_id=$_GET['id'];
$test = mysql_pconnect($hostname_test, $username_test, $password_test) or trigger_error(mysql_error(),E_USER_ERROR);
mysqli_set_charset('utf8',$test);

mysql_select_db($database_test, $test);

if($type == "1"){
$query_Recordset1 = "DELETE FROM place WHERE place.id='$element_id'";
}else if($type == "2"){
$query_Recordset1 = "DELETE FROM category WHERE category.id='$element_id'";
}else if($type == "3"){
$query_Recordset1 = "DELETE FROM service WHERE service.id='$element_id'";
}
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
header('Location: index.php');
?>