<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  	 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Orlando Theme Parks</title>
<link href = "prjct.css" rel = "stylesheet" type="text/css"/>
<script type="text/javascript" src="ajaxprjct.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://api.flickr.com/services/feeds/photoset.gne?nsid=21980431@N07&set=72157626477149192&format=json"></script>

</head>

<body>
<!--  ************* Top ************** -->
<div class="topwrap"><img src = "images/head.jpg" alt="theam park" width="138" height="90"/> 
	<div class ="head"><h2>ORLANDO THEME PARKS</h2></div></div>
<div class="wrap">
	<div class="left">
		<h4>Explore Theme Parks</h4>
		<p>A day at one of Orlando's fabulous theme parks is a day like no other.		 
		  Parents and kids, grandparents and couples, student groups or family reunions ... 
		  you notice them all and they're all enthralled.</p> 
		 <p> Whichever park you select, you've made the perfect choice.</p>
		 
		<form action="#">
		 	Select a Park:&#160;
		 	<select id="parks">
		 	<?php $parks = array('Select a Park' => "", 'Walt Disney' => 'disney', 'Universal Studios' => 'universal', 'Sea World' => 'seaworld');
		 	foreach($parks as $key => $value){
		 		echo '<option value = "' . $value.'">' . $key ."</option>\n";
		 	} ?>		 		
		 	</select>
		 	
		 	<select id="subdiv">
		 		<option selected = "selected" value = "">parks</option>
		 	</select>
		</form>
		<div style = "height:300px;">
			<div id = "pictureBar"> </div>
			<div style="height:300px;width:160px;float:left;font-size:13px;">
				<div id = "time"></div>
				<div id ="info"></div>
			</div>
		</div>
		
		
	</div> <!-- End left -->
	
	<div class="right">
		<?php
		//$xml = file_get_contents('http://www.google.com/ig/api?weather=orlando');
		//$information = $xml->xpath("/xml_api_reply/weather/forecast_information");
		//$current = $xml->xpath("/xml_api_reply/weather/current_conditions");
		?>
		
		<!-- <p style="font-family:Serif; color:#111d29;"><b>Today's weather</b></p>
		<div class="weather">		
		<img src="<?php //echo 'http://www.google.com' . $current[0]->icon['data']?>" alt="weather" width="35" height="35"/>
			<span class="condition">
			<b> <?php //echo $current[0]->temp_f['data'] ?>&deg; F</b>,
			<?php //echo $current[0]->condition['data'] ?>
			</span>
			<div class="condition"><?php //echo $information[0]->city['data']; ?></div>
		</div> -->
		<div id="map"></div>
		
		
	</div><!-- end right -->
</div>
        
<!--  ***************footer***************** -->
<div class="footer1"> <a href="http://validator.w3.org/check?uri=referer">
<img style="border:0; float:right; padding:5px 5px 0px 0px;"  src="http://www.w3.org/Icons/valid-xhtml11-blue" alt="Valid XHTML 1.1" height="16" width="60"/></a></div>         
<div class="footer">Copyright &copy;2011 &#160;
	All Rights Reserved.&#160;Last updated on:<?php echo" " . date ("m/d/y", getlastmod()); ?></div> 
</body>
</html>
