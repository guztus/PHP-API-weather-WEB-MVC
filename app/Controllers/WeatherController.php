<?php

namespace App\Controllers;

use App\ApiClient;

class WeatherController
{
    public function index()
    {
        $city = $_GET['city'] ?? 'Riga';

        $apiConnection = new ApiClient($_ENV['API_KEY']);
        $weatherNow = $apiConnection->getWeatherNow($city);
        $weatherForecast = $apiConnection->getWeatherForecast($city);

        require_once 'views/forecast.php';
    }
}