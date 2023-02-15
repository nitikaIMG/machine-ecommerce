@extends('customer.layouts.main')

@push('custom_css')
@endpush
@section('content')
    <section class="main-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('customer.inner.leftmenu')
                </div>
                <div class="col-md-12 col-lg-9">
                    <section class="center-wraper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p-4" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="title pb-3">Favourites</div>
                                            </div>
                                        </div>
                                    </div>
                                    @forelse($favouriteShops as $item)
                                        <div class="yello-strip">{{ $item['categories_shop'][0]['title'] }}</div>
                                        <div class="row address-flex mb-4">
                                            <div class="col-md-4">
                                                <div class="electrical-item2 electrical-item2-favrt">
                                                    <a href="{{ route('shopdetails',['id'=>$item['id'] ]) }}">
                                                        <img src="{{ $item['shop_logo'] }}" alt="{{ $item['categories_shop'][0]['title'] }}" class="img-fluid">
                                                    </a>
                                                    <a 
                                                    id="favourite_shop{{ $item['id']}}" onclick="favourite_shop({{ $item['id'] }})">
                                                    <span class="heart-icon">
                                                        <i class="fa fa-heart"></i>
                                                    </span>
                                                    </a>
                                                    <span class="offer-box">{{ $item['offer'] }}</span>

                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                                        <div class="electrical-item-content">
                                                            <div class="electrical-item-title m-0">

                                                                {{ $item['shop_name'] }}


                                                            </div>
                                                            <div class="electrical-item-subtitle">
                                                                <div class="map-wrapper">
                                                                    <img src="{{ asset('public/web/images/electrical/clock.png') }}" alt="{{ $item['shop_name'] }}"
                                                                        class="img-fluid" width="20px">
                                                                </div>


                                                                <div class="location-wrapper-txt">
                                                                    <span class="green-txt">3.5 Kms</span> |
                                                                    <span class="location-txt">

                                                                        {{ $item['address'] }}

                                                                    </span>
                                                                </div>

                                                            </div>

                                                            <div class="clockbox">
                                                                <div class="clock-wrapper">
                                                                    <img src="{{ asset('public/web/images/electrical/clock.png') }}"
                                                                        alt="{{ $item['shop_name'] }}" class="img-fluid" width="16px">
                                                                </div>
                                                                <div class="green-txt clock-txt-green-color" style="">
                                                                    You can order : <br>
                                                                    From

                                                                    {{ explode('-', $item['working_hours'])[0] }}

                                                                    <br>
                                                                    TO:

                                                                    {{ explode('-', $item['working_hours'])[1] }}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="rating-export-wrapper">
                                                            <span class="rating-box2"><span
                                                                    class="fa fa-star checked"></span>{{ $item['rating'] }}</span>
                                                            <span>

                                                               <a href="{{ route('shopdetails',['id'=>$item['id'] ]) }}">
                                                                <img src="{{ asset('public/web/images/electrical/export.png') }}"
                                                                    alt="" class="exportimg" width="24px">
                                                           	 </a>            
	                                                   </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    <p>Please Add Favourites Shop</p>
                                    @endforelse





                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('custom_js')
<script>
   function favourite_shop(id) {
                     $.ajax({
                        url: "{{ url('add-to-favorite-shop') }}" + '/' + id,
                        headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                           if(data['data']['is_favourite']){
                                 $("#favourite_shop"+ '' + id).html('<span class="heart-icon"><i class="fa fa-heart"></i></span>');
                                 
                           }else{
                              $("#favourite_shop"+ '' + id).html('<span class="grey-heart-icon"><i class="fa fa-heart"></i></span>');
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
               
            
   };
</script>
@endpush
