<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://google.com/api/' //could be made configurable (using env for example)
        ]);

        $response = $client->get('cities',[
            'exceptions' => false
        ]);

        if ("200" == $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
            $countriesList =  array("Australia","Canada","United Kingdom","United States");
            $sortedCountries = [];
            foreach ($result['data'] as  $country) {
               if(in_array($country['name'],$countriesList)){
                    $sortedProvinces = [];
                    foreach($country['provinces']['data'] as $province){
                        $province['cities']['data'] = collect($province['cities']['data'])
                            ->sortBy('name')
                            ->values()
                            ->all();
                        $sortedProvinces[] = $province;
                    }
                    $country['provinces']['data'] = collect($sortedProvinces)
                        ->sortBy('name')
                        ->values()
                        ->all();  
                    $sortedCountries[] = $country;
               }
            }
            $sortedCountries = array_reverse($sortedCountries);
            $countries = ['data' => $sortedCountries];
            return view('front.home.index', [
                'countries' => $countries,
                'title' => "Free TS Reviews"
            ]);
        }
    }
}
