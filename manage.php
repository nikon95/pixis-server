<?php 
header('Content-Type:text/html; charset=utf8');
require_once('Connections/test.php');
$type=$_GET['type'];
 ?>
<html>
<head>
	<title>Red Cross Patras</title>
	<script>
		function showPlaces() {
             if (window.XMLHttpRequest) {
                 // code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp = new XMLHttpRequest();
             } else {  // code for IE6, IE5
                 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
             }
             xmlhttp.onreadystatechange = function () {
                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                     document.getElementById("showPlacesOutput").innerHTML = xmlhttp.responseText;
                 }
             }
             xmlhttp.open("GET", "getPlaces.php?list=" + <?php echo $type; ?>, true);
             xmlhttp.send();
         }
    </script>
</head>
<body>
	<script>showPlaces();</script>
	<div id="showPlacesOutput"></div>	
</body>
<html>	
