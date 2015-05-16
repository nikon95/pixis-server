<?php 
header('Content-Type:text/html; charset=utf8');
require_once('Connections/test.php'); ?>
<?php


$language=$_GET['language'];
$test = mysql_pconnect($hostname_test, $username_test, $password_test) or trigger_error(mysql_error(),E_USER_ERROR);
mysqli_set_charset('utf8',$test);

mysql_select_db($database_test, $test);

$query_Recordset1 = "SELECT category.id, category_name.name FROM category JOIN category_name  WHERE category.id = category_name.category_id AND category_name.lang_id =". $language;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$categories = array();
do {  
$categories[] = array($row_Recordset1['id'],$row_Recordset1['name']);
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
echo json_encode($categories);
?>