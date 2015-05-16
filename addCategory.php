<?php 
header('Content-Type:text/html; charset=utf8');
require_once('Connections/test.php');
// To add a new Category 
$test = mysql_pconnect($hostname_test, $username_test, $password_test) or trigger_error(mysql_error(),E_USER_ERROR);
mysqli_set_charset('utf8',$test);
mysql_select_db($database_test, $test);

// Receiving Cat. Information 
$name_el=$_POST['name_el'];
$name_en=$_POST['name_en'];
$ImgURL=$_POST['ImgURL'];

$query_Recordset1 = "INSERT INTO category (icon_path) VALUES ('$ImgURL ')";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$last_id=mysql_insert_id();
$query_Recordset2 = "INSERT INTO category_name (category_id,lang_id,name) VALUES ('$last_id','1','$name_el')";
$Recordset2 = mysql_query($query_Recordset2, $test) or die(mysql_error());
$query_Recordset3 = "INSERT INTO category_name (category_id,lang_id,name) VALUES ('$last_id','2','$name_en')";
$Recordset3 = mysql_query($query_Recordset3, $test) or die(mysql_error());
header('Location: index.php');
?>