@extends('front.layout')
@section('title', $title)
@section('content')
<div class="details">
  <h2 class="search_title">{{$formatedNumber}}</h2>
  <p class="breadcrumbs">
    <a href="/" class=""><i class="fa fa-home" aria-hidden="true"></i></a> 
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    <a class="go-back-link" id="go-back" href="/{{$city}}/">{{$city}}</a>
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    <a href="/{{$city}}/{{$number}}" class="">{{$number}}</a> 
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    History
  </p>
        
  <div class="row mb50">
    <div class="col-sm-12 col-md-9">
      <h3 class="summery-title col-r-heading">History of {{$formatedNumber}}</h3>
      <div class="summery-details">
        <div class="row-c2">
          <div class="row-c2-col-l">
            <i class="fa fa-dribbble"></i>
          </div>
          <div class="row-c2-col-c w120">
            Recent Source: 
          </div>
          <div class="row-c2-col-r wb">
            @if(isset($ads[0]['ad_url']))
              <?php $url =  parse_url($ads[0]['ad_url']); ?>
              {{$url['host']}}
            @endif
          </div>
          
        </div>
      </div>
      <div class="rate">
        <a href="#" id="rate_button" class="rate-btn">
          <span>Tap for Rate</span>
        </a>
      </div>
      <hr class="cus-line">
      <div class="row">
        <div class="col-md-12">
          <div class="row history-row-heading mrl">
            <div class="col-5 col-sm-4 col-md-3">
              <strong>History</strong>
            </div>
            <div class="col-4 col-sm-4 col-md-3 mobile-no-padding">
              <strong>City</strong>
            </div>
            <div class="col-md-2 desktop-only">
              <strong>Category</strong>
            </div>
            <div class="col-3 col-sm-4 col-md-4 mobile-no-padding">
              <strong>Source</strong>
            </div>
          </div>

          @foreach($ads as $ad)
          <div class="row history-row mrl">
            <div class="col-5 col-sm-4 col-md-3">
            <span class="desktop-only">{{ date('D, M j, Y', strtotime($ad['datetime'])) }}</span>
            <span class="mobile-only weight-normal">{{ date('M j, Y', strtotime($ad['datetime'])) }}</span>
          </div>
          <div class="col-4 col-sm-4 col-md-3 mobile-no-padding">
            <a class="category-link-search gcity-c" id="city-history:reading" href="/{{$ad['city']['data']['uri']}}">
              <span class="desktop-only">{{$ad['city']['data']['name']}}</span>
              <span class="mobile-only weight-normal">{{ truncate($ad['city']['data']['name'],9,"..") }}</span>
            </a>
          </div>
          <div class="col-md-2 col-sm-12 desktop-only">
          {{$ad['category']}}
          </div>
          <div class="col-3 col-sm-4 col-md-4 mobile-no-padding">
            <a target="_blank" rel="nofollow" href="{{$ad['ad_url']}}">
              <?php $url =  parse_url($ad['ad_url']); ?>
              <span class="desktop-only">  {{$url['host']}} </span>
              <span class="mobile-only weight-normal">{{ truncate($url['host'],9,"..") }}</span>
            </a>
          </div>
        </div>
        @endforeach

      </div>
    </div>  
  </div>
  <div class="col-md-3 text-right hidden-xs mb20 text-c">
    <ins data-revive-zoneid="43" data-revive-id="a0794a8fe4019a67c8d5ae37e624f916"></ins>
  </div>
</div>

<div class="overlay">
  <div class="overlay-dialog">
    <div class="row">
      <div class="col-md-12 rating-title" id="overaly_title">Your overall rating</div>
      <div class="col-md-12 text-center modal-rating">
      <span class="starRating"> 
      <input class="modal_rating" data-id="{{$formatedNumber}}" data-phone="{{$number}}" id="modal_rating5_{{$formatedNumber}}" type="radio" name="rating_{{$formatedNumber}}" value="5" >
      <label for="modal_rating5_{{$formatedNumber}}">5</label>
      <input class="modal_rating" data-id="{{$formatedNumber}}" data-phone="{{$number}}" id="modal_rating4_{{$formatedNumber}}" type="radio" name="rating_{{$formatedNumber}}" value="4" >
      <label for="modal_rating4_{{$formatedNumber}}">4</label>
      <input class="modal_rating" data-id="{{$formatedNumber}}" data-phone="{{$number}}" id="modal_rating3_{{$formatedNumber}}" type="radio" name="rating_{{$formatedNumber}}" value="3" >
      <label for="modal_rating3_{{$formatedNumber}}">3</label>
      <input class="modal_rating" data-id="{{$formatedNumber}}" data-phone="{{$number}}" id="modal_rating2_{{$formatedNumber}}" type="radio" name="rating_{{$formatedNumber}}" value="2" >
      <label for="modal_rating2_{{$formatedNumber}}">2</label>
      <input class="modal_rating" data-id="{{$formatedNumber}}" data-phone="{{$number}}" id="modal_rating1_{{$formatedNumber}}" type="radio" name="rating_{{$formatedNumber}}" value="1" >
      <label for="modal_rating1_{{$formatedNumber}}">1</label>
      </span>
    </div> 
    <div class="col-md-12 text-center no-thanks">
      <a href="#" class="modal-close" id="no_thanks">Close</a>
    </div>
  </div>
</div>
</div>
</div>

@include('global.overlay')
@endsection