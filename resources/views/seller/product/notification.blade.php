@extends('seller.layouts.vendor')
@section('title', 'Request For Quote')
@section('pageheading')
{{__('Request For Quote')}}
@endsection
@section('content')
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
                                            foreach (getSellerNotificationUserData() as $key => $value) {
                                           
                                            
                                             ?>
                                                <div class="notification-block-repeat">
                                                <figure>
                                                    <img src="" alt="">
                                                </figure>
                                                <div class="content">
                                                    <div class="name"> {{ $value['title'] }} </div>
                                                    <div class="name"> {{ $value['body'] }} </div>
                                                    <div class="time">{{ \Carbon\Carbon::parse($value['created_at'])->diffForHumans() }}</div>
                                                    
                                                </div>
                                            </div>  
                                            <?php 
                                            }
                                            ?>            
                                        </div>
                                    </div>
                                </div>
   </div>
</section>
@endsection