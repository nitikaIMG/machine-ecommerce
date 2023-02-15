@extends('customer.layouts.main')
{{-- @dd($orderListing) --}}
@push('custom_css')
@endpush

@section('content')

<!-- Main Section -->
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
                                <div class="card p30" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="title">Notification</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php 
                                           
                                           foreach (getUserNotificationSellerData() as $key => $value) {
                                            ?>
                                            <div class="notification-block-repeat">
                                                <figure>
                                                    <img src="" alt="">
                                                </figure>
                                                <div class="content">
                                                    <div class="name">{{ $value['title'] }} </div>
                                                    <div class="name">{{ $value['body'] }}</div>
                                                    <div class="time">{{ \Carbon\Carbon::parse($value['created_at'])->diffForHumans() }}</div>
                                                    <div class="circle "></div>
                                                </div>
                                            </div>
                                           <?php 
                                           }
                                           ?>       
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

@endsection