<?php
/* @var string $city */
/* @var Weather $weatherNow */

/* @var WeatherForecast $weatherForecast */

use App\Models\Weather;
use App\Models\WeatherForecast;
use Carbon\Carbon;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather report</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

<header>
    <?php require_once 'views/navigationBar.php' ?>
</header>

<div class="body-element-margin">

    <div style=" gap:10px;" class="center-flex">
    <span style="font-size: 2em; font-weight: bold; margin-top: 12px"><?= $city; ?>
    </span>
        <div style="width: 60px">
            <img src="https://openweathermap.org/img/wn/<?= $weatherNow->getWeatherImageId(); ?>@2x.png"
                 alt="<?= $weatherNow->getWeatherDescription(); ?>"
                 style="width: 100%">
        </div>
    </div>

    <div class="center-flex">
        <p>
            The temperature now is <?= $weatherNow->getTemperature(); ?>°C and humidity is
            at <?= $weatherNow->getHumidity(); ?>%
        <p>
    </div>

    <div style="align-content: center">
        <div class="center-flex">
            <h3>Weather for next 5 days: </h3>
        </div>
        <div class="forecast-div">

            <?php if (substr((Carbon::now()->setTimeFrom()), 11, 2) !== '23' && substr((Carbon::now()->setTimeFrom()), 11, 2) !== '00'): ?>
            <table class="forecast-table" border="1" cellpadding="10">
                <tr>
                    <th colspan="4"><?= substr(Carbon::now()->dayName, 0, 3); ?></th>
                </tr>
                <tr>
                    <th>
                        Time
                    </th>
                    <th>
                        Weather
                    </th>
                    <th>
                        Temperature
                    </th>
                    <th>
                        Humidity
                    </th>
                </tr>
                <?php endif; ?>

                <?php $previousDay = null; ?>
                <?php foreach ($weatherForecast

                               as $nextThreeHours): ?>

                    <?php
                    $weatherForecast = new Weather($city, $nextThreeHours['main']['temp'], $nextThreeHours['main']['humidity'], $nextThreeHours['main']['feels_like'], $nextThreeHours['weather'][0]['description'], $nextThreeHours['weather'][0]['icon']);
                    $unixCode = $nextThreeHours['dt'];
                    $day = Carbon::parse($unixCode)->toDateTime()->format('D');
                    $hour = Carbon::parse($unixCode)->toDateTime()->format('H');
                    ?>

                    <?php if ($day !== $previousDay || $previousDay == null): ?>
                        <table class="forecast-table" border="1" cellpadding="10">

                    <?php endif; ?>

                    <?php if ($hour == 00): ?>
                        <tr>
                            <th colspan="4"><?= $day; ?></th>
                        </tr>
                        <tr>
                            <th>
                                Time
                            </th>
                            <th>
                                Weather
                            </th>
                            <th>
                                Temperature
                            </th>
                            <th>
                                Humidity
                            </th>
                        </tr>

                    <?php endif; ?>
                    <tr>
                        <td>
                            <?= $hour . ":00"; ?>
                        </td>
                        <td>
                            <img src="https://openweathermap.org/img/wn/<?= $weatherForecast->getWeatherImageId(); ?>@2x.png"
                                 alt="<?= $weatherForecast->getWeatherDescription(); ?>" width="30">
                        </td>
                        <td>
                            <?= $weatherForecast->getTemperature(); ?>°C
                        </td>
                        <td>

                            <?= $weatherForecast->getHumidity(); ?>%
                        </td>
                    </tr>
                    <?php $previousDay = $day; ?>

                    <?php if ($day !== $previousDay || $previousDay == null): ?>
                        <?php var_dump($previousDay); ?>
                        </table>
                    <?php endif; ?>
                <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>