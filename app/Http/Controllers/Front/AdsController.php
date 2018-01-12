<?php

namespace App\Http\Controllers\Front;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Cookie\CookieJar;
use Response;
use Cookie;
use Webpatser\Uuid\Uuid;


class AdsController extends Controller
{
    protected $adsClient;
    protected $imagesClient;

    public function __construct () {
        $this->adsClient = new \GuzzleHttp\Client([
            'base_uri' => 'https://Google.com/api/' //could be made configurable (using env for example)
        ]);
        $this->imagesClient = new \GuzzleHttp\Client([
            'base_uri' => 'https://google.com/api/v1/' // could be made configurable
        ]);
       
    }

    public function index (Request $request, CookieJar $cookieJar, $city) {
        if (!$request->cookie('gid')) {
            $gid = Uuid::generate(4);
            $cookieJar->queue(cookie()->forever('gid', $gid));
        } else {
            $gid = $request->cookie('gid');
        }
        $page = $request->input('page', 1);

        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $response = $this->adsClient->get('all',[
			'query' => [
                'category' =>'transgender',
                'city' => $city,
                'limit' => $limit,
                'offset' => $offset,
                'api_token' => 'jahkdjakdjhsakjd'
            ],
            'exceptions' => false
        ]);

        $cityName = str_replace("-", " ", $city);
        $title = ucwords($cityName)." Free TS Reviews";
        
        if ("200" == $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
            
            $images = [];
            $ratings = [];
            $reviews = [];
            $nearestCities = [];
            

            if(isset($result['images'])){
                $images = $result['images'] ?: [];
            }
            if(isset($result['nearestCities'])){
                $nearestCities = $result['nearestCities'] ?: [];
            }
            if(isset($result['ratings'])){
                $ratings = $result['ratings'] ?: [];
            }
            if(isset($result['reviews'])){
                $reviews = $result['reviews'] ?: [];
            }

            $ads = new LengthAwarePaginator($result['ads']['data']?:[], $result['count'], $limit);
            $ads->setPath($request->url());
            
            return view('front.ads.index', [
                'ads' => $ads,
                'images' => $images,
                'city' => $city,
                'empty' => true,
                'title' => $title,
                'nearestCities' => $nearestCities,
                'cityName' => $cityName,
                'reviews' => $reviews,
                'ratings' => $ratings,
                'gid' => $gid
            ]);
        } else {
            return view('front.ads.index', [
                'ads' => "",
                'images' => "",
                'city' => $city,
                'message' => "No data found",
                'empty' => false,
                'title' => $title,
                'nearestCities' =>'',
                'cityName' => $cityName,
                'reviews' => [],
                'ratings' => [],
                'gid' => $gid
            ]);    
        }
        abort(404);

    }

    public function show (Request $request, CookieJar $cookieJar, $city, $number,$category= null) {
        if (!$request->cookie('gid')) {
            $gid = Uuid::generate(4);
            $cookieJar->queue(cookie()->forever('gid', $gid));
        } else {
            $gid = $request->cookie('gid');
        }
        $page = $request->input('page', 1);
        
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $response = $this->adsClient->get($number,[
			'query' => [
                'city' => $city
            ],
            'exceptions' => false
        ]);
        if ("200" == $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
            $ad = $result['ad']['data'];
            $images = $result['images']['data']['images'] ?: [];
            $relatedNumbers = $result['relatedNumbers']['data'];
            $relatedImages = $result['relatedImages']['data'];

            //Page Title
            $cityName = str_replace("-", " ", $city);
            $title = $number."'s Summary Info - ".ucwords($cityName);
            $reviewsRatings = $this->getReviews([$number]);
            return view('front.ads.show', [
                'ad' => $ad,
                'city' =>$city,
                'images' => $images,
                'relatedNumbers' => $relatedNumbers,
                'relatedImages' => $relatedImages,
                'title' => $title,
                'reviews' => $reviewsRatings['reviews'],
                'ratings' => $reviewsRatings['ratings'],
                'gid' => $gid
            ]);
            
        }
        abort(404);
    }

