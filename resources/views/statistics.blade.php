@extends('layouts.master')
@section('title', 'Statistics')
@section('content')

<header class="container mx-auto px-4 mb-5">
    <h1 class="bg-white rounded-md p-5 text-lg font-semibold text-center">Statistics for - <span class="text-orange-500">today</span></h1>
</header>

<section id="modal" class="fixed z-10 inset-0 overflow-y-auto bg-gray-600 bg-opacity-60 flex items-center justify-center h-screen hidden">
    <div class="bg-white rounded-md p-5 relative">
        <h3 class="text-xl font-semibold text-center mb-5" id="modalName">Slovakia</h3>
        <button id="modalClose" class="absolute right-5 top-2.5 leading-none text-3xl hover:text-orange-600">&times;</button>
        <table class="w-full bg-white border-2 border-gray-200">
            <thead class="bg-gray-200 text-sm uppercase font-semibold text-left">
                <tr>
                    <th class="py-3 px-4 font-semibold text-sm w-72">City name</th>
                    <th class="py-3 px-4 font-semibold text-sm">View counts</th>
                </tr>
            </thead>
            <tbody id="modalInfo">
                <tr>
                    <td class="py-3 px-4 border-2 border-gray-200 text-orange-500"></td>
                    <td class="py-3 px-4 border-2 border-gray-200 text-center"></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section class="container mx-auto px-4 mb-5">
    <div class="bg-white rounded-md p-5">
        <table class="w-full bg-white border-2 border-gray-200">
            <thead class="bg-gray-200 text-sm uppercase font-semibold text-left">
                <tr>
                    <th class="py-3 px-4 font-semibold text-sm w-20 text-center">Flag</th>
                    <th class="py-3 px-4 font-semibold text-sm">Country name</th>
                    <th class="py-3 px-4 font-semibold text-sm w-40 text-center">View counts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <td class="py-3 px-4 border-2 border-gray-200">
                        <img src="{{ $country->flag }}" alt="{{ $country->country }} flag">
                    </td>
                    <td class="py-3 px-4 border-2 border-gray-200 text-orange-500"><button onclick="modalOpen('{{ $country->country }}')">{{ $country->country }}</button></td>
                    <td class="py-3 px-4 border-2 border-gray-200 text-center">{{ $country->count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<section class="container mx-auto px-4 mb-5">
    <div class="bg-white rounded-md p-5">
        <div id="map"></div>
    </div>
</section>

<section class="container mx-auto px-4 mb-5">
    <div class="grid gap-5 grid-cols-2">
        <ul class="bg-white rounded-md p-5 ">
            <li class="mb-4">
                <h3 class="text-lg font-semibold">Views by time</h3>
            </li>
            @foreach ($times as $time)
                <li class="<?= $loop->last ? '' : 'mb-3' ?>">
                    <span class="inline-block font-semibold w-40">{{ date('H:i',strtotime($time->from)) . ' - ' . date('H:i',strtotime($time->to)) }}</span>
                    <span class="text-orange-500">{{$time->count}}</span>
                </li>
            @endforeach
        </ul>

        <ul class="bg-white rounded-md p-5 ">
            <li class="mb-4">
                <h3 class="text-lg font-semibold">Views by pages</h3>
            </li>
            @foreach ($pages as $page)
                <li class="<?= $loop->last ? '' : 'mb-7' ?>">
                    <span class="inline-block font-semibold w-32">{{ucfirst($page->page)}}</span>
                    <span class="text-orange-500">{{$page->count}}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlmJl85wNKyOz5kCPQ-7yZH1PNSb833S8&callback=initMap&libraries=places" async defer></script>

<script>
    function initMap() {
        const mapContainer = document.getElementById("map");
        mapContainer.style.height = '600px';
        const myLatLng = { lat: 48.890, lng: 19.660 };
        const map = new google.maps.Map(mapContainer, {
            zoom: 5,
            center: myLatLng,
        });

        fetch('/coordinates')
        .then(response => response.json())
        .then(coordinates => {
            console.log(coordinates)
            coordinates.forEach(coords => {
                new google.maps.Marker({
                    position: coords,
                    map,
                });
            });
        })
        .catch(function(error) {
            console.error(error);
        });

    }
</script>

<script>
    const modal = document.getElementById('modal');
    const modalClose = document.getElementById('modalClose');
    const modalName = document.getElementById('modalName');
    const modalInfo = document.getElementById('modalInfo');

    modalClose.addEventListener('click', () => {
        modal.classList.add('hidden');
    })

    const modalOpen = (city) => {
        modalName.innerText = city;
        modalInfo.innerHTML = '';

        fetch(`/country/${city}`)
        .then(response => response.json())
        .then(cities => {
            cities.forEach(city => {
                const template = `
                    <tr>
                        <td class="py-3 px-4 border-2 border-gray-200 text-orange-500">${city.city}</td>
                        <td class="py-3 px-4 border-2 border-gray-200 text-center">${city.count}</td>
                    </tr>`;
                modalInfo.insertAdjacentHTML('beforeend', template);
            });
        })
        .catch(function(error) {
            console.error(error);
        });

        modal.classList.remove('hidden');
    }
</script>

@endsection