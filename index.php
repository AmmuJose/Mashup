<!DOCTYPE html>
<html lang="en">
<head>
	<title>Orlando Theme Parks</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

	<script type="text/javascript" src="assets/js/ajaxprjct.js"></script>
	<!-- script for google map and yahoo flickr images-->
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBAYDNzYb1PCz0z9jziYNytRFfIy1TxL3Y"></script>
	<script type="text/javascript" src="https://api.flickr.com/services/feeds/photoset.gne?nsid=21980431@N07&set=72157626477149192&format=json"></script>
</head>

<body>
	<!-- --------------------- Header ---------------------- -->	
	<div class="row header">
		<div class="col-3">
			<img src = "assets/images/head.jpg" alt="theam park" width="138" height="90"/>
		</div>
		<div class="col-9">
			<h1>Orlando Theme Parks</h1>	
		</div>
	</div>

	<!-- -------------------- Content ----------------------- -->
	<div class="row">
		<div class="col-7">
			<div class="row  left">
				<h2>Explore Theme Parks</h2>
				<p>
					A day at one of Orlando's fabulous theme parks is a day like no other.		 
				 	Parents and kids, grandparents and couples, student groups or family reunions ... 
				 	you notice them all and they're all enthralled.
				</p> 
				<br>
				<p> Whichever park you select, you've made the perfect choice.</p>
				<br>
				<div class="row">
					<form action="#">
					 	<label for="parks"> Select a Park: </label>
					 	<select id="parks">
						 	<?php 
						 		$parks = array('Select a Park' => "", 'Walt Disney' => 'disney', 'Universal Studios' => 'universal', 'Sea World' => 'seaworld');
						 		foreach($parks as $key => $value) {
						 			echo '<option value = "' . $value.'">' . $key ."</option>\n";
						 		} 
						 	?>		 		
					 	</select>				 	
					 	<select id="subdiv">
					 		<option selected = "selected" value = "">parks</option>
					 	</select>
					</form>
				</div>				
			</div>
			<div class="row">
				<div id="pictureBar" class="col-7"> </div>
				<div class="col-5">
					<div id = "time"> </div>
					<div id ="info"> </div>
				</div>
			</div>				
		</div> 
		
		<div class="col-5">
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
		</div>
	</div> 

	<!--  ----------------------- Footer ----------------------- -->
	<div class="col-12 footer">
		Copyright &copy;2011 &#160; Neethu Jose
		<br>
		Last updated on:
		<?php echo" " . date ("m/d/y", getlastmod()); ?>
	</div> 

</body>	
</html>