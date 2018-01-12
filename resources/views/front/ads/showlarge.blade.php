@extends('front.layout')
@section('title', $title)
@section('content')
<div class="details"> 
  <h2 class="search_title">{{$ad['formatted_phone2']}}</h2>
  <p class="breadcrumbs">
    <a href="/" class=""><i class="fa fa-home" aria-hidden="true"></i></a> 
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    <a class="go-back-link" id="go-back" href="/{{$city}}/">{{$city}}></a>
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    <a class="go-back-link" id="go-back" href="/{{$city}}/{{$ad['phone_number']}}/">{{$ad['phone_number']}}</a>
    <i class="fa fa-angle-right" aria-hidden="true"></i>
    Images
  </p>


  <div class="row mb50">
    <div class="col-sm-12 col-md-9">
      <div class="summery-details">
      <h3 class="summery-title col-r-heading">Images for {{$ad['formatted_phone2']}}</h3>
      </div>
      <div class="rate">
        <a href="#" id="rate_button" class="rate-btn">
          <span>Tap for Rate</span>
        </a>
      </div>

      @if(count($images) > 0)
      <div class="thumbs-wrap">
        <input type="hidden" value="/{{$city}}/{{$ad['phone_number']}}/images" id="large-img-url">
        <div class="row no-gutters">
            @foreach($images as $key=>$image)
              <div class="large-image">
                <a  href="/{{$city}}/{{$ad['phone_number']}}"><img class="border responsive" src="{{$image['path']}}"></a>
              </div>
            @endforeach  
        </div>
        <div class="row">
          <div class="col-md-12">
            <a class="go-back-link" id="go-back" href="/{{$city}}/{{$ad['phone_number']}}/">Go Back to {{$ad['formatted_phone2']}}'s Summary Information
            </a>
          </div>
        </div>
      </div>
      @endif  
     

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
          <input class="modal_rating" data-id="{{$ad['formatted_phone']}}" data-phone="{{$ad['phone_number']}}" id="modal_rating5_{{$ad['formatted_phone']}}" type="radio" name="rating_{{$ad['formatted_phone']}}" value="5" >
          <label for="modal_rating5_{{$ad['formatted_phone']}}">5</label>
          <input class="modal_rating" data-id="{{$ad['formatted_phone']}}" data-phone="{{$ad['phone_number']}}" id="modal_rating4_{{$ad['formatted_phone']}}" type="radio" name="rating_{{$ad['formatted_phone']}}" value="4" >
          <label for="modal_rating4_{{$ad['formatted_phone']}}">4</label>
          <input class="modal_rating" data-id="{{$ad['formatted_phone']}}" data-phone="{{$ad['phone_number']}}" id="modal_rating3_{{$ad['formatted_phone']}}" type="radio" name="rating_{{$ad['formatted_phone']}}" value="3" >
          <label for="modal_rating3_{{$ad['formatted_phone']}}">3</label>
          <input class="modal_rating" data-id="{{$ad['formatted_phone']}}" data-phone="{{$ad['phone_number']}}" id="modal_rating2_{{$ad['formatted_phone']}}" type="radio" name="rating_{{$ad['formatted_phone']}}" value="2" >
          <label for="modal_rating2_{{$ad['formatted_phone']}}">2</label>
          <input class="modal_rating" data-id="{{$ad['formatted_phone']}}" data-phone="{{$ad['phone_number']}}" id="modal_rating1_{{$ad['formatted_phone']}}" type="radio" name="rating_{{$ad['formatted_phone']}}" value="1" >
          <label for="modal_rating1_{{$ad['formatted_phone']}}">1</label>
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

