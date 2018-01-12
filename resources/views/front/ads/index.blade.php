@extends('front.layout')
@section('title', isset($title) ? $title : '')
@section('content')

@if(isset($searchNumber))
  @section('searchNumber', $searchNumber)
  <h2 class="search_title">Results for <span class="city_name">{{$searchNumber}}</span></h2>
@else
  <h2 class="search_title">Ads in <span class="city_name">{{$cityName}}</span></h2>
@endif
      
     
  <p class="breadcrumbs">
    <a href="/" class=""><i class="fa fa-home" aria-hidden="true"></i></a> 
    <i class="fa fa-angle-right" aria-hidden="true"></i> 
    {{$cityName}}
  </p>
  <div class="text-center rmb20">
      <div class="col">
        @foreach($nearestCities as $nearestCity)
          <a href="{{$nearestCity['uri']}}" class="nearest-city-link">{{$nearestCity['name']}}</a>
        @endforeach
      </div>
  </div>
  
  <div class="row">
    <div class="col-sm-12 col-md-9">
      <?php $date = null;?>
      @if($empty)
      @if($ads->count() > 0)
        <?php $a = 0;?>
        @foreach($ads as $ad)
            @if ($date != date_format(date_create($ad['datetime']), 'l, F j'))
              <?php $date = date_format(date_create($ad['datetime']), 'l, F j');?>
              <div class="row"> 
                <div class="ml20"><span>{{ $date }}</span> </div>
              </div>
            @endif
            <?php $a++;?>
            @if(3 == $a)
            <div class="row">
              <div class="col-md-12 pub-entry">
                <ins data-revive-zoneid="38" data-revive-id="a0794a8fe4019a67c8d5ae37e624f916"></ins>
              </div>
            </div>
            @endif 
            @if(7 == $a)
            <div class="row">
              <div class="col-md-12 pub-entry">
                <ins data-revive-zoneid="40" data-revive-id="a0794a8fe4019a67c8d5ae37e624f916"></ins>
              </div>
            </div>
            @endif 
            @if(13 == $a)
            <div class="row">
              <div class="col-md-12 pub-entry">
                <ins data-revive-zoneid="42" data-revive-id="a0794a8fe4019a67c8d5ae37e624f916"></ins>
              </div>
            </div>
            @endif 
            <div class="row-c-up">
              <!-- <div class="col-r-heading res768"><a href="/{{$ad['city']['data']['uri']}}/{{$ad['phone_number']}}">{{$ad['formatted_phone2']}}</a></div>  -->
              <div class="col-l">
                  @if(isset($images[$ad['phone_number']]))
                      <a href="/{{$ad['city']['data']['uri']}}/{{$ad['phone_number']}}">
                        <div class="res-image">
                          <img class="full-width"  src="{{$images[$ad['phone_number']]['path']}}"/>
                        </div>
                      </a>
                  @else
                    <a href="/{{$ad['city']['data']['uri']}}/{{$ad['phone_number']}}">
                        <div class="res-image">
                        <img class="full-width" src="{{asset('images/reviews.jpg')}}"/>
                      </div>
                    </a>
                  @endif
                <a href="/{{$ad['city']['data']['uri']}}/{{$ad['phone_number']}}" class="details-btn res990 set768">Tap for Details</a>
              </div>
              <div class="col-r">
                <h3 class="col-r-heading ">
                  <a href="/{{$ad['city']['data']['uri']}}/{{$ad['phone_number']}}">{{$ad['formatted_phone2']}}</a>  
                </h3>
                <div class="row-c2">
                  <div class="row-c2-col-l">
                    <i class="fa fs-icon">#</i>
                  </div>
                  <div class="row-c2-col-c r-c2">
                    <span class="h768">No. of ads:</span>
                    <span class="s768">Ads:</span>
                  </div>
                  <div class="row-c2-col-r">
                    {{$ad['ads_count']}}
                  </div>
                </div>
                <div class="row-c2">
                  <div class="row-c2-col-l">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <div class="row-c2-col-c r-c2">
                    Cities: 
                  </div>
                  <div class="row-c2-col-r">
                    <a href="{{$ad['city']['data']['uri']}}">{{$ad['city']['data']['name']}}</a>
                  </div>
                </div>
                
                <div class="row-c2">
                  <div class="row-c2-col-l">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <div class="row-c2-col-c r-c2">
                    Updated: 
                  </div>
                  <div class="row-c2-col-r">
                    <span class="h500"><?php echo date('F jS, g:i a', strtotime($ad['updated_at'])); ?> - {{$ad['updated_for_humans']}}</span>
                    <span class="s500"> <?php echo date('M d, g:i a', strtotime($ad['updated_at'])); ?> </span>
                    
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
                
                @endif
                @endforeach
              </div>
              <div class="col-rm">
                <a href="/{{$ad['city']['data']['uri']}}/{{$ad['phone_number']}}" class="details-btn pl30 pr30">Complete Details</a>
              </div>
            </div>
            <div class="row-c-down">
               <div class="col-l h767"></div>
               <div class="col-r">

                @foreach($reviews as $review)
                @if($review['type'] !== 'star-rating')
                
                <?php $options = explode(',', $review['options']);?>
                <div class="row-c2">
                  <div class="row-c2-col-l h767">
                    <i class="fa fa-dribbble"></i>
                  </div>
                  <div class="row-c2-col-c h767 ">
                    {{ $review['label'] }} : 
                  </div>
                  <div class="row-c2-col-r wb">
                    <!-- <div class="select-area">
                      <select data-placeholder="Comment ad!" data-phone="{{$ad['phone_number']}}" data-review="{{$review['id']}}" data-gid="{{$gid}}" multiple class="comments-ads" tabindex="11">
                        @foreach($options as $key=>$option)
                        <option value="{{$key}}">{{ucwords($option)}}</option>
                        @endforeach
                      </select>
                    </div> -->
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
               <div class="col-rm col-rm-down h767"></div>
            </div>
          @endforeach
        @else
          <h4>No results found</h4>
        @endif  
        <div class="text-center">
          <nav >
            {{ $ads->links('pagination.default') }}
          </nav>
        </div>
      @else
        <div class="row-c">
          <h3> {{$message}}</h3>
        </div>          
      @endif

    </div>
    <div class="col-md-3 text-right hidden-xs mb20 text-c">
        <ins data-revive-zoneid="43" data-revive-id="a0794a8fe4019a67c8d5ae37e624f916"></ins>
    </div>
  </div>
  @include('global.tile-ads')
  @include('global.overlay')
@endsection