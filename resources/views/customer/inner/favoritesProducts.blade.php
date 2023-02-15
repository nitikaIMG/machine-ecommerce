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
                                    <div class="yello-strip">{{ $item['title'] }}</div>
                                        <div class="row address-flex mb-4">
                                            <div class="col-md-4">
                                                <div class="electrical-item2 electrical-item2-favrt">
                                                    <a href="">
                                                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="img-fluid">
                                                    </a>
                                                    <a id="favourite_product{{ $item['id']}}" onclick="favourite_product({{ $item['id'] }})" > 
                                                        <span class="heart-icon">
                                                    <i class="fa fa-heart"></i>
                                                    </span>
                                                    </a>
                                                   

                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                                        <div class="electrical-item-content">
                                                            <div class="electrical-item-title m-0">

                                                                {{ $item['title'] }}


                                                            </div>
                                                            <div class="electrical-item-subtitle">
                                                                <div class="map-wrapper">
                                                                    <img src="{{ $item['image'] }}" 
                                                                        class="img-fluid" width="20px">
                                                                </div>


                                                                <div class="location-wrapper-txt">
                                                                   
                                                                    <span class="location-txt">

                                                                        {{ $item['short_description'] }}

                                                                    </span>
                                                                </div>

                                                            </div>

                                                            <div class="clockbox">
                                                                <div class="clock-wrapper">
                                                                    <img src="{{ asset('public/web/images/electrical/clock.png') }}"
                                                                         class="img-fluid" width="16px">
                                                                </div>
                                                                <div class="green-txt clock-txt-green-color" style="">
                                                                price :

                                                                    {{ $item['currency'] }}

                                                                    {{ $item['price'] }}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>Please Add Favourites Product</p>
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
   function favourite_product(id) {
                     $.ajax({
                        url: "{{ url('add-to-favorite-product') }}" + '/' + id,
                        headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                           if(data['data']['is_favourite']){
                                 $("#favourite_product"+ '' + id).html('<span class="heart-icon"><i class="fa fa-heart"></i></span>');
                                 
                           }else{
                              $("#favourite_product"+ '' + id).html('<span class="grey-heart-icon"><i class="fa fa-heart"></i></span>');
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
