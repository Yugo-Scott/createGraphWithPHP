<?php
$responseStock = file_get_contents("https://eodhistoricaldata.com/api/eod/MCD.US?from=2022-06-01&to=2023-05-23&period=d&fmt=json&api_token=646debab478da4.85854012");

// json_decode() converts a JSON string into a PHP variable
$json_data_stock = json_decode($responseStock, true);
// print_r($json_data_stock);

$dates = [];
$highs = [];
$lows = [];

foreach ($json_data_stock as $data) {
    $dates[] = $data['date'];
    $highs[] = $data['high'];
    $lows[] = $data['low'];
}

// print_r($dates);
// print_r($highs);
// print_r($lows);

?>

<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <ul>
        <li><a href="get.php">戻る</a></li>
        </ul>
            <canvas id="chart"></canvas>
    </div>
    <script>
        // Replace these with the actual lists from the PHP cod
        var ctx = document.getElementById('chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo '"' . implode('","', $dates) . '"'; ?>],
                datasets: [{
                    label: 'High',
                    data: [<?php echo implode(',', $highs); ?>],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Low',
                    data: [<?php echo implode(',', $lows); ?>],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>










