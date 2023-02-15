@extends('customer.layouts.main')

@push('custom_css')
@endpush

@section('content')
<section class="tabs-wrapper">
    <div class="container">
        <h1 class="main-title-tabs">Products by Category</h1>
        <!-- Nav pills -->
        <ul class="nav nav-pills nav-pill-custom" role="tablist">
            @php $i =0; @endphp
            @forelse ($categories['data'] as $cat)
            @php $i++; @endphp
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $i==1?'active':''}}" data-bs-toggle="pill" href="#{{ $cat['title'] }}" aria-selected="true"
                        role="tab">{{ $cat['title'] }}</a>
                </li>
            @empty
            @php $i++; @endphp
            @endforelse

        </ul>

        <!-- Tab panes -->
        <div class="tab-content tab-content-custom">
            @php $i =0; @endphp
            @forelse ($categories['data'] as $cat)
                @php $i++; @endphp
                <div id="{{ $cat['title'] }}" class="container tab-pane fade {{ $i==1?'active show':''}}" role="tabpanel"><br>
                    @php
                        $result = App\Traits\APICall::callAPI(
                            'POST',
                            App\Http\Controllers\Web\EndPoints::SHOP_BYCATEGORIES,
                            json_encode([
                                'category' => $cat['id'],
                            ]),
                        );
                        $shopbycat = json_decode($result, true);
                    @endphp
                    <div class="row">
                        @forelse ($shopbycat['data'] as $shop)
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="electrical-box-wrapper">
                                    <div class="electrical-item">
                                        <a href="">
                                            <img src="{{ $shop['shop_logo']}}"
                                                alt="item-1" class="img-fluid">
                                        </a>
                                        <span class="heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                        <span class="offer-box">{{ $shop['offer'] }}</span>
                                        <span class="rating-box"><span class="fa fa-star checked"></span>{{ $shop['rating'] }}</span>
                                    </div>
                                    <div class="electrical-item-content">
                                        <div class="electrical-item-title">
                                            <a href="electrical-details.html">{{ $shop['shop_name'] }}</a>
                                            <span>
                                                <a href="electrical-details.html">
                                                    <img src="{{ asset('web/images/electrical/export.png') }}"
                                                        alt=""></a>
                                            </span>
                                        </div>
                                        <div class="electrical-item-subtitle">
                                            <div class="map-wrapper">
                                                <img src="{{ asset('web/images/electrical/pin.png') }}" alt="map"
                                                    class="img-fluid" width="20px">

                                            </div>
                                            <div class="location-wrapper-txt">
                                                <span class="green-txt">{{ $shop['distance'].' '.$shop['distance_unit']}}</span> |
                                                <span class="location-txt">
                                                   {{ $shop['address']}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="clockbox">
                                            <div class="clock-wrapper">
                                                <img src="{{ asset('web/images/electrical/clock.png') }}" alt="map"
                                                    class="img-fluid" width="16px">
                                            </div>
                                            <div class="clock-wrapper-txt">
                                                Working Hours: {{ $shop['working_hours'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h4>No Shop </h4>
                        @endforelse
                    </div>
                </div>
            @empty
                @php $i++; @endphp
            @endforelse
        </div>
    </div>
</section>
@endsection