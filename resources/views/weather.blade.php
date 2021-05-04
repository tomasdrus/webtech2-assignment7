@extends('layouts.master')
@section('title', 'Weather')
@section('content')


<header class="container mx-auto px-4 mb-5">
    <h1 class="bg-white rounded-md p-5 text-center font-semibold text-lg">Forecast for today - <span class="text-orange-500">{{ date('j.n.Y', $openweather->current->dt + $openweather->timezone_offset) }}</span></h1>
</header>

<section class="container mx-auto px-4 grid gap-5 grid-cols-3 mb-5">

    <ul class="bg-white rounded-md p-5 pt-0">
        <li>
            <img src="http://openweathermap.org/img/wn/{{$openweather->current->weather[0]->icon}}@2x.png" alt="Weather icon {{$openweather->current->weather[0]->main}}" class="mx-auto">
        </li>
        <li>
            <span class="inline-block font-bold w-32 mb-2">Date & time:</span>
            <span class="text-xl font-semibold text-orange-500">{{ date('H:i', $openweather->current->dt + $openweather->timezone_offset) }}</span>
        </li>
        <li>
            <span class="inline-block font-bold w-32 mb-2">Weather:</span>
            <span>{{ $openweather->current->weather[0]->main }}</span>
        </li>
        <li>
            <span class="inline-block font-bold w-32 mb-2">Temperature:</span>
            <span>{{ $openweather->current->temp }} °C</span>
        </li>
        <li>
            <span class="inline-block font-bold w-32 mb-2">Feels like:</span>
            <span>{{ $openweather->current->feels_like }} °C</span>
        </li>
        <li>
            <span class="inline-block font-bold w-32 mb-2">Humidity:</span>
            <span>{{ $openweather->current->humidity }} %</span>
        </li>
        <li>
            <span class="inline-block font-bold w-32 mb-2">Sunrise:</span>
            <span>{{ date('H:i', $openweather->current->sunrise + $openweather->timezone_offset) }}</span>
        </li>
        <li>
            <span class="inline-block font-bold w-32 mb-2">Sunset:</span>
            <span>{{ date('H:i', $openweather->current->sunset + $openweather->timezone_offset) }}</span>
        </li>
        <li>
            <span class="inline-block font-bold w-32">Wind speed:</span>
            <span>{{ $openweather->current->wind_speed }} km/h</span>
        </li>
    </ul>

    @foreach ($openweather->hourly as $weather)
        @if (date('H:i', $weather->dt + $openweather->timezone_offset) < date('H:i', $openweather->current->dt + $openweather->timezone_offset))
            @continue
        @endif
        @if (date('j.n.Y', $weather->dt + $openweather->timezone_offset) > date('j.n.Y', $openweather->current->dt + $openweather->timezone_offset))
            @break
        @endif

        <ul class="bg-white rounded-md p-5 pt-0">
            <li>
                <img src="http://openweathermap.org/img/wn/{{$weather->weather[0]->icon}}@2x.png" alt="Weather icon {{$weather->weather[0]->main}}" class="mx-auto">
            </li>
            <li>
                <span class="inline-block font-bold w-32 mb-2">Date & time:</span>
                <span class="text-xl font-semibold text-orange-500">{{ date('H:i', $weather->dt + $openweather->timezone_offset) }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-32 mb-2">Weather:</span>
                <span>{{ $weather->weather[0]->main }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-32 mb-2">Temperature:</span>
                <span>{{ $weather->temp }} °C</span>
            </li>
            <li>
                <span class="inline-block font-bold w-32 mb-2">Feels like:</span>
                <span>{{ $weather->feels_like }} °C</span>
            </li>
            <li>
                <span class="inline-block font-bold w-32 mb-2">Humidity:</span>
                <span>{{ $weather->humidity }} %</span>
            </li>
            <li>
                <span class="inline-block font-bold w-32 mb-2">UV Index:</span>
                <span>{{ $weather->uvi}}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-32 mb-2">Visibility:</span>
                <span>{{ $weather->visibility}} m</span>
            </li>
            <li>
                <span class="inline-block font-bold w-32">Wind speed:</span>
                <span>{{ $weather->wind_speed }} km/h</span>
            </li>
        </ul>
    @endforeach

</section>

@endsection