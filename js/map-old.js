/**
 * Define SVG path for target icon
 */
var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
/**
 * Create the map
 */
var map = AmCharts.makeChart( "chartdiv", {
  "type": "map",
  "projection": "eckert3",
  "theme": "light",
  "imagesSettings": {
    "rollOverColor": "#089282",
    "rollOverScale": 3,
    "selectedScale": 3,
    "selectedColor": "#089282",
    "color": "#13564e"
  },
  "areasSettings": {
    "unlistedAreasColor": "#15A892",
    "outlineThickness": 0.1
  },
  "dataProvider": {
    "map": "worldLow",
    "images": [ {
      "svgPath": targetSVG,
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Vienna",
      "latitude": 48.2092,
      "longitude": 16.3728
    }, {
      "svgPath": targetSVG,
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Minsk",
      "latitude": 53.9678,
      "longitude": 27.5766
    }, {
      "svgPath": targetSVG,
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Brussels",
      "latitude": 50.8371,
      "longitude": 4.3676
    }, {
      "svgPath": targetSVG,
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Sarajevo",
      "latitude": 43.8608,
      "longitude": 18.4214
    } ]
  }
} );
