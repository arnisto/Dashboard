<?php
session_start();
if (!isset($_SESSION['username'])){
    header('location:index.php');
}else{
 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type"  charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="project tuto with monoprix">
    <meta name="author" content="lamjed gaidi mohaned abid">
    <link rel="icon" href="img/lm.ico" type="image/x-icon">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="js/read-excel-file.min.js"></script>
    <script src="js/canvasjs.stock.min.js"></script>
    <script src="js/canvasjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Dashboard for monoprix</title>
    <link rel="stylesheet" href="css/main3.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.stock.min.js"></script>

</head>
<body>
<!--nav bar------------------------------------------------------------->
<nav class="navbar navbar-light bg-light">
    <!------------------------------------------------->
       <img src="img/monoprix2.png" onclick="javascript:alert('lamjed')" alt="supcom logo" width="80px" height="auto">
    <!------------------------------------------------->
    <button type="button" onclick="" class="btn btn-light">Reset</button>
           
           <!-- <button type="button" onclick="showData()" class="btn btn-light">Data</button>
            <button type="button" onclick="showGraph()" class="btn btn-light">Graph</button>
            <div class="row">
                       
                        <select onchange="makechange()" class="custom-select" id="graphtype">
                            <option selected value="">shoose type</option>
                            <option  value="area">area</option>
                            <option  value="column">column</option>
                            <option  value="spline">spline</option>
                            <option  value="stepLine">stepLine</option>
                            <option  value="splineArea">splineArea</option>
                            <option  value="stepArea">stepArea</option>
                        </select>
                    </div>
           <button type="button" onclick="getWeatherInfos()" class="btn btn-light">Weather</button>
-->
    <!------------------------------------------------->
    <div style="width:50%;">
        <form method="post" action="add_to_data_base.php" enctype="multipart/form-data">
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="myfile" data-max-size="10000000" class="custom-file-input" id="inputGroupFile25249215" required>
              <label class="custom-file-label" for="inputGroupFile25249215">Choose file</label>
            </div>
            
         
          <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">Add</button>
           </div>
        </form>
      </div>
    <!------------------------------------------------->
</nav>
<!--
<nav >
  <marquee id="marquee_id">(Weather API by https://openweathermap.org/ ) Basic Informations : Monoprix sales forecasting</marquee>
</nav>
-->
<!--nav bar------------------------------------------------------------->
<div style="float:left;margin:1% 5%;">
<form>
                    <div class="row" required>
                        <label for="input1">shop_id</label>
                        <input type="text" id="input1" class="form-control" placeholder="shop_id" required></br>
                    </div>
                    <div class="row">
                        <label for="input2">item_id</label>
                        <input type="text" id="input2" class="form-control" placeholder="item_id" required></br>
                    </div>
                    <!--
                    <div class="row">
                        <label for="input3">id_struct</label>
                        <input type="text" id="input3" class="form-control" placeholder="id_struct" required></br>
                    </div>
        
                    <div class="row">
                        <label for="input4">category_id</label>
                        <input type="text" id="input4" class="form-control" placeholder="category_id" required></br>
                    </div>
-->

                    <div class="row">
                        <label for="input4">Price</label>
                        <input type="text" id="input47" class="form-control" placeholder="price" required></br>
                    </div>
                    <div class="row">
                        <label for="input5">starting day</label>
                        <input type="text" id="input5" class="form-control" placeholder="DD/MM/YY" required></br>
                    </div>

                    <div class="row">
                        <label for="input6">period</label>
                        <select class="custom-select" id="input6" required>
                            <option selected>Choose period</option>
                            <option value="1">One week</option>
                            <option value="2">Two week</option>
                            <option value="3">Three week</option>
                            <option value="4">Month</option>
                        </select>
                    </div></br>
                    <button type="button" onclick="download_csv()" class="btn btn-light">Download</button>
                    <button type="button" onclick="showFunction()" style="float:right;" class="btn btn-light">Submit</button>
                </form>
              
               
</div>
<div id="stockChartContainer" style="height: 400px; width: 70%; float:right;"></div>
<div id="stockChartContainer2" class="overflow-auto messages-list"><table class="table table-sm "></table></div>


<script type="text/javascript">
$('#stockChartContainer2').hide();
function getWeatherInfos(){
fetch('https://api.openweathermap.org/data/2.5/weather?q=Tunisia&appid=467424c4803fc0dd156dd350f5624e1a')
.then(response => response.json())
.then(data => {
  var tempValue = data['main']['temp'];
  console.log(data);
  document.getElementById("marquee_id").innerHTML +=' / id :'+data['sys']['id']+' / name : '+data['name']+' / pressure:'+data['main']['pressure']+' / humidity:'+data['main']['humidity'] +' / tempurature :'+data['main']['temp'] ;

})

.catch(err => alert("Wrong city name!"));
}
    var dataPoints = [];
 
  /*
  ________________________________________________________
  
   */
  window.onload = function() {

var chart = new CanvasJS.Chart("stockChartContainer", {
	animationEnabled: true,
	title: {
		text: "Sales forecast"
	},
	axisX: {
		title: "Time"
	},
	axisY: {
		title: "Percentage",
		suffix: "%",
		includeZero: true
	},
	data: [{
		type: "line",
		name: "CPU Utilization",
		connectNullData: true,
		//nullDataLineDashType: "solid",
		xValueType: "dateTime",
		xValueFormatString: "DD MMM hh:mm TT",
		yValueFormatString: "#,##0.##\"%\"",
		dataPoints: [
			{ x: 1501048673000, y: 35.939 },
			{ x: 1501052273000, y: 40.896 },
			{ x: 1501055873000, y: 56.625 },
			{ x: 1501059473000, y: 26.003 },
			{ x: 1501063073000, y: 20.376 },
			{ x: 1501066673000, y: 19.774 },
			{ x: 1501070273000, y: 23.508 },
			{ x: 1501073873000, y: 18.577 },
			{ x: 1501077473000, y: 15.918 },
			{ x: 1501081073000, y: null }, // Null Data
			{ x: 1501084673000, y: 10.314 },
			{ x: 1501088273000, y: 10.574 },
			{ x: 1501091873000, y: 14.422 },
			{ x: 1501095473000, y: 18.576 },
			{ x: 1501099073000, y: 22.342 },
			{ x: 1501102673000, y: 22.836 },
			{ x: 1501106273000, y: 23.220 },
			{ x: 1501109873000, y: 23.594 },
			{ x: 1501113473000, y: 24.596 },
			{ x: 1501117073000, y: 31.947 },
			{ x: 1501120673000, y: 31.142 }
		]
	}]
});
chart.render();

}








  var NAME_THE_FILE_TO_DOWNLOAD = 'sales_forecasting_data.csv';
 function makechange(){
  var GRAPHTYPE = $('#graphtype').val();
              var chart = new CanvasJS.Chart("stockChartContainer", {
                animationEnabled: true,
                theme: "light2",
                zoomEnabled: true,
                title:{
                  text: "Graph of sales"
                },
                axisX:{      
                    valueFormatString: "DD/MMM/YYYY" ,
                    labelAngle: -50
                },
                axisY :{
                        lineColor: "rgba(205,205,205)",
                        gridColor: "rgba(105,105,105,.8)"

                      },
                data: [{        
                  type: GRAPHTYPE,
                  xValueType: "dateTime",
                  dataPoints: dataPoints
                }]
              });
              chart.render();
 }
/*
window.onload = function () {
  var stockChart = new CanvasJS.StockChart("stockChartContainer", {
    exportEnabled: true,
    title: {
      text:"StockChart with Line using JSON Data (API)"
    },
    subtitles: [{
      text:"Total Retail Sales of Monoprix "
    }],
    charts: [{
      axisX: {
        crosshair: {
          enabled: true,
          snapToDataPoint: true,
          valueFormatString: "MMM YYYY"
        }
      },
      axisY: {
        title: "Million of Dollars",
        prefix: "Q",
        suffix: "M",
        crosshair: {
          enabled: true,
          snapToDataPoint: true,
          valueFormatString: "q#,###.00M",
        }
      },
      data: [{
        type: "line",
        xValueFormatString: "MMM YYYY",
        yValueFormatString: "quantity#,###.##U",
        dataPoints : dataPoints
      }]
    }],
    navigator: {
      slider: {
        minimum: new Date(2010, 00, 01),
        maximum: new Date(2018, 00, 01)
      }
    }
  });
  
  $.getJSON("https://canvasjs.com/data/gallery/stock-chart/grocery-sales.json", function(data) {
    for(var i = 0; i < data.length; i++){
      dataPoints.push({x: new Date(data[i].date), y: Number(data[i].sale)});
    }
    stockChart.render();
  });
}
*/
function showData(){
            $('#stockChartContainer').hide();
            generateTable(table, dataPoints);
            $('#stockChartContainer2').show();
        }
function showGraph(){
            $('#stockChartContainer2').hide();
            $('#stockChartContainer').show();
        }
function showFunction(){
  var input1 = $('#input1').val();
  var input2 = $('#input2').val();
  var input3 = $('#input3').val();
  var input4 = $('#input4').val();
  var input5 = $('#input5').val();
  var input6 = $('#input6').val();
  //alert (input1+input2);
  
  var  identifiant  = String(input1+'_'+input2+'_'+input3+'_'+input4);
  NAME_THE_FILE_TO_DOWNLOAD = 'sales_forecasting_data_'+identifiant+'.csv';
  document.getElementById("marquee_id").innerHTML += ' / shop_id : '+input1+' / item_id :'+input2+' / struct_id :'+input3+' / category_id :'+input4;
  var dataform = "input1="+input1+"&input2="+input2+"&input3="+input3+"&input4="+input4+"&input5="+input5+"&input6="+input6 ;
 $.ajax
        ({
            type: "POST",
            url: "get_data_from_data_base.php",
            data: dataform,
            cache: false,
            success: function(data)
            {


             if(data != "errors"){
              //alert(dataPoints);
              dataPoints = Object.values(JSON.parse(data));
              var chart = new CanvasJS.Chart("stockChartContainer", {
                animationEnabled: true,
                theme: "light2",
                zoomEnabled: true,
                title:{
                  text: "Graph of sales"
                },
                axisX:{      
                    valueFormatString: "DD/MMM/YYYY" ,
                    labelAngle: -50
                },
                axisY :{
                        lineColor: "rgba(205,205,205)",
                        gridColor: "rgba(105,105,105,.8)"

                      },
                data: [{        
                  type: "line",
                  xValueType: "dateTime",
                  dataPoints: dataPointss
                }]
              });
              chart.render();
             }else{
               alert('you have make an erros');
              window.location.replace("errors.php");
             }
            } 
        });
  
}
function generateTableHead(table, data) {
  let thead = table.createTHead();
  let row = thead.insertRow();
  for (let key of data) {
    let th = document.createElement("th");
    let text = document.createTextNode(key);
    th.appendChild(text);
    row.appendChild(th);
  }
}

function generateTable(table, data) {
  for (let element of data) {
    let row = table.insertRow();
    for (key in element) {
      let cell = row.insertCell();
      let text = document.createTextNode(element[key]);
      cell.appendChild(text);
    }
  }
}

let table = document.querySelector("table");
let data = ["x","y"];
generateTableHead(table, data);


 
function download_csv() {
  let array = [];
  dataPoints.forEach(v => array.push([v.x,v.y]));

    var csv = 'X,Y\n';
    array.forEach(function(row) {
            csv += row.join(',');
            csv += "\n";
    });
 
    //console.log(csv);
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = NAME_THE_FILE_TO_DOWNLOAD;
    hiddenElement.click();
}
//send data with api------------------------------------------------------------------------
// Select your input type file and store it in a variable
/*
const input = document.getElementById('inputGroupFile25249215');
input.addEventListener('change', functionlamjed, false);
function functionlamjed(e){
  if(input.files[0].type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
              console.log('it is xlsx');
              readXlsxFile(input.files[0]).then(function(data){
              console.log( data);
              })
   }else{
     if( input.files[0].type == "application/vnd.ms-excel"){
     console.log(input.files[0]);
     }else{
       alert('we accept just .xlsx and .csv file');
       console.log('we accept just .xlsx and .csv file');
     }
   }


  
}
// This will upload the file after having read it
/*
const upload = (file) => {
  fetch('http://www.example.net', { // Your POST endpoint
    method: 'POST',
    headers: {
      // Content-Type may need to be completely **omitted**
      // or you may need something
      "Content-Type": "You will perhaps need to define a content-type here"
    },
    body: file // This is your file object
  }).then(
    response => response.json() // if the response is a JSON object
  ).then(
    success => console.log(success) // Handle the success response object
  ).catch(
    error => console.log(error) // Handle the error response object
  );
};

// Event handler executed when a file is selected
const onSelectFile = () => upload(input.files[0]);

// Add a listener on your input
// It will be triggered when a file will be selected
input.addEventListener('change', onSelectFile, false);
//send data with api------------------------------------------------------------------------
*/
</script>
</body>
</html>
<?php
}
?>