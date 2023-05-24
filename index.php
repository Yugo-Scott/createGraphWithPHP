<?php

$response = file_get_contents("https://randomuser.me/api/?results=5000");

// json_decode() converts a JSON string into a PHP variable
$json_data = json_decode($response, true);

// print_r($json_data['results'][0]['gender']);
// print_r($json_data['results'][0]['dob']['age']);
// print_r($json_data['results'][0]['location']['country']);

$data_list = array(); // empty array

// loop through the results
foreach ($json_data['results'] as $result) {
    $data_list[] = array(
        'gender' => $result['gender'],
        'age' => $result['dob']['age'],
        // 'country' => $result['location']['country']
    );
}

// print_r($data_list);
// print_r($data_list[0]["gender"]);

// gender count
$gender_counts = array('male' => 0, 'female' => 0);
foreach ($data_list as $data) {
    $gender_counts[$data['gender']]++;
};
// print_r($gender_counts);

// age count
$age_counts = array(
    '10s' => 0,
    '20s' => 0,
    '30s' => 0,
    '40s' => 0,
    '50s' => 0,
    '60s' => 0,
    '70s' => 0,
    '80s' => 0,
    '90s' => 0,
);
foreach ($data_list as $data) {
    $age = $data['age'];
    if ($age < 20) {
        $age_counts['10s']++;
    } elseif ($age < 30) {
        $age_counts['20s']++;
    } elseif ($age < 40) {
        $age_counts['30s']++;
    } elseif ($age < 50) {
        $age_counts['40s']++;
    } elseif ($age < 60) {
        $age_counts['50s']++;
    } elseif ($age < 70) {
        $age_counts['60s']++;
    } elseif ($age < 80) {
        $age_counts['70s']++;
    } elseif ($age < 90) {
        $age_counts['80s']++;
    } else {
        $age_counts['90s']++;
    }
};
// print_r($age_counts);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gender Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <ul>
        <li><a href="get.php">戻る</a></li>
        </ul>
            <div style="width: 500px; height: 500px">
                <canvas id="genderChart"></canvas> <!-- this is where the chart will be rendered -->
                <canvas id="ageChart"></canvas> <!-- this is where the chart will be rendered -->
            </div>
    </div>
    <!-- <div style="width: 500px; height: 500px">
    </div> -->
    <script>
        // gender chart
        var ctx = document.getElementById('genderChart').getContext('2d'); // get the context of the canvas element we want to select
        var chart = new Chart(ctx, { // create a new chart object
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [<?php echo $gender_counts['male']; ?>, <?php echo $gender_counts['female']; ?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    // age chart
    ctx = document.getElementById('ageChart').getContext('2d');
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['10s', '20s', '30s', '40s', '50s', '60s', '70s', '80s', '90s'],
                datasets: [{
                    label: 'Age',
                    data: [
                        <?php echo $age_counts['10s']; ?>, 
                        <?php echo $age_counts['20s']; ?>, 
                        <?php echo $age_counts['30s']; ?>, 
                        <?php echo $age_counts['40s']; ?>, 
                        <?php echo $age_counts['50s']; ?>, 
                        <?php echo $age_counts['60s']; ?>, 
                        <?php echo $age_counts['70s']; ?>, 
                        <?php echo $age_counts['80s']; ?>, 
                        <?php echo $age_counts['90s']; ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
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
