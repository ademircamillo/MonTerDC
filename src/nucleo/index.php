<?php
	include("config.php");
	include("func.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="manifest.json">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
                <LINK rel="stylesheet" type="text/css" href="jquery.mobile-1.4.5.min.css">
		<LINK rel="stylesheet" type="text/css" href="e.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<script src="Chart.js"></script>
		<script src="jquery.min.js"></script>
		<script src="jquery.mobile-1.4.5.min.js"></script>
		<title>Temperature Monitor 1.00</title>
	</head>
	<body>
		<div id="geral" data-role="page">
			<div id="top">
				Temperature Monitor v1.00
			</div>
<div id="menu">
<form method="GET" action="temperature.php" style="padding: 0px; margin: 0px;">
<span>S1 <input type="checkbox" name="ls1" value="1" <?php if($_GET["ls1"] == "1") echo "checked";?>></span>
<span>S2 <input type="checkbox" name="ls2" value="1" <?php if($_GET["ls2"] == "1") echo "checked";?>></span>
<span>S3 <input type="checkbox" name="ls3" value="1" <?php if($_GET["ls3"] == "1") echo "checked";?>></span>
<span>S4 <input type="checkbox" name="ls4" value="1" <?php if($_GET["ls4"] == "1") echo "checked";?>></span>
<span>S5 <input type="checkbox" name="ls5" value="1" <?php if($_GET["ls5"] == "1") echo "checked";?>></span>
<span>S6 <input type="checkbox" name="ls6" value="1" <?php if($_GET["ls6"] == "1") echo "checked";?>></span>
<span>S7 <input type="checkbox" name="ls7" value="1" <?php if($_GET["ls7"] == "1") echo "checked";?>></span>
<span>S8 <input type="checkbox" name="ls8" value="1" <?php if($_GET["ls8"] == "1") echo "checked";?>></span>
<span>S9 <input type="checkbox" name="ls9" value="1" <?php if($_GET["ls9"] == "1") echo "checked";?>></span>
<span>S10 <input type="checkbox" name="ls10" value="1" <?php if($_GET["ls10"] == "1") echo "checked";?>></span>
<span>S11 <input type="checkbox" name="ls11" value="1" <?php if($_GET["ls11"] == "1") echo "checked";?>></span>
<span>S12 <input type="checkbox" name="ls12" value="1" <?php if($_GET["ls12"] == "1") echo "checked";?>></span>
<span>S13 <input type="checkbox" name="ls13" value="1" <?php if($_GET["ls13"] == "1") echo "checked";?>></span>
<span>S14 <input type="checkbox" name="ls14" value="1" <?php if($_GET["ls14"] == "1") echo "checked";?>></span>
<input type="submit" value=" OK ">
</form>
</div>
			<div id="diario">
				<canvas id="temp24" style="padding: 5px; height: 48%;"></canvas>
		
			</div>
		</div>
		<script>

		var lineChartData3 = 
		{
			labels : [<?php echo graficoTemperaturaDevolveDatas24(); ?>],
			datasets : 
			[
				<?php if($_GET["ls1"]=="1"){?>
                                 {
					label: "S1",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(210,73,73,1)",
					pointColor : "rgba(210,73,73,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(255,255,255,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s1"); ?>]
				},
                                 <?php } if($_GET["ls2"]=="1"){?>
                                {
					label: "S2",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(210,150,73,1)",
					pointColor : "rgba(210,150,73,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s2"); ?>]
				},
                                 <?php } if($_GET["ls3"]=="1"){?>
                                {
					label: "S3",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(120,150,73,1)",
					pointColor : "rgba(120,150,73,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s3"); ?>]
				},
                                <?php } if($_GET["ls4"]=="1"){?>
                                {
					label: "S4",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(160,180,73,1)",
					pointColor : "rgba(160,180,73,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s4"); ?>]
				},
                                <?php } if($_GET["ls5"]=="1"){?>
                                {
					label: "S5",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(160,150,173,1)",
					pointColor : "rgba(160,150,173,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s5"); ?>]
				},
                                <?php } if($_GET["ls6"]=="1"){?>
                                {
					label: "S6",
                                        fillColor : "rgba(177,100,150,0.2)",
					strokeColor : "rgba(60,50,173,1)",
					pointColor : "rgba(60,50,173,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s6"); ?>]
				},
                                <?php } if($_GET["ls7"]=="1"){?>
                                {
					label: "S7",
                                        fillColor : "rgba(200,222,150,0.2)",
					strokeColor : "rgba(160,110,255,1)",
					pointColor : "rgba(160,110,255,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s7"); ?>]
				},
                                <?php } if($_GET["ls8"]=="1"){?>
                                {
					label: "S8",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(22,50,173,1)",
					pointColor : "rgba(22,50,173,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s8"); ?>]
				},
                                <?php } if($_GET["ls9"]=="1"){?>
                                {
					label: "S9",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(160,150,24,1)",
					pointColor : "rgba(160,150,24,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s9"); ?>]
				},
                                <?php } if($_GET["ls10"]=="1"){?>
                                {
					label: "S10",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(86,86,173,1)",
					pointColor : "rgba(86,86,173,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s10"); ?>]
				},
                                <?php } if($_GET["ls11"]=="1"){?>
                                {
					label: "S11",
                                        fillColor : "rgba(168,168,150,0.2)",
					strokeColor : "rgba(168,168,173,1)",
					pointColor : "rgba(168,168,173,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s11"); ?>]
				},
                                <?php } if($_GET["ls12"]=="1"){?>
                                {
					label: "S12",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(35,220,22,1)",
					pointColor : "rgba(35,220,22,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s12"); ?>]
				},
                                <?php } if($_GET["ls13"]=="1"){?>
                                {
					label: "S13",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(222,68,13,1)",
					pointColor : "rgba(222,68,13,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s13"); ?>]
				},
                                <?php } if($_GET["ls14"]=="1"){?>
                                {
					label: "S14",
                                        fillColor : "rgba(200,150,150,0.2)",
					strokeColor : "rgba(90,150,173,1)",
					pointColor : "rgba(90,150,173,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(200,200,220,1)",
					data : [<?php echo graficoTemperaturaDevolveValores24("s14"); ?>]
				},
                                <?php }?>
			]
		}

			
			
		window.onload = function(){
		
			

			var ctx4 = document.getElementById("temp24").getContext("2d");
			window.myLine324 = new Chart(ctx4).Line(lineChartData3, {
				responsive : true
			});

		}
		</script>
	</body>
</html>
<?php
?>