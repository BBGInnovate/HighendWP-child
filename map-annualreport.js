var COLOR_HOVER = "#CC0000"; //the color that highlights a hot spot when you roll over a country
var COLOR_ACTIVE = "#FFFFFF"; //background color when a button in the hot spot bar is active

var hideUnselectedCountries = true;
var normalColors = {
	iran: "#CC99B3",
	russia: "#ebdb8b",
	china: "#2B9ED4",
	cuba: "#71B771",
	cve: "#E67300",
	all: "#999999"
}

colors = normalColors;

//define each sphere an dthe countires it is comprised of and influences
var spheres = {
	iran: {
		comprisedOf: ['Iran'],
		influences: ['Turkmenistan', 'Afghanistan', 'Pakistan', 'Yemen', 'Iraq', 'Azerbaijan'],
		color: colors['iran'],
		label: "Iran"
	},
	russia: {
		comprisedOf: ['Russia'],
		influences: ['Ukraine','Estonia','Latvia','Lithuania','Belarus','Moldova','Syria','Kazakhstan','Uzbekistan','Turkmenistan','Tajikistan','Kyrgyzstan','Azerbaijan','Armenia','Georgia','Israel'],
		color: colors['russia'],
		label: "Russia"
	},
	cuba: {
		comprisedOf: ['Cuba'],
		influences: ['Venezuela','Colombia'],
		color: colors['cuba'],
		label: "Cuba"
	},
	cve: {
		comprisedOf: ['Russia'],
		influences: [
			'Afghanistan','Armenia','Iran','Iraq','Kazakhstan','Kyrgyzstan','Pakistan','Tajikistan','Turkmenistan','Uzbekistan','Belarus','Georgia','Serbia',
			'Bangladesh','Philippines','Thailand','Malaysia','India','Indonesia',
			'Israel','Jordan','Kuwait','Lebanon','Saudi Arabia','Syria','Turkey','Yemen','Egypt','Morocco','Libya','Algeria',
			'Mali', 'Mauritania', 'Chad', 'Western Sahara', 'Sudan', 'Eritrea', 'Ethiopia', 'Somalia', 'Cameroon', 'Benin', 'Niger', 'Burkina Faso', 'Nigeria', 'Kenya', 'Tanzania', 'Uganda'
		],
		color: colors['cve'],
		label: "Countering Violent Extremism"
	},
	china: {
		comprisedOf: ['China'],
		influences: [
			'Bangladesh','Bhutan', 'Nepal', 'Thailand', 'Myanmar', 'Vietnam', 'Lao People\'s Democratic Republic', 'North Korea', 'South Korea', 'Cambodia', 'Malaysia'  ],
		color: colors['china'],
		label: "China"
	},
};

var fullCountryList = AmCharts.maps.worldLow.svg.g.path;
var activeSphere = "all";

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
			var colorFill = "";
			if (freedomStatus == "F") {
				colorFill = "#90EE90";
			} else if (freedomStatus == "PF") {
				colorFill = "#FFD700";
			} else {
				colorFill = "#7a3336";
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

		map = AmCharts.makeChart( "chartdiv", {
			theme: "light",
			projection:"eckert3",
			type: "map",
			zoomOnDoubleClick : false,
			imagesSettings: {
				rollOverColor: "#089282",
				rollOverScale: 3,
				selectedScale: 3,
				selectedColor: "#089282",
				color: "#13564e"
			},
			dataProvider: {
				map: "worldLow",
				areas:getAreas("all"),
				images: [ {
			      svgPath: targetSVG,
			      zoomLevel: 5,
			      scale: 1,
			      title: "Vienna",
			      latitude: 48.2092,
			      longitude: 16.3728
			    }, {
			      svgPath: targetSVG,
			      zoomLevel: 5,
			      scale: 1,
			      title: "Minsk",
			      latitude: 53.9678,
			      longitude: 27.5766
			    }],
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