am5.ready(function() {

    // var continents = {
    //     'Oceania' : 'AU', 
    //      'Africa' : 'ET', 
    //      'Canada' : 'CA',
    //      'USA' :'USA',
    //      'Asia Pacific' :'APAC',
    //      'South America' :'SA',
    //      'Gulf' :'UAE',
    // }
// var continents = {
//   "AF": 0,
//   "AN": 1,
//   "AS": 2,
//   "EU": 3,
//   "NA": 4,
//   "OC": 5,
//   "SA": 6,
//   'US': 7 , 
 
// }

var continents = {
  "AF": 0,
  "AN": 1,  
  "AS": 2,
  "NA": 3,
  "OC": 4,
  "SA": 5,
  'US': 6 ,    
  'EU':7
}

var country_code_clicked= '' ; 

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");
var colors = am5.ColorSet.new(root, {});


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create the map chart
// https://www.amcharts.com/docs/v5/charts/map-chart/
var chart = root.container.children.push(am5map.MapChart.new(root, {
  panX: "rotateX",
  projection: am5map.geoMercator()
}));


// Create polygon series for the world map
// https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
var worldSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
  geoJSON: am5geodata_worldLow,
  exclude: ["AQ"]
}));

const static_data =  countryData;

worldSeries.mapPolygons.template.setAll({
    tooltipText: "{name}: {value}"  ,
  interactive: true,
  fill: am5.color(0xaaaaaa),
  templateField: "polygonSettings"
});

worldSeries.mapPolygons.template.states.create("hover", {
  fill: colors.getIndex(9) ,
});

worldSeries.mapPolygons.template.events.on("pointerover", function(ev) {
  var countryCode = ev.target.dataItem.dataContext.id;   
 

  conuntry_name = ev.target.dataItem.dataContext.name; 
  console.log(conuntry_name);

   getStateData(conuntry_name ,0 ,true).then((response)=>{
       console.log(response); 
      ev.target.set("tooltipText", conuntry_name + ": " + response.leads_count);
   }).catch((error)=>{
       console.log('error' +error);
   });


});

worldSeries.mapPolygons.template.events.on("click", (ev) => {
    var countryCode = ev.target.dataItem.dataContext.id;
        
  var dataItem = ev.target.dataItem;
  var data = dataItem.dataContext;
  var zoomAnimation = worldSeries.zoomToDataItem(dataItem);
   console.log(data.map); 
//   showStateMap(countryCode ,chart ,root);
  Promise.all([
    zoomAnimation.waitForStop(),
    am5.net.load("https://cdn.amcharts.com/lib/5/geodata/json/" + data.map + ".json", chart)
  ]).then((results) => {
    var geodata = am5.JSONParser.parse(results[1].response);
    country_code_clicked = countryCode ;
    countrySeries.setAll({
      geoJSON: geodata,
      fill: data.polygonSettings.fill , 
      countryID : countryCode
    });

    
//   showStateMap(countryCode ,chart ,root);
    countrySeries.show();
    worldSeries.hide(100);
    backContainer.show();
  });
});






var countrySeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
  visible: false
}));


countrySeries.mapPolygons.template.states.create("hover", {
  fill: colors.getIndex(9)
});





function getStateData(countryName, stateName=0 ,is_country=0 ,stateCode=0) { 
  return new Promise((resolve, reject) => {
  
   $.ajax({
       url : 'getLeadSalesState' , 
       method : 'POST',
       data : {
           countryName : countryName , 
           stateName : stateName, 
           is_country:is_country ,
           stateCode : stateCode
       },
       success : function(response){
       
       resolve(JSON.parse(response))
       } , 
       error : function(xhr , status ,error){
        reject(error);  
       
           
       }
   }); 

   });



}

  countrySeries.mapPolygons.template.setAll({
    tooltipText: "{name} (ID: {id}): {leads} leads",
    interactive: true
  });


  countrySeries.mapPolygons.template.events.on("pointerover", function(ev) {
  
  console.warn(ev.target.dataItem.dataContext.name); 

  var stateCode = ev.target.dataItem.dataContext.id; 
  var stateName = ev.target.dataItem.dataContext.name; 

  ev.target.set("tooltipText", "Loading...");
        console.log('state code' +stateCode); 
        getStateData(country_code_clicked, stateName ,0 ,stateCode).then(res => {
            // console.log('response:', res.state_name);
        
            if (res && res.state_name) {
                ev.target.set("tooltipText", res.state_name + ": " + res.leads_count);
              
            }
        })
        .catch(error => {
        
            
            console.error('Error:', error);
  });
    
  });

  countrySeries.mapPolygons.template.events.on("click", function(ev) {
      //  alert(loggedInUser); 
          let state_name = ev.target.dataItem.dataContext.name; 
          if(loggedInUser==2){
              window.location.href="leads?state_name="+state_name;
          }else{
            window.location.href="adminTeamLeads?state_name="+state_name;
          }
        
  });



var data = [];
for(var id in am5geodata_data_countries2) {
  if (am5geodata_data_countries2.hasOwnProperty(id)) {
    var country = am5geodata_data_countries2[id];
    if (country.maps.length) {
      data.push({
        id: id,
        map: country.maps[0],
        polygonSettings: {
          fill: colors.getIndex(continents[country.continent_code]),
        }
      });
    }
  }
}
worldSeries.data.setAll(data);


// Add button to go back to continents view
var backContainer = chart.children.push(am5.Container.new(root, {
  x: am5.p100,
  centerX: am5.p100,
  dx: -10,
  paddingTop: 5,
  paddingRight: 10,
  paddingBottom: 5,
  y: 30,
  interactiveChildren: false,
  layout: root.horizontalLayout,
  cursorOverStyle: "pointer",
  background: am5.RoundedRectangle.new(root, {
    fill: am5.color(0xffffff),
    fillOpacity: 0.2
  }),
  visible: false
}));

var backLabel = backContainer.children.push(am5.Label.new(root, {
  text: "Back to world map",
  centerY: am5.p50 
}));

backLabel.set("fontSize", 16);
backLabel.set("fill", am5.color(0x47ACFE)); // Red color
backLabel.set("fontWeight", "bold");
backLabel.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF),      
  stroke: am5.color(0x0000001C),    
  strokeWidth: 1,  
}));
var backButton = backContainer.children.push(am5.Graphics.new(root, {
  width: 32,
  height: 32,
  centerY: am5.p50,
  fill: am5.color(0x555555),
  svgPath: "9c0.033-0.051,0.263-0.059,0.263-0.059S10.458,8.861,10.391,8.802z"
}));

backContainer.events.on("click", function() {
  chart.goHome();
  worldSeries.show();
  countrySeries.hide();
  backContainer.hide();
});
  




}); // end am5.ready()