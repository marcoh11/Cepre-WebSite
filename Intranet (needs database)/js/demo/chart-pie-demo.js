// Set new default font family and font color to mimic Bootstrap's default styling
//<?php 
// $variable=1;

//?>
//<script>
      // var myvar = <?php echo json_encode($variable); ?>;
      //  alert (myvar);

Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Corretas", "Incorrectas", "En blanco"],
    datasets: [{
      data: [myvar, 20, 15],
      backgroundColor: ['#1cc88a', '#e74a3b', '#f6c23e'],
      hoverBackgroundColor: ['#007bff', '#007bff', '#007bff'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
//</script>