@extends('front.layout')
@section('title', $title)
@section('content')
  <section class="listing">    
    @foreach($countries['data'] as $country)   <!-- Countries Loop -->
      <?php  //insert country state and cities into array
        $key = 0;  
        $items = array(); 
        foreach($country['provinces']['data'] as $province){

          $items[$key]['type'] = "state"; 
          $items[$key]['state'] = $province['name']; 
          $items[$key]['uri'] = $province['uri']; 
          $key++;
          foreach ($province['cities']['data'] as $city) {
            $items[$key]['type'] = "city"; 
            $items[$key]['city'] = $city['name']; 
            $items[$key]['uri'] = $city['uri']; 
            $key++;
          }
        }
        //count total items in specific country and then divide into 6 columns
        $count = count($items); 
        $roundedCount = ceil($count / 6) * 6;
        if ($roundedCount < 6) {
          $roundedCount = 6;
        }
      $i = 0; 
      ?>
      <h2 class="title text-center"><span>{{$country['name']}}</span></h2>
      <div class="content">
        <div class="row">
          @for($j = 0; $j < 6; ++$j)
            <div class="col-md-2 col-sm-4 col-6">
              @for(; $i < min($count, ceil($roundedCount * ($j + 1) / 6)) ; ++$i)
                @if($items[$i]["type"] == "state")
                  <strong>{{$items[$i]['state']}}</strong>
                @endif
                @if($items[$i]["type"] == "city")
                  <span>
                    <a href="{{$items[$i]['uri']}}">{{$items[$i]['city']}}</a>
                  </span>
                @endif  
              @endfor  
            </div>
          @endfor
        </div>
      </div>      
    @endforeach
  </section>
@endsection