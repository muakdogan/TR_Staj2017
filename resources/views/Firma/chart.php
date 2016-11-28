<!DOCTYPE html>
<html>
	<head>
		<title>ChartJS - Pie Chart</title>
		<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="../../../js/chart.js"></script>
	</head>
	<body>
		<canvas id="mycanvas" width="256" height="256">
                    <?php $ilanSay=12;
                          $basvurSay = 10;
                          ?>
		<script>
                        var ilanSay=10;
                        var basvurSay=15;
			$(document).ready(function(){
				var ctx = $("#mycanvas").get(0).getContext("2d");
				//pie chart data
				//sum of values = 360
				var data = [
					{
						value: (ilanSay*360/(ilanSay+basvurSay)),
						color: "cornflowerblue",
						highlight: "lightskyblue",
						label: "İlan Sayım"
					},
					{
						value: (basvurSay*360/(ilanSay+basvurSay)),
						color: "lightgreen",
						highlight: "yellowgreen",
						label: "Başvuru Sayım"
					}
					
				];
				//draw
				var piechart = new Chart(ctx).Pie(data);
			});
		</script>
	</body>
</html>