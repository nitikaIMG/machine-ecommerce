@extends('customer.layouts.main')

@push('custom_css')
@endpush

@section('content')
<style>
    .rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.no-image:after{
    width: auto;
    height: auto
}
</style>
    <section class="container">
        <div class="electrical-details-wrapper">
            @if(!str_contains($shopdetails['shop']['shop_logo'],'via.placeholder'))
                <div class="detail-banner-page">
                    <img src="{{ $shopdetails['shop']['shop_logo'] }}" alt="electrical-detail-banner" class="img-fluid">
                    <a href="#" id="favourite_shop"> 
                        <span class="{{ ($shopdetails['shop']['added_to_favourite']==true)?'heart-icon':'grey-heart-icon' }}">
                            <i class="fa fa-heart"></i>
                        </span>
                    </a>
                    <span class="offer-box" style="display:none;">{{ $shopdetails['shop']['offer'] }}</span>
                </div>
            @else
            <div class="detail-banner-page no-image">
                <a href="#" id="favourite_shop"> 
                    <span class="{{ ($shopdetails['shop']['added_to_favourite']==true)?'heart-icon':'grey-heart-icon' }}">
                        <i class="fa fa-heart"></i>
                    </span>
                </a>
                <span class="offer-box" style="display:none;">{{ $shopdetails['shop']['offer'] }}</span>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="electrical-item-content">
                        <div class="electrical-item-title">
                            {{ $shopdetails['shop']['shop_name'] }}

                        </div>
                        <div class="electrical-item-subtitle">
                            <div class="map-wrapper">
                                <img src="{{ asset('public/web/images/electrical/pin.png') }}" alt="map"
                                    class="img-fluid" width="20px">

                            </div>
                            <div class="location-wrapper-txt">
                                <span class="green-txt">
					@php 
                                                    $lat1 = Session::get('lat');
                                                    $long1 = Session::get('long');
                                                    $lat2 = $shopdetails['shop']['latitude'];
                                                    $long2 = $shopdetails['shop']['longitude'];
                                                    $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL&key=AIzaSyDMLeWZW0BxtJfflLb2a8Qj1VVUJaaP5jI");
                                                    $response_a = json_decode($response, true);
                                                   
                                                    @endphp   
                                                    
                                                    {{ isset($response_a['rows'][0]['elements'][0]['distance']['text']) ? $response_a['rows'][0]['elements'][0]['distance']['text'] : '' }} </span> |
                                <span class="location-txt">
                                    {{ $shopdetails['shop']['address'] }}
                                </span>
                            </div>
                        </div>
                        <div class="clockbox">
                            <div class="clock-wrapper">
                                <img src="{{ asset('public/web/images/electrical/clock.png') }}" alt="map"
                                    class="img-fluid" width="16px">
                            </div>
                            <div class="clock-wrapper-txt green-txt">
                                You can order for today {{ $shopdetails['shop']['working_hours'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="rating-export-wrapper">
                        <span class="rating-box"><span
                                class="fa fa-star checked"></span>{{ $shopdetails['ratings']['overall_average'] }}
			 </span>
		  @if(isset($lat2) && isset($long2) && isset($lat1) && isset($long1))
                       <span>
			<a href="http://maps.google.com/maps?saddr={{ $lat1 }},{{ $long1 }}&daddr={{ $lat2 }},{{$long2}}" target="_blank">
                            <img src="{{ asset('public/web/images/electrical/export.png') }}" alt=""
                                class="exportimg">
			</a>
                        </span>
		  @endif
                    </div>
                    <div class="details-share-btn">
                        <ul>
                            <li> <a href="tel:{{ $shopdetails['shop']['shop_contact'] }}" ><i class="fa fa-phone"></i></a> </li>                            <li>
                            <form action="{{ route('chat.channel.create') }}" method="POST" >
                              @csrf
                              <input type="hidden" name="users[]" value="{{ $shopdetails['shop']['seller_id'] }}" />
			      <input type="hidden" name="message" value="{{ $shopdetails['shop']['id'] }}" />
			       <input type="hidden" name="type" value="3" />
                              <button type="submit" class="btn btn-blank" style="width:100%"><i class="fa fa-commenting"></i></button>
                              </form>    
                            
                          
                            <li><a target="_blank" href="https://api.whatsapp.com/send?phone={{ $shopdetails['shop']['shop_contact'] }}&text=Hey {{ $shopdetails['shop']['shop_name'] }}"><i class="fa fa-whatsapp"></i></a></li>
                            
                            <li><i class="fa fa-share-alt"></i>
                             
                            <div class="showallsocial" style="width:150px;">
                            <a target="_blank" class="facebook-share nectar-sharing" href="https://www.facebook.com/sharer.php?u={{ route('shopdetails',['id'=>$shopdetails['shop']['id']]) }}" title="Share this">
                                <i class="fa fa-facebook"></i>
                               
                            </a>
                            <a target="_blank" class="twitter-share nectar-sharing" href="https://twitter.com/intent/tweet?text={{ $shopdetails['shop']['shop_name'] }}&url={{ route('shopdetails',['id'=>$shopdetails['shop']['id']]) }}" title="Tweet this">
                                <i class="fa fa-twitter"></i>
                               
                            </a>
                            <a target="_blank" class="linkedin-share nectar-sharing" href="https://api.whatsapp.com/send?text={{ route('shopdetails',['id'=>$shopdetails['shop']['id']]) }}" title="Share this">
                                <i class="fa fa-whatsapp"></i>
                               
                            </a>
                            <!-- <a target="_blank" class="pinterest-share nectar-sharing" href="#" title="Pin this">
                                <i class="fa fa-instagram"></i>
                              
                            </a> -->
                            </div>
                        
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-lg-12 col-md-12">
                    <ul class="nav nav-pills nav-pill-custom" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-captilaization active" data-bs-toggle="pill" href="#Categories"
                                aria-selected="true" role="tab">Categories</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-captilaization" data-bs-toggle="pill" href="#Overview"
                                aria-selected="false" role="tab" tabindex="-1">Overview</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-captilaization" data-bs-toggle="pill" href="#Services"
                                aria-selected="false" role="tab" tabindex="-1">Services</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-captilaization" data-bs-toggle="pill" href="#Rating"
                                aria-selected="false" role="tab" tabindex="-1">Rating</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-custom">
                        <div id="Categories" class="container tab-pane active" role="tabpanel"><br>
                            <div class="row-divider">
                                <div class="row">
                                    @forelse ($shopdetails['categories'] as $cate)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="product">
                                                @if(!str_contains($cate['cover_image'], 'via.placeholder'))
                                                    <figure>
                                                        <img src="{{ $cate['cover_image'] }}" alt=""
                                                            class="img-fluid">
                                                    </figure>
                                                @else
                                                    <figure>
                                                        <div class="no-image mb-0" style="width:100%;height:
                                                    100%;"></div>
                                                    </figure>
                                                @endif
                                                <div class="content-details">
                                                    <div class="electrical-item-title mb-0 mt-0"> {{ $cate['title'] }}
                                                    </div>
                                                    <div class="clock-wrapper-txt mb-2">
                                                        {{ substr($cate['short_description'], 0, 50);  }}</div>
                                                    <div class="text-underline">
                                                        <a href="{{ route('productlisting',['catid'=>$cate['id'],'shop_id'=>$shopdetails['shop']['id']]) }}" class="anchor-link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                    @empty
                                        <p>No Category Added</p>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                        <div id="Overview" class="container tab-pane fade" role="tabpanel"><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title-content-wrapeer mt-2">
                                        <div class="electrical-item-title">Overview</div>
                                        <div class="border custom-text p-3 borderradius-10px">
                                            {{ $shopdetails['overview'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title-content-wrapeer mt-2">
                                        <div class="electrical-item-title">Services</div>
                                        <div class="border custom-text p-3 borderradius-10px">
                                            <ul class="service-list">
                                                @foreach ($shopdetails['services'] as $services)
                                                    <li>
                                                        <img src="{{ asset('public/web/images/electrical/tick.png') }}"
                                                            alt="tick" class="img-fluid">
                                                        <span class="greytxt">{{ $services }}</span>
                                                    </li>
                                                @endforeach
                                                {{-- <li>
                                                    <img src="images/electrical/tick.png" alt="tick"
                                                        class="img-fluid">
                                                    <span class="greytxt">Cash Payment</span>
                                                </li>
                                                <li>
                                                    <img src="images/electrical/tick.png" alt="tick"
                                                        class="img-fluid">
                                                    <span class="greytxt">Takeaway Available</span>
                                                </li>
                                                <li>
                                                    <img src="images/electrical/tick.png" alt="tick"
                                                        class="img-fluid">
                                                    <span class="greytxt">Card Payment</span>
                                                </li> --}}

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div id="Services" class="container tab-pane fade" role="tabpanel"><br>
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title-content-wrapeer mt-2">
                                        <div class="electrical-item-title">Services</div>
                                        <div class="border custom-text p-3 borderradius-10px">
                                            <ul class="service-list">
                                                @foreach ($shopdetails['services'] as $services)
                                                    <li>
                                                        <img src="{{ asset('public/web/images/electrical/tick.png') }}"
                                                            alt="tick" class="img-fluid">
                                                        <span class="greytxt">{{ $services }}</span>
                                                    </li>
                                                @endforeach
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="Rating" class="container tab-pane fade" role="tabpanel"><br>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="title-content-wrapeer mt-2">
                                        <div class="electrical-item-title rate" style="float:left">Rating :    </div>
                                     
                                        <div class="rate" style="float:left">
                                      
                                        <label for="star5" style='@if($shopdetails["ratings"]["overall_average"]==5) color:#c59b08; @endif' title="text"></label>
                                        
                                        <label for="star4" style='@if($shopdetails["ratings"]["overall_average"]==4 || $shopdetails["ratings"]["overall_average"]>4) color:#c59b08; @endif' title="text"></label>
                                        
                                        <label for="star3" style='@if($shopdetails["ratings"]["overall_average"]==3 || $shopdetails["ratings"]["overall_average"]>3) color:#c59b08; @endif' title="text"></label>
                                    
                                        <label for="star2" style='@if($shopdetails["ratings"]["overall_average"]==2 || $shopdetails["ratings"]["overall_average"]>2) color:#c59b08; @endif' title="text"></label>

                                        <label for="star1" style='@if($shopdetails["ratings"]["overall_average"]==1 || $shopdetails["ratings"]["overall_average"]>1) color:#c59b08; @endif' title="text"></label>
                                        </div>
                                        
                                        </div>
                                       
                                    </div>
                                
                               
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="title-content-wrapeer mt-2">
                                        <div class="electrical-item-title"> {{ $shopdetails["ratings"]["total"] }}  Customer Reviews :</div>
                                        @forelse($shopdetails["shop_ratings"] as $rate)
                                       
                                        <div class="border custom-text p-3 mb-2 borderradius-10px">

                                        <div class="col-md-12">
                                            <p style="color:black">{{ $rate['review'] }}<p>
                                          <div class="title-content-wrapeer mt-2">
                                            <div class="electrical-item-title rate" style="float:left">  </div>
                                        
                                            <div class="rate" style="float:left">
                                        
                                            <label for="star5" style='@if($rate["rate"]==5) color:#c59b08; @endif' title="text"></label>
                                            
                                            <label for="star4" style='@if($rate["rate"]==4 || $rate["rate"]>4) color:#c59b08; @endif' title="text"></label>
                                            
                                            <label for="star3" style='@if($rate["rate"]==3 || $rate["rate"]>3) color:#c59b08; @endif' title="text"></label>
                                        
                                            <label for="star2" style='@if($rate["rate"]==2 || $rate["rate"]>2) color:#c59b08; @endif' title="text"></label>

                                             <label for="star1" style='@if($rate["rate"]==1 || $rate["rate"]>1) color:#c59b08; @endif' title="text"></label>
                                            </div>
                                        
                                            </div>
                                            </div>
                                        </div>
                                        @empty
                                        No Rating
                                        @endforelse
                                    
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('custom_js')
    <script>
        $('#favourite_shop').click(function() {
                        $.ajax({
                            url: "{{ route('add_to_favourite_shop',['id'=>$shopdetails['shop']['id']]) }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                if(data['data']['is_favourite']){
                                    $('#favourite_shop').html('<span class="heart-icon"><i class="fa fa-heart"></i></span>');
                                }else{
                                    $('#favourite_shop').html('<span class="grey-heart-icon"><i class="fa fa-heart"></i></span>');
                                }
                                
                                if(data.status == 1){
                                    swal(data.message, {
                                    icon: "success",
                                });
                                }else{
                                    swal(data.message, {
                                    icon: "warning",
                                });
                                }

                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                        });
                    
                
        });



      $("i.fa.fa-share-alt").click(function(){
         $(".showallsocial").fadeToggle();


      });






    </script>
@endpush