    public function images (Request $request, CookieJar $cookieJar, $city, $number) {
        if (!$request->cookie('gid')) {
            $gid = Uuid::generate(4);
            $cookieJar->queue(cookie()->forever('gid', $gid));
        } else {
            $gid = $request->cookie('gid');
        }
        $page = $request->input('page', 1);
        
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $response = $this->adsClient->get($number,[
            'query' => [
                'city' => $city
            ],
            'exceptions' => false
        ]);
        if ("200" == $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
            $ad = $result['ad']['data'];
            $images = $result['images']['data']['images'] ?: [];
            $relatedNumbers = $result['relatedNumbers']['data'];
            $relatedImages = $result['relatedImages']['data'];

            //Page Title
            $cityName = str_replace("-", " ", $city);
            $title = $number."'s Summary Info - ".ucwords($cityName);

            $reviewsRatings = $this->getReviews([$number]);
            return view('front.ads.showlarge', [
                'ad' => $ad,
                'city' =>$city,
                'images' => $images,
                'relatedNumbers' => $relatedNumbers,
                'relatedImages' => $relatedImages,
                'title' => $title,
                'reviews' => $reviewsRatings['reviews'],
                'ratings' => $reviewsRatings['ratings'],
                'gid' => $gid
            ]);
        }
        abort(404);
    }

    public function history (Request $request, CookieJar $cookieJar, $city, $number) {
        if (!$request->cookie('gid')) {
            $gid = Uuid::generate(4);
            $cookieJar->queue(cookie()->forever('gid', $gid));
        } else {
            $gid = $request->cookie('gid');
        }
        $page = $request->input('page', 1);
        
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $response = $this->adsClient->get($number.'/history',[
            'exceptions' => false
        ]);
        $title = $number."'s Reputation and History - Free TS Reviews";
        $numberFormat =  '('.substr($number, 0, 3).') '.substr($number, 3, 3).'-'.substr($number,6);
        if ("200" == $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
            $ads = new LengthAwarePaginator($result['ads']['data']?:[], $result['count'], $limit);
            $ads->setPath($request->url());
            $reviewsRatings = $this->getReviews([$number]);
            return view('front.ads.history', [
                'ads' => $ads,
                'page' => $page,
                'title' => $title,
                'formatedNumber' => $numberFormat,
                'number' => $number,
                'city' =>$city,
                'reviews' => $reviewsRatings['reviews'],
                'ratings' => $reviewsRatings['ratings'],
                'gid' => $gid
            ]);
        }
        abort(404);
    }

    //Search Phone Number
    public function search(Request $request, CookieJar $cookieJar, $number){
        if (!$request->cookie('gid')) {
            $gid = Uuid::generate(4);
            $cookieJar->queue(cookie()->forever('gid', $gid));
        } else {
            $gid = $request->cookie('gid');
        }
        $searchNumber = $number; 
        $number = preg_replace('/\D+/', '', $number);        
        $page = $request->input('page', 1);

        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $response = $this->adsClient->get('search/'.$number,[
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
                'category' => 'transgender',
                'api_token' => 'dasdasdasdasd'          
            ],
            'exceptions' => true
        ]);
           
         
        if ("200" == $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
            $images = [];
            $ratings = [];
            $reviews = [];

            if(isset($result['images'])){
                $images = $result['images'] ?: [];
            }
            if(isset($result['ratings'])){
                $ratings = $result['ratings'] ?: [];
            }
            if(isset($result['reviews'])){
                $ratings = $result['reviews'] ?: [];
            }
            $ads = new LengthAwarePaginator($result['ads']['data']?:[], $result['count'], $limit);
            $ads->setPath($request->url());

            return view('front.ads.index', [
                'ads' => $ads,
                'images' => $images,
                'empty' => true,
                'title' => 'Search results for '.$searchNumber,
                'cityName' => 'Search results',
                'nearestCities' => [],
                'searchNumber' => $searchNumber,
                'reviews' => $ratings,
                'ratings' => $reviews,
                'gid' => $gid
            ]);
        }

        abort(404);
    }

    //set Cookie
    public function setCookie(CookieJar $cookieJar,Request $request,$id,$name){
        $cookieJar->queue(cookie()->make($name, $id));
        return Response::json(array('status' => 200, 'message' => 'cookie updated'));
    }

    public function getReviews(array $phoneNumbers) {
        try {
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://google.com/api/v1/']);
            $response = $client->post('reviews', [
                'query' => [
                    'api_token' => 'sadsadsadsadasd',
                    'phone_numbers' => $phoneNumbers
                ],
                'exceptions' => false
            ]);
            if ('200' == $response->getStatusCode()) {
                return json_decode($response->getBody(), true);
            } else {
                return ['reviews'=>[], 'ratings'=>[], 'status'=>$response->getStatusCode()];
            } 
        } catch (ClientException $e) {
            $response = $e->getResponse();
            return ['reviews'=>[], 'ratings'=>[], 'status'=>$response->getStatusCode()];
        }

    }
}
