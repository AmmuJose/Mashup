window.onload = initAll;
var xhr = false;
var optionValue;
var imgDiv = "";
var subdiv = "";
var subdivValue="";


function initAll()
{
	document.getElementById("parks").selectedIndex = 0;
	document.getElementById("parks").onchange = populateParks;
	addChange(getImg);
	addChange(getMap);
}//end initAll

function addChange(newFunction) {
	subdiv = document.getElementById("subdiv");
	var oldChange = subdiv.onchange;
	
	if (typeof oldChange == "function") {
		subdiv.onchange = function() {
			if (oldChange) {
				oldChange();
			}
			newFunction();
		}
	}
	else 
		subdiv.onchange = newFunction;	
}

function getImg(){	
	subdivValue = subdiv.options[subdiv.selectedIndex].value;	
	if(subdivValue.length > 0){
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "https://api.flickr.com/services/feeds/photoset.gne?nsid=21980431@N07&set=72157626477149192&format=json";
		document.body.appendChild(script);
	}	
}

	
function jsonFlickrFeed(flickrData) {	
	for(var i=0 ; i < flickrData.items.length; i++){
		imgDiv = "";
		if(flickrData.items[i].title == subdivValue) {
			imgDiv += "<img src='";
			imgDiv += flickrData.items[i].media.m.replace(/_m/g,"_m");
			imgDiv += "' alt='" + flickrData.items[i].title + "' width ='240' height='160'/>";
			break;			
			}
	}
	document.getElementById("pictureBar").innerHTML = imgDiv;
}


// ====================== Change the drop down menu ============================
function populateParks()
{
	
	var parkIndex = this.options[this.selectedIndex].value;
	var disney = new Array("Select a Walt Disney Park", "Magic Kingdom", "Animal Kingdom", "Epcot", "Hollywood Studios");
	var disneyIndex = new Array("", "magicKingdom", "animalKingdom", "epcot", "hollywoodStudios");
	
	var universal = new Array("Select a Universal Studio Park", "Universal Studios", "Islands of Adventure");
	var universalIndex = new Array("", "universalStudios", "islandsOfAdventure");
	
	var seaworld = new Array("Select a Sea World Park", "Sea World", "Aquatica");
	var seaworldIndex = new Array("", "seaWorld", "aquatica");
	
	function display(p, pValue)
	{
		for(var i=0; i < p.length; i++)
		document.getElementById("subdiv").options[i] = new Option(p[i], pValue[i]);
	
		document.getElementById("subdiv").style.visibility = "visible";
	}
	
	if(document.getElementById("parks").selectedIndex == 0){
		document.getElementById("subdiv").style.visibility = "hidden";
		document.getElementById("map").style.visibility = "hidden";
		document.getElementById("info").style.visibility = "hidden";
		document.getElementById("pictureBar").style.visibility = "hidden";
		document.getElementById("time").style.visibility = "hidden";
	}
	
	else {		
		document.getElementById("subdiv").options.length = 0;	
		
		if(parkIndex == "disney"){
		display(disney, disneyIndex);		
		}
		
		if(parkIndex == "universal"){			
		display(universal, universalIndex);
		}
		
		if(parkIndex == "seaworld"){			
		display(seaworld, seaworldIndex);
		}
	}//End else		
	
}//End populateParks

// ============================== get google map ===============================
function getMap(){
	
	optionValue = subdiv.options[subdiv.selectedIndex].value;
	if(optionValue.length <= 0){		
		document.getElementById("map").style.visibility = "hidden";
		document.getElementById("info").style.visibility = "hidden";
		document.getElementById("pictureBar").style.visibility = "hidden";
		document.getElementById("time").style.visibility = "hidden";
	}
	else
	{
		document.getElementById("map").style.visibility = "visible";
		document.getElementById("info").style.visibility = "visible";
		document.getElementById("pictureBar").style.visibility = "visible";
		document.getElementById("time").style.visibility = "visible";
	}
	
	makeRequest("map.xml", showMap);	
}

function makeRequest(url, fnCall){		
	if(window.XMLHttpRequest){
		xhr = new XMLHttpRequest();
	}
	else{
		if(window.AciveXObject){
			try{
				xhr = new AciveXObject("Microsoft.XMLHTTP");
			}
			catch(e){}
		}
	}
	if(xhr){		
		getXml(url, fnCall);
	}
	else{
		alert("Sorry, couldn't create an XMLHttpRequest");
	}	
}

function getXml(url, fnCall){	
	xhr.open("GET", url, true);
	xhr.onreadystatechange = fnCall;	
	xhr.send(null);
}

function showMap(){	
	if (xhr.readyState == 4) {
		if (xhr.status == 200) {
			var xmlResp =xhr.responseXML.getElementsByTagName("marker");
			var ln = xmlResp.length;
			for(var i = 0; i < ln; i++){
				if(xmlResp[i].getAttribute("name") == optionValue){
					var lat = xmlResp[i].getAttribute("lat");
					var lng = xmlResp[i].getAttribute("lng");
					var park = xmlResp[i].getAttribute("park");
					var street = xmlResp[i].getAttribute("street");
					var city = xmlResp[i].getAttribute("city");
					var state = xmlResp[i].getAttribute("state");
					var phone = xmlResp[i].getAttribute("phone");
					var webaddress = xmlResp[i].getAttribute("webaddress");	
					var hours = xmlResp[i].getAttribute("hours");
					i = ln + 1;
					}
				var outMsg =  '<p><b>Address: </b><br/>' + street + ',<br/>' + city + ', ' + state;
				outMsg += '<br/>'+ phone + '<br/><br/><b><a href="' + webaddress + '" target="_blank">Website</a></b></p>';
				var outTime = '<h4>' + park + '</h4><p><b>Bussiness Hours: </b><br/>' + hours + '</p>';
				document.getElementById("info").innerHTML = outMsg;
				document.getElementById("time").innerHTML = outTime;
				initialize(lat, lng, park, street, city, state, phone);
			}
		}
	}	
}

function initialize(lat, lng, park, street, city, state, phone){
	var myLatlng = new google.maps.LatLng(lat, lng);   
	var myOptions = { 
			  zoom: 14,     
			  center: myLatlng,     
			  mapTypeId: google.maps.MapTypeId.ROADMAP   }   
	 var map = new google.maps.Map(document.getElementById("map"), myOptions);
	 var marker = new google.maps.Marker({
	 		 			position: myLatlng, 
	 		 			map: map, 
	 		 			title: park
                                            }); 
        var infoWindow = new google.maps.InfoWindow;
        var address = "<b>" + park + "</b><br/>" + street + "<br/>" + city + ", " + state + "<br/>" + phone;
        bindInfoWindow(marker, map, infoWindow, address);
        
        function bindInfoWindow(marker, map, infoWindow, address){
        	google.maps.event.addListener(marker, 'mouseover', function(){
        		infoWindow.setContent(address);
        		infoWindow.open(map, marker);
        	}); 
        	
        	google.maps.event.addListener(marker, 'mouseout', function(){        		
        		infoWindow.close();
        	});     
        }          
}




