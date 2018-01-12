@extends('front.layout')
@section('title', $title)
@section('content')
<div class="details"> 
  <h2 class="search_title">{{$ad['formatted_phone2']}}</h2>
  <p class="breadcrumbs">
    <a href="/" class=""><i class="fa fa-home" aria-hidden="true"></i></a> 
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    <a class="go-back-link" id="go-back" href="/{{$ad['city']['data']['uri']}}/">{{$ad['city']['data']['name']}}</a>
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    {{$ad['phone_number']}}
  </p>


  <div class="row mb50">
    <div class="col-sm-12 col-md-9">
      <h3 class="summery-title col-r-heading">Summary Information</h3>
      <div class="summery-details w100p">
        <div class="row-c2">
            <div class="row-c2-col-l">
              <i class="fa fa-clock-o"></i>
            </div>
            <div class="row-c2-col-c">
              Updated: 
            </div>
            <div class="row-c2-col-r">
              {{ date('F jS, g:i a', strtotime($ad['updated_at'])) }} - {{$ad['updated_for_humans']}}
            </div>
          </div>
        <div class="row-c2">
          <div class="row-c2-col-l">
            <i class="fa fs-icon">#</i>
          </div>
          <div class="row-c2-col-c">
            Ads#:
          </div>
          <div class="row-c2-col-r">
            {{$ad['ads_count']}}
          </div>
        </div>
        <div class="row-c2">
          <div class="row-c2-col-l">
            <i class="fa fa-map-marker"></i>
          </div>
          <div class="row-c2-col-c">
            Cities: 
          </div>
          <div class="row-c2-col-r">
            <a href="{{$ad['city']['data']['uri']}}">{{$ad['city']['data']['name']}}</a>
          </div>
        </div>
        <div class="row-c2">
          <div class="row-c2-col-l">
            <i class="fa fa-calendar"></i>
          </div>
          <div class="row-c2-col-c">
            First seen: 
          </div>
          <div class="row-c2-col-r">
            <?php echo date('F j, Y', strtotime($ad['updated_at'])); ?>
          </div>
        </div>
        <div class="row-c2">
          <div class="row-c2-col-l">
            <i class="fa fa-tag"></i>
          </div>
          <div class="row-c2-col-c">
            Tags: 
          </div>
          <div class="row-c2-col-r">
            {{collect($ad['tags'])->implode('title', ', ')}}
          </div>
        </div>
        <div class="row-c2">
          <div class="row-c2-col-l">
            <i class="fa fa-dribbble"></i>
          </div>
          <div class="row-c2-col-c">
            Website: 
          </div>
          <div class="row-c2-col-r wb">
            <?php $url =  parse_url($ad['ad_url']); ?>
            {{$url['host']}} 
          </div>
        </div>
        @foreach($reviews as $review)
          @if($review['type'] == 'star-rating')
          <div class="row-c2 pb0">
            <div class="row-c2-col-l">
              <i class="fa fa-thumbs-up"></i>
            </div>
            <div class="row-c2-col-c r-c2">
              {{ $review['label'] }} 
            </div>
            <?php 
              $rate = 0;
              $votes = 0;
              if(isset($ratings[$ad['phone_number']])) {
                $phoneRatings = $ratings[$ad['phone_number']];
                
                if(isset($phoneRatings[$review['id']])) {
                  foreach($phoneRatings[$review['id']] as $phoneRating) {
                    $votes += $phoneRating['votes'];
                    $rate  += $phoneRating['rate']*$phoneRating['votes'];
                  }
                }
                if ($votes > 0) {
                    $rate = ceil($rate/$votes);
                }
              }
            ?>
            <div class="row-c2-col-r">
              <span class="starRating"> 
                <input type="radio" @if($rate == 5) {{'checked'}}  @endif class="rating" data-gid="{{$gid}}" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" id="rating5_{{$ad['phone_number']}}_{{$review['id']}}" name="rating_{{$ad['phone_number']}}_{{$review['id']}}" value="5" >
                <label for="rating5_{{$ad['phone_number']}}_{{$review['id']}}">5</label>
                <input type="radio" @if($rate == 4) {{'checked'}}  @endif class="rating" data-gid="{{$gid}}" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" id="rating4_{{$ad['phone_number']}}_{{$review['id']}}" type="radio" name="rating_{{$ad['phone_number']}}_{{$review['id']}}" value="4" >
                <label for="rating4_{{$ad['phone_number']}}_{{$review['id']}}">4</label>
                <input type="radio" @if($rate == 3) {{'checked'}}  @endif class="rating" data-gid="{{$gid}}" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" id="rating3_{{$ad['phone_number']}}_{{$review['id']}}" type="radio" name="rating_{{$ad['phone_number']}}_{{$review['id']}}" value="3" >
                <label for="rating3_{{$ad['phone_number']}}_{{$review['id']}}">3</label>
                <input type="radio" @if($rate == 2) {{'checked'}}  @endif class="rating" data-gid="{{$gid}}" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" id="rating2_{{$ad['phone_number']}}_{{$review['id']}}" type="radio" name="rating_{{$ad['phone_number']}}_{{$review['id']}}" value="2" >
                <label for="rating2_{{$ad['phone_number']}}_{{$review['id']}}">2</label>
                <input type="radio" @if($rate == 1) {{'checked'}}  @endif class="rating" data-gid="{{$gid}}" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" id="rating1_{{$ad['phone_number']}}_{{$review['id']}}" type="radio" name="rating_{{$ad['phone_number']}}_{{$review['id']}}" value="1" >
                <label for="rating1_{{$ad['phone_number']}}_{{$review['id']}}">1</label>
              </span>
              <span class="avg-rate" id="avg_rating_{{$ad['phone_number']}}_{{$review['id']}}">&nbsp{{$votes}}&nbsp</span>
            </div>
          </div>

           <div class="row-c2 pb0 s767">
            <div class="row-c2-col-r">
              <div class="rate">
              <a href="/{{$city}}/{{$ad['phone_number']}}/history" class="rate-btn">
                  <span class="mv">Tap for History</span>
              </a>
            </div>
            </div>
          </div>  

          @else
          <?php $options = explode(',', $review['options']);?>
          <div class="row-c2 mt5">
            <div class="row-c2-col-l h767 vat">
              <i class="fa fa-dribbble"></i>
            </div>
            <div class="row-c2-col-c h767 vat">
              {{ $review['label'] }} : 
            </div>
            <div class="row-c2-col-r wb">
              <div class="select-area prelative">
                <!-- <div class="wrapper-input">Comment ad!</div>
                <select data-placeholder="Comment ad!" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" data-gid="{{$gid}}" class="comments-ads-area" tabindex="11">
                  @foreach($options as $key=>$option)
                  <option value="{{$key}}">{{ucwords($option)}}</option>
                  @endforeach
                </select> -->
              </div>


             <div class="dropdown">
              <div id="dLabel" class="comments-ads-area clearfix">
                <span class="span-comment-text">Comment ad!</span>
              </div>
              <ul class="hide-dd dropdown-menu comments-list" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" data-gid="{{$gid}}">
                @foreach($options as $key=>$option)
                  <li><a class="dropdown-item tag-{{$key}} " href="#" value="{{$key}}">{{ucwords($option)}}</a></li>
                @endforeach                
              </ul>
            </div> 

              <div class="tags-rate">
                <ul>
                  <?php 
                    if(isset($ratings[$ad['phone_number']])) {
                      $phoneRatings = $ratings[$ad['phone_number']];
                      if(isset($phoneRatings[$review['id']])) {
                        foreach($phoneRatings[$review['id']] as $phoneRating) {
                  ?>
                        <li class="nearest-city-link">{{ucwords($options[intval($phoneRating['rate'])])}} {{$phoneRating['votes']}}x</li>
                  <?php
                        }
                      }
                      if ($votes > 0) {
                          $rate = ceil($rate/$votes);
                      }
                    }
                  ?>
                  
                </ul>
              </div>  
            </div>
          </div>
          @endif
        @endforeach
      </div>
      <div class="rate h767">
        <a href="/{{$city}}/{{$ad['phone_number']}}/history" class="rate-btn">
          <span class="dv">Full History</span>
          <span class="mv">Tap for History</span>
        </a>
      </div>

      @if(count($images) > 0)
      <div class="thumbs-wrap">
        <input type="hidden" value="/{{$city}}/{{$ad['phone_number']}}/images" id="large-img-url">
        <div class="row no-gutters">
            @foreach($images as $key=>$image)
              <div class="res-image2">
                <a  href="/{{$city}}/{{$ad['phone_number']}}/images" data-id="image-{{$key}}" class="res-image sm-img"><img class="full-width" src="{{$image['path']}}"></a>
              </div>
            @endforeach  
        </div>
      </div>
      @endif  
      <h3 class="summery-title related-heading col-r-heading"><span class="black">Related</span> Profiles</h3>
      <div class="thumbs-wrap">
        <div class="row no-gutters">
          @foreach($relatedNumbers as $number)
            @if(isset($relatedImages[$number]))
            <div class="res-image2">
              <a href="/{{$city}}/{{$number}}">
                <div class="res-image">
                  <img class="full-width" src="{{$relatedImages[$number]['path']}}"/>
                </div>  
                <p class="call-num">{{ '('.substr($number, 0, 3).') '.substr($number, 3, 3).'-'.substr($number,6) }}</p>
              </a>
            </div>
            @endif
          @endforeach          
        </div>
      </div>

    </div>
    <div class="col-md-3 text-right hidden-xs mb20 text-c">
      <ins data-revive-zoneid="43" data-revive-id="a0794a8fe4019a67c8d5ae37e624f916"></ins>
    </div>
  
  </div>
</div>
@include('global.overlay')
@endsection

