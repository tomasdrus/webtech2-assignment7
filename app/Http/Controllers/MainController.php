<?php

namespace App\Http\Controllers;

use App\Models\ViewsCity;
use App\Models\ViewsPage;
use App\Models\ViewsTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    function index(Request $request) {
        $api = $this->get_api($request);

        $this->count_visits($api->ipstack, $api->openweather, 'weather', $request);

        return view('weather')->with(['openweather'=>$api->openweather]);
    }

    function position(Request $request) {
        $api = $this->get_api($request);

        $this->count_visits($api->ipstack, $api->openweather, 'position', $request);

        return view('position')->with(['ipstack'=>$api->ipstack]);
    }

    function statistics(Request $request) {
        $api = $this->get_api($request);

        $this->count_visits($api->ipstack, $api->openweather, 'statistics', $request);

        $times = ['times' => ViewsTime::get()];
        $pages = ['pages' => ViewsPage::get()];

        $countries = ['countries' => ViewsCity::select('*', DB::raw('SUM(count) as count'))->groupBy('country')->get()];

        return view('statistics')->with($times)->with($pages)->with($countries);
    }

    function country($name) {
        $country = ViewsCity::where('country', '=', $name)->get();
        return json_encode($country);
    }

    function coordinates() {
        $coordinates = ViewsCity::select('lat','lng')->get();
        return json_encode($coordinates);
    }

    function get_api($request) {
        $ip = $request->ip();
        //$ip = '178.40.244.195'; //localhost set custom vpn for testing and serving

        $client = new \GuzzleHttp\Client();
        $ipstackResponse = $client->request('GET', "http://api.ipstack.com/$ip?access_key=" . env('IPSTACK_ACCESS_KEY'));
        $ipstack = json_decode($ipstackResponse->getBody());

        $openweatherResponse = $client->request('GET', "https://api.openweathermap.org/data/2.5/onecall?lat=$ipstack->latitude&lon=$ipstack->longitude&exclude=minutely&lang=sk&units=metric&appid=" . env('OPENWEATHER_ACCESS_KEY'));
        $openweather = json_decode($openweatherResponse->getBody());

        return (object) ['ipstack' => $ipstack, 'openweather' => $openweather];
    }

    function count_visits($ipstack, $openweather, $pagename, $request){
        $ip = $request->ip();

        $viewsCity = ViewsCity::where('country', '=', $ipstack->country_name)->where('city', '=', $ipstack->city)->first();
        if (!$viewsCity) {
            $viewsCity = new ViewsCity();
            $viewsCity->country = $ipstack->country_name;
            $viewsCity->city = $ipstack->city;
            $viewsCity->flag = $ipstack->location->country_flag;
            $viewsCity->lat = $ipstack->latitude;
            $viewsCity->lng = $ipstack->longitude;
            $viewsCity->count += 1;
            Cookie::queue('today', $ip, time() + 86400); // 24 hours
        }

        if($request->hasCookie('today') == false){
            $viewsCity->count += 1;
            Cookie::queue('today', $ip, time() + 86400); // 24 hours
        }
        
        if(!$viewsCity->save()){
            dd('Views city database error');
        }

        $time = date('H:i', $openweather->current->dt + $openweather->timezone_offset);

        $viewsTime = ViewsTime::where('from', '<', $time)->where('to', '>', $time)->first();
        $viewsTime->count += 1;

        if(!$viewsTime->save()){
            dd('Views time database error');
        }

        $viewsPage = ViewsPage::where('page', '=', $pagename)->first();
        $viewsPage->count += 1;

        if(!$viewsPage->save()){
            dd('Views page database error');
        }
    }
}
