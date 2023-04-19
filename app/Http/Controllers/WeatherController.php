<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;

class WeatherController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getWeather(Request $request)
    {
        $apiKey = '3e64834ebcaa50ddc8973c90c91d847a';
    $city = $request->input('city');

    if (empty($city)) {
        return redirect('/weather')->with('alert', 'Veuillez entrer une ville ou un pays');
    }

    $client = new Client();
    $response = $client->request('GET', "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}");

    $statusCode = $response->getStatusCode();
    $body = json_decode($response->getBody());

    if ($statusCode == 404) {
        $error = "La ville spécifiée n\'existe pas.";
        return view('index', compact('error'));
    }

    if ($statusCode !== 200) {
        return view('index')->with('error', 'La ville spécifiée n\'existe pas.');
    }

    return view('index', [
        'city' => $city,
        'weather' => $body->weather[0]->main,
        'temperature' => round($body->main->temp - 273.15),
        'humidity' => round($body->main->humidity),
        'wind' => round($body->wind->speed)
    ]);
    }
}