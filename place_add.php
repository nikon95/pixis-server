<?php require_once('Connections/test.php'); ?>
<?php


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Red Cross Patras</title>
<style>
      html, body  {
        height: 100%;
		width:100%;
        margin: 0px;
        padding: 0px;	
      }
	  
	  #map-canvas
	  {
		height: 300px;
		width:100%;
        margin: 0px;
        padding: 0px;
	  }
	  
	  table {		  
		  width:100%;
		  height:100%;
	  }
	  td {
		  width:50%;
	  }
    </style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script>
	var map;
	var marker;
	var autocomplete1;
	
	function initialize() {
	  var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(38.2521411,21.7435798)
	  };
	  map = new google.maps.Map(document.getElementById('map-canvas'),
		  mapOptions);
		  
		google.maps.event.addListener(map, "click", function(event)
            {
                // place a marker
                placeMarker(event.latLng);
			
  			});
			
		autocomplete1 = new google.maps.places.Autocomplete(
			  /** @type {HTMLInputElement} */(document.getElementById('autocomplete1')),
			  { types: ['geocode'], componentRestrictions: {country: 'gr'} });
	}
	
	function fillInAddress() {
		  // Get the place details from the autocomplete object.
		  var place = autocomplete.getPlace();
		
		  for (var component in componentForm) {
			document.getElementById(component).value = '';
			document.getElementById(component).disabled = false;
		  }
		
		  // Get each component of the address from the place details
		  // and fill the corresponding field on the form.
		  for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
			  var val = place.address_components[i][componentForm[addressType]];
			  document.getElementById(addressType).value = val;
			}
		  }
		}
	
	function convert()
	{
		var geocoder = new google.maps.Geocoder();
		
		
		var address = document.getElementById('autocomplete1').value;
 		geocoder.geocode( { 'address': address}, function(results, status) 
		 {
    
			if (status == google.maps.GeocoderStatus.OK) 
			{
				  map.setCenter(results[0].geometry.location);
				  
				  marker = new google.maps.Marker({
					  map: map,
					  position: results[0].geometry.location
				  });
				  
				  document.getElementById("lat").value=marker.getPosition().lat();
				  document.getElementById("lng").value=marker.getPosition().lng();
				  
			} 
				else {
				  alert('Geocode was not successful for the following reason: ' + status);
				}
		  });
		  
		  
	}
	
	function placeMarker(latLng)
	{
		if (marker!=null)
			marker.setMap(null);
			
		 marker = new google.maps.Marker({
                position: latLng, 
                map: map,
				});
		
		 document.getElementById("lat").value=marker.getPosition().lat();
		document.getElementById("lng").value=marker.getPosition().lng();
				
		 console.log(marker.getPosition().toString());
	}
	
	function addService()
	{
		serviceList=document.getElementById("service");
		serviceName=serviceList.options[serviceList.selectedIndex].innerHTML;
		document.getElementById("service_list").innerHTML+=serviceName+ " "+ serviceList.options[serviceList.selectedIndex].value +"<br/>";
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
  <form id="form1" name="form1" method="post" action="place_insert.php">
  <table border="1">
  <tr>
  	<td><label for="coords"></label>
    	<label for="pointid">point id</label>
    	<input type="text" name="placeid" id="placeid" />
    	<br />
        <input id="autocomplete1" name="autocomplete1" placeholder="Enter your address"
         onFocus="geolocate()" type="text" name="autocomplete1" size="100"><input type="button" name="conv" id="conv" value="+" onclick="convert();" />
		<div id="map-canvas"></div>
        <input type="hidden" id="lat" name="lat"/>
        <input type="hidden" id="lng" name="lng"/>
    </td>
    </tr>
  <tr>
    <td>&nbsp; </td>
  </tr>
  <tr>
    <td>Αποθήκευσηsubmit
      <input type="submit" name="button" id="button" value="Submit" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
  
  
  </form>
    
  </body>
  </html>
<?php
mysql_free_result($Recordset1);
?>
