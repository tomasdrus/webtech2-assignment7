@extends('layouts.master')
@section('title', 'Position')
@section('content')

<header class="container mx-auto px-4 mb-5">
    <h1 class="bg-white rounded-md p-5 text-lg font-semibold text-center">Your actual position - <span class="text-orange-500">{{ $ipstack->city }}</span></h1>
</header>

<section class="container mx-auto px-4">
    <div class="bg-white rounded-md p-5 grid gap-5 grid-cols-2">
        <ul>
            <li>
                <span class="inline-block font-bold w-28 mb-3">IP address:</span>
                <span>{{ $ipstack->ip }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-28 mb-3">Type:</span>
                <span>{{ $ipstack->type }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-28 mb-3">Latitude:</span>
                <span>{{ $ipstack->latitude }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-28">Longitude:</span>
                <span>{{ $ipstack->longitude }}</span>
            </li>
        </ul>
        <ul>
            <li>
                <span class="inline-block font-bold w-28 mb-3">Continent:</span>
                <span>{{ $ipstack->continent_name }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-28 mb-3">Country:</span>
                <span>{{ $ipstack->country_name }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-28 mb-3">Region:</span>
                <span>{{ $ipstack->region_name }}</span>
            </li>
            <li>
                <span class="inline-block font-bold w-28">City:</span>
                <span>{{ $ipstack->city }}</span>
            </li>
        </ul>
    </div>
</section>

@endsection