var fullCountryList = AmCharts.maps.worldLow.svg.g.path;
var activeSphere = "all";

var COLOR_FREE = "#5EAB9F";
var COLOR_PARTIALLY_FREE = "#B5A052";
var COLOR_NOT_FREE = "#AF4048";



cMap = {}; //this allows us to look a country's ID up from its title, so that the data can originally be entered as country titles
cMapByID = {};
for (var i = 0; i < fullCountryList.length; i++) {
	c = fullCountryList[i];
	c.spheres = [];
	cMap[c.title.toLowerCase()] = c.id;
	cMapByID[c.id] = c;
}

function getAreas() { 
	var areas = [];
	for (var i=0; i < freeNotFree.length; i++) {
		var o = freeNotFree[i];
		var bbgStatus = o[0];
		var countryName = o[1];
		var freedomScore = o[2];
		var freedomStatus = o[3];
		
		if (cMap.hasOwnProperty(countryName.toLowerCase())) {
			var countryID = cMap[countryName.toLowerCase()]; 
			var colorFill = COLOR_NOT_FREE;
			if (freedomStatus == "F") {
				colorFill = COLOR_FREE;
			} else if (freedomStatus == "PF") {
				colorFill = COLOR_PARTIALLY_FREE;
			}
			var a = {
				id: countryID,
				title: countryName,
				color: colorFill,
				alpha: 1
			}
			areas.push(a);
		} 
	}
	
	return areas;
}

(function ($) {

	jQuery(document).ready(function() {
		targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
		var images = new Array();
		for (var i = 0; i < threats.length; i++) {
			var t = threats[i];
			var img = {
				svgPath: targetSVG,
				zoomLevel: 5,
				scale: 1,
				//title: t.name + " - " + t.description,
				latitude: t.latitude,
				longitude: t.longitude
			}
			images.push(img);
		}

		map = AmCharts.makeChart( "chartdiv", {
			theme: "light",
			projection:"eckert3",
			type: "map",
			zoomOnDoubleClick : false,
			imagesSettings: {
				// rollOverColor: "#089282",
				// rollOverScale: 3,
				// selectedScale: 3,
				// selectedColor: "#089282",
				color: "#13564e"
			},
			balloon: {
				fillAlpha: 1,
				fillColor: "#CCCCCC"
			},
			dataProvider: {
				map: "worldLow",
				areas:getAreas("all"),
				images: images,
			},
			areasSettings: {
				autoZoom: false,
				alpha: 1,
				unlistedAreasAlpha: 0.55,
				selectable: true,
				selectedColor: undefined,
				outlineThickness: 0.1
			},
			zoomControl:  {
				zoomControlEnabled: false,
				panControlEnabled: false,
				homeButtonEnabled: false
			},
			dragMap:false 
		});

	});

})(jQuery);

	// map.balloonLabelFunction = function (area, map) {
		// 	var txt = "";
		// 	if (activeSphere != "all") {
		// 		txt= spheres[activeSphere].label + " Hot Spot";
		// 	} else {
		// 		var sphere = spheres[sMap[area.id]];
		//     	if (sphere) {
		//     		txt = sphere.label + " Hot Spot";
		//     	}
		// 	}
	 //    	return txt;
	 //    };