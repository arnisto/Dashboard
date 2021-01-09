<?php
session_start();
if (!isset($_SESSION['username'])){
    header('location:index.php');
}else{
 
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="Content-Type"  charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="project tuto with monoprix">
    <meta name="author" content="lamjed gaidi mohaned abid">
    <link rel="icon" href="img/lm.ico" type="image/x-icon">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Dashboard for monoprix</title>
    <link rel="stylesheet" href="css/main3.css">

  <body>
  
            <div  id="field1">
                <form>
                    <div class="row">
                        <label for="input1">shop_id</label>
                        <input type="text" id="input1" class="form-control" placeholder="shop_id"></br>
                    </div>
                    <div class="row">
                        <label for="input2">item_id</label>
                        <input type="text" id="input2" class="form-control" placeholder="item_id"></br>
                    </div>
                    <div class="row">
                        <label for="input3">category_id</label>
                        <input type="text" id="input3" class="form-control" placeholder="category_id"></br>
                    </div>
                    <div class="row">
                        <label for="input4">period</label>
                        <select class="custom-select" id="input4">
                            <option selected>Choose period</option>
                            <option value="1">One week</option>
                            <option value="2">Two week</option>
                            <option value="3">Three week</option>
                            <option value="4">Month</option>
                        </select>
                    </div></br>
                    <button type="button" onclick="showFunction()" style="float:right;" class="btn btn-light">Submit</button>
                </form>
            </div>
            <div id="field2">
                 <div id="chartContainer" style="height: auto; width: 100%;"></div>
                 <div id="chartContainer2" class="overflow-auto messages-list"><table class="table table-sm "></table></div>
            </div>
            <div id="field3">
            <img src="img/monoprix.png" alt="supcom logo" width="80%" height="auto">
            <br>
            <button type="button" onclick="download_csv()" style="margin:1%;" class="btn btn-light">Download</button>
            <button type="button" onclick="showData()" style="margin:1%;" class="btn btn-light">Data</button>
            <button type="button" onclick="showGraph()" style="margin:1%;" class="btn btn-light">Graph</button>
           <br>
           <a href="page2.php" target="_blank" rel="noopener noreferrer">  2</a>
            <div id="authors">
                 <img src="img/supcom.png" alt="monoprix logo" width="80%" height="auto">
            </div>
        </div>
        
    

    <script src=""></script>
    
    <script>
    //we will use an api here
    $('#chartContainer2').hide();
       var dataframe =  [
			{x:0, y: 450 },
			{x:10,y: 414},
			{x:20, y: 520 },
			{x:30, y: 460 },
			{x:40, y: 450 },
			{x:50, y: 500 },
			{x:60, y: 480 },
			{x:70, y: 480 },
			{x:80,y: 410},
			{x:90,y: 500 },
			{x:100,y: 480 },
			{x:110,y: 414},
			{x:120, y: 520 },
			{x:130, y: 460 },
			{x:140, y: 450 },
			{x:150, y: 500 },
			{x:160, y: 480 },
			{x:170, y: 480 },
			{x:180,y: 410},
			{x:190,y: 500 },
			{x:200,y: 480 },
			{x:210, y: 510 }
        ];
        function modifyd(){
            var dataframe2 =  [
			{x:0, y: 450 },
            {x:210,y: 450}]
            var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Graph of sales"
	},
	data: [{        
		type: "line",
      	indexLabelFontSize: 16,
        showInLegend: false,
		dataPoints: dataframe2
	}]
});
chart.render();
        }
        function showData(){
            $('#chartContainer').hide();
            $('#chartContainer2').show();
        }
        function showGraph(){
            $('#chartContainer2').hide();
            $('#chartContainer').show();
        }
        function showFunction(){
            var input1 = $('#input1').val();
            var input2 = $('#input2').val();
            var input3 = $('#input3').val();
            var input4 = $('#input4').val();
            var datee = new Date();
            alert(datee);
             alert('shop_id:'+input1+'item_id:'+input2+'category_id:'+input3+'period:'+input4);
        }
        window.onload = function () {


var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Graph of sales"
	},
	data: [{        
		type: "line",
      	indexLabelFontSize: 16,
        showInLegend: true,
		dataPoints: dataframe
	}]
});
chart.render();

}
//create table------------------------------------------------------------------------
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
let data = Object.keys(dataframe[0]);
console.log(data);
generateTableHead(table, data);
generateTable(table, dataframe);

//download data------------------------------------------------------------------------
let array = [];
dataframe.forEach(v => array.push([v.x,v.y]));
 
function download_csv() {
    var csv = 'X,Y\n';
    array.forEach(function(row) {
            csv += row.join(',');
            csv += "\n";
    });
 
    console.log(csv);
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'sales_forecasting_data.csv';
    hiddenElement.click();
}

    </script>
 </body>
</html>
<?php
}
?>