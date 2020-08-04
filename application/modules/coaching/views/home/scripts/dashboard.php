<script type="text/javascript" src="<?php echo base_url (THEME_PATH. 'assets/js/chart.bundle.min.js'); ?>"></script>
<script>
var num_users = []; 
var xlabels = [];

<?php
// Data for "Summary Report"
$i = 1;
if ( ! empty ($user_registration) ) {
	foreach ($user_registration as $date=>$num) {
		?> 
		num_users.push(<?php echo $num; ?>);
		xlabels.push("<?php echo date('j D', $date); ?>");
		<?php 
		$i++;
		if ($i >= 10) break;
	}
} 

?>

var ctx = document.getElementById("user-registered").getContext('2d');
var briefChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: xlabels,
        datasets: [{
            data: num_users,
            fill: false,
			borderColor: "#43c115",
			backgroundColor: "#43c115",
			pointBackgroundColor: "#42a5f5",
			pointBorderColor: "#42a5f5",
			pointHoverBackgroundColor: "#42a5f5",
			pointHoverBorderColor: "#42a5f5",
   			label: 'User Created',
        }]
    },
    options: {
        responsive: true,
		
		tooltips: {
			//enabled: false,
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		legend:{
			display: false,
		},
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Date'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Users'
				},
				ticks: {
					min: 0,
					
					stepSize: 1,
              	}
			}]
		},
	    onResize: function(briefChart, size) {
	    	if(size.height < 200){
	    		briefChart.options.scales.xAxes[0].display = false;
	    	}else {
	    		briefChart.options.scales.xAxes[0].display = true;
	    	}
		}
    }
});
</script>