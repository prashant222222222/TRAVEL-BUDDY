<?php
$apiKey = "eefd17181640093941f51105f466825e";
$cityId = "1273293";
if (!empty($_POST))
{$cityId=$_POST["id"];
}




$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0); //TRUE to include the header in the output.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//	TRUE to return the raw output when
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//TRUE to follow any "Location: " header that the server sends as part of the HTTP header
curl_setopt($ch, CURLOPT_VERBOSE, 0); //TRUE to output SSL certification information
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//FALSE to stop cURL from verifying the peer's certificate.
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>

<!doctype html>
<html>

<head>
    <title>Forecast Weather using OpenWeatherMap with PHP</title>
</head>

<body>
    <div class="report-container">
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
                class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
</body>

</html>