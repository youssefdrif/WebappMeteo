<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Web app Météo</title>
</head>
<body>
    <div class="card">
        <form method="GET" action="{{ route('weather.search') }}" class="search">
            <input type="text" name="city" placeholder="Rechercher une ville ou un pays" spellcheck="false">
            <button type="submit" class="search" aria-label="search"><x-zondicon-search /></button>
        </form>
        @if (session('error'))
          <div class="error">{{ session('error') }}</div>
        @endif
        @if (isset($city))
            @if (isset($error))
                <div class="alert alert-danger">{{ $error }}</div>
            @endif
            <div class="weather">
                @if (isset($weather))
                    @switch($weather)
                        @case('Thunderstorm')
                        <img src="{{ asset('images/thunderstorm.png') }}" alt="thunderstorm">
                        @break

                        @case('Drizzle')
                        <img src="{{ asset('images/drizzle.png') }}" alt="drizzle">
                        @break

                        @case('Rain')
                        <img src="{{ asset('images/rain.png') }}" alt="rain">
                        @break

                        @case('Snow')
                        <img src="{{ asset('images/snow.png') }}" alt="snow">
                        @break

                        @case('Clear')
                        <img src="{{ asset('images/clear.png') }}" alt="clear">
                        @break

                        @case('Clouds')
                        <img src="{{ asset('images/clouds.png') }}" alt="clouds">
                        @break

                        @default
                        <img src="{{ asset('images/clouds.png') }}" alt="clouds">
                    @endswitch
                @else
                    <img src="{{ asset('images/clouds.png') }}" alt="clouds">
                @endif
                @if (isset($temperature))
                    <h1 class="temperature">{{ $temperature }}°C</h1>
                @endif
                <h2 class="ville">{{ $city }}</h2>
                <div class="details">
                    <div class="col">
                        <img class="img" src="{{ asset('images/humidity.png') }}" alt="humidity">
                        <div class="column">
                            <p>Humidité</p>
                            <p class="humidite">{{ $humidity ?? '' }}%</p>
                        </div>
                    </div>
                    <div class="col">
                        <img class="img" src="{{ asset('images/wind.png') }}" alt="wind">
                        <div class="column">
                            <p>Vitesse du vent</p>
                            <p class="vent">{{ $wind ?? '' }}km/h</p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (isset($message))
            <div class="alert alert-danger">{{ $message }}</div>
        @endif
    </div>
</body>
</html>
