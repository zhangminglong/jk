<?php if (!defined('THINK_PATH')) exit();?><div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">系统概览</h1>

    <div class="row placeholders">
    	<?php if(is_array($serverList)): foreach($serverList as $key=>$server): ?><div class="col-xs-6 col-sm-3">
            <dl>
                <dt><h4><?php echo ($server["name"]); ?></h4></dt>
                <dd><?php if($server["protocol"] != ''): echo ($server["protocol"]); ?>://<?php echo ($server["ip"]); ?>:<?php echo ($server["port"]); else: ?>-<?php endif; ?></dd>
                <dd><p class="text-success"><?php echo ($server["status_desc"]); ?></p></dd>
            </dl>                                    
        </div><?php endforeach; endif; ?>          
    </div>
    <h2 class="sub-header">客户端连接监控</h2>
    <div class="table-responsive">
        <canvas id="myChart" width="980" height="300"></canvas>
    </div>
</div>
<script src="/Public/js/Chart/Chart.min.js"></script>
<script type="text/javascript">
    $(function(){
        var ctx = $("#myChart").get(0).getContext("2d");
        var myNewChart = new Chart(ctx); 
        
        var data = {
	labels : ["00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
	datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : [65,59,90,81,56,55,40,65,59,90,81,56,55,40,65,59,90,81,56,55,40,56,55,40]
            },
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                data : [28,48,40,19,96,27,100,28,48,40,19,96,27,100,28,48,40,19,96,27,100,28,48,40]
            }
	]};
        var options = {				
                //Boolean - If we show the scale above the chart data			
                scaleOverlay : false,
                //Boolean - If we want to override with a hard coded scale
                scaleOverride : false,
                //** Required if scaleOverride is true **
                //Number - The number of steps in a hard coded scale
                scaleSteps : null,
                //Number - The value jump in the hard coded scale
                scaleStepWidth : null,
                //Number - The scale starting value
                scaleStartValue : null,
                //String - Colour of the scale line	
                scaleLineColor : "rgba(0,0,0,.1)",
                //Number - Pixel width of the scale line	
                scaleLineWidth : 1,
                //Boolean - Whether to show labels on the scale	
                scaleShowLabels : false,
                //Interpolated JS string - can access value
                scaleLabel : "<%=value%>",
                //String - Scale label font declaration for the scale label
                scaleFontFamily : "'Arial'",
                //Number - Scale label font size in pixels	
                scaleFontSize : 12,
                //String - Scale label font weight style	
                scaleFontStyle : "normal",
                //String - Scale label font colour	
                scaleFontColor : "#666",	
                ///Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,
                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth : 1,	
                //Boolean - Whether the line is curved between points
                bezierCurve : true,
                //Boolean - Whether to show a dot for each point
                pointDot : true,
                //Number - Radius of each point dot in pixels
                pointDotRadius : 3,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth : 1,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth : 2,
                //Boolean - Whether to fill the dataset with a colour
                datasetFill : true,
                //Boolean - Whether to animate the chart
                animation : true,
                //Number - Number of animation steps
                animationSteps : 60,
                //String - Animation easing effect
                animationEasing : "easeOutQuart",
                //Function - Fires when the animation is complete
                onAnimationComplete : null
        };
        myNewChart.Line(data,options);
    });
</script>