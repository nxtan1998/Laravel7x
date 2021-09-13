@extends('admin_layout')
@section('admin_content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style type="text/css">
	.highcharts-figure, .highcharts-data-table table {
  min-width: 360px; 
  max-width: 1200px;
  margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
<div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="reportrangeTop">
                              <i class="fa fa-calendar"></i>&nbsp;
                              <span></span> <i class="fa fa-caret-down"></i>
              </div>
            </div>
      </div>
<figure class="highcharts-figure">
  <div id="container1">

  </div>
</figure>

<script>
              var start = moment('2017-10-01');
              var end = moment('2017-10-06');
              function Top(start, end) {
                $('.reportrangeTop span').html(start.format('L') + ' - ' + end.format('L'));
              }

              $('.reportrangeTop').daterangepicker({
                  startDate: start,
                  endDate: end,
                  ranges: {
                     'Today': [moment(), moment()],
                     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                     'This Month': [moment().startOf('month'), moment().endOf('month')],
                     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  }
              }, Top);



              	Highcharts.chart('container1', {
                chart: {
                  type: 'line'
                },
                title: {
                  text: 'Monthly Average Temperature'
                },
                subtitle: {
                  text: 'Source: WorldClimate.com'
                },
                xAxis: {
                  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                  title: {
                    text: 'Temperature (°C)'
                  }
                },
                plotOptions: {
                  line: {
                    dataLabels: {
                      enabled: true
                    },
                    enableMouseTracking: false
                  }
                },
                series: [{
                  name: 'Tokyo',
                  data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                }, {
                  name: 'London',
                  data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                }]
              });
</script>
@endsection