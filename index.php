
<?php
ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0) Gecko/20100101 Firefox/9.0');

//phpinfo();
error_reporting(-1);
ini_set('display_errors', 'On');
$url = "http://www.nektron.com/^DJI_predictions.json";
$json = file_get_contents($url);
$json_data = json_decode($json, true);
$myArray = array();
$deepIndex = (int)$json_data['deep_index'];
$historical_data = $json_data['historical_prices'];
$deepIndexDate = $json_data['date'];

foreach($historical_data as $json_datkey => $json_dat){
    $datastr    =   strtotime($json_datkey)* 1000;
    $y = date('Y',strtotime($json_datkey));
    $m = date('m',strtotime($json_datkey));
    $d = date('j',strtotime($json_datkey));
    $close  =   $json_dat['Close'];
    $pred   =   $json_dat['Prediction'];
    //$deepIndex = $pred;
    $closemyArray[] = "[".$datastr.",".$close."]";
    if($y == "2019" && $m == "01"){
        $myArray[] = '{ x: new Date('.$y.', '.$m.', '.$d.'), y: '.$close.' }';
    }
}
$fp = fopen('close.json', 'w');
fwrite($fp, str_replace('"', "", json_encode($closemyArray, JSON_HEX_APOS)));
fclose($fp);

$pmyArray = array();
$predmyArray = array();
foreach($historical_data as $json_datkey => $json_dat){
    $datastr    =   strtotime($json_datkey)* 1000;
    $y = date('Y',strtotime($json_datkey));
    $m = date('m',strtotime($json_datkey));
    $d = date('j',strtotime($json_datkey));
    $close  =   $json_dat['Close'];
    $pred   =   $json_dat['Prediction'];
    $predmyArray[] = "[".$datastr.",".$pred."]";
    if($y == "2019" && $m == "01"){
        $pmyArray[] = '{ x: new Date('.$y.', '.$m.', '.$d.'), y: '.$pred.' }';
    }
}
$fp = fopen('pred.json', 'w');
fwrite($fp, str_replace('"', "", json_encode($predmyArray, JSON_HEX_APOS)));
fclose($fp);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166796966-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-166796966-1');
    </script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=0" />
	<title>Home | Deep Trading</title>
	<link rel="stylesheet" href="assets/css/style.css">
	    <!--[if IE]>
        <script type="text/javascript">
             var console = { log: function() {} };
        </script>
        
    <![endif]-->
    
</head>
<body class="home">

<!--<div class="videoBg">
	 <video width="1000" loop autoplay controls="false">
	  <source src="video/home.mp4" type="video/mp4">
	</video> 
</div>
 -->

<div id="myVideo">
	<video autoplay muted loop id="Video">
	  	<source src="video/home.mp4" type="video/mp4">
	</video>
</div>


 
<section class="headSec">
	<header class="header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
					<div class="logo">
						<a href="index.php">
							<img src="assets/images/logo.png">
						</a>
					</div>
					<div id="nav-icon4">
						  <span></span>
						  <span></span>
						  <span></span>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
					<div class="mainMenu">
						<ul id="menu">
							<li class="active"><a href="index.php">Home</a></li>
							<li><a href="what-we-do.html">What We Do</a></li>
							<li><a href="javascript:;">Products</a></li>
							<li><a href="pricing-plan.html">Pricing Plan</a></li>
							<li><a href="our-story.html">Our Story</a></li>
							<li><a href="about-us.html">About Us</a></li>
							<li><a href="contact-us.html">Contact Us</a></li>
							<li><a href="signup.html">Sign Up</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
</section>


<div class="bodySec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="homeTxt">
                        <h2>Deep Index
                        <span><?php echo number_format($deepIndex); ?> </span></h2>
                        <h6>Predicted close value of Dow Jones Industrial Average for <?php
                        $d = strtotime($deepIndexDate);
                        echo date('F jS, Y',$d);
                        ?> </h6>
                        <div class="homeGraph">
                            <!-- <img src="assets/images/home-chart.png"> -->


                            	<!--<div id="chartContainer"></div>-->
<div id="container"></div>


                        </div>
                        <div class="nextPredictions">
                            <h6>Enter a stock to view next day price predictions</h6>
                            <div class="field">
                                <input type="text" name="" placeholder="Stock Symbol">
                                <input type="submit" value="View" name="">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



<section class="footerSec">
	<footer class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
					<div class="copyTxt">
						<p>&copy; 2020  DeepTrading.ai,  All Rights Reserved</p>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
					<div class="termLinks">
						<a href="javascript:;">Privacy Policy</a>|
						<a href="javascript:;">Terms &amp; Conditions</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</section>


<script src="assets/js/main.js"></script>

<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script  src="script.js"></script>

<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<script>
window.onload = function () {

var options = {
	animationEnabled: true,
	backgroundColor: "#282d3a",
	theme: "light2",
	title:{
		// text: "Actual vs Projected Sales"
	},
	axisX:{
		valueFormatString: "MMM DD"
	},
	axisY: {
		//title: "Number of Sales",
		//suffix: "K",
		minimum: 30,
		gridColor: "#62666f"
	},
	toolTip:{
		shared: true
	},  
	legend:{
		cursor:"pointer",
		verticalAlign: "bottom",
		horizontalAlign: "left",
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
	},

	data: [{
		type: "line",
		showInLegend: false,
		name: "Projected Sales",
		markerType: "circle",
		xValueFormatString: "DD MMM, YYYY",
		color: "#f53137",
		yValueFormatString: "#,##0K",
		dataPoints: [
			<?php echo implode( ', ', $myArray ); ?>
		]
	},
	{
		type: "line",
		showInLegend: false,
		name: "Actual Sales",
		markerType: "circle",
		color: "#0cc445",
		//lineDashType: "dash",
		yValueFormatString: "#,##0K",
		dataPoints: [
			<?php echo implode( ', ', $pmyArray ); ?>
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);

function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
</script>


<script>
    document.getElementById('vid').play();
</script>



</body>
</html>