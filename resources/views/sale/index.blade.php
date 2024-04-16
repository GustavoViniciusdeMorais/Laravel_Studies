<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
  
      function drawChart() {
        var data = google.visualization.arrayToDataTable({{ Js::from($result) }});
   
        var options = {
          chart: {
            title: 'Product Sales',
            subtitle: 'Product and Ammount',
          },
        };
  
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
  
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <h1>Product Sales Ammount</h1>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>

{{-- @extends('templates.main')

@section('content')
    <h1>Sales Chart</h1>

    <ul>
    @foreach ($salesAmmount as $saleQtd)
        <li>{{ $saleQtd->product_id }}, {{ $saleQtd->qtd }} </li>
    @endforeach
    </ul>

@endsection --}}