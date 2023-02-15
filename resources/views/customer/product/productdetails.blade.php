@extends('customer.layouts.main')
<style>
   .fa-plus:before {
    margin-left: 7px;
   }
</style>
@section('content')
<section class="container">
   <div class="add-to-cart-sec">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-12 col-sm-12">
               <div class="product-image">
                  <img src="{{$productdetails['image']}}" alt="product-image" class="img-fluid">
                  
                  <span class="grey-share-icon">
                  <i class="fa fa-share-alt" aria-hidden="true" style="margin-top: 6px;"></i>
                  </span>
                 
		  <div class="showallsocial" style="width:150px;">
                            <a target="_blank" class="facebook-share nectar-sharing" href="https://www.facebook.com/sharer.php?u={{route('productdetails',['product_id'=>$productdetails['id'],'catid'=>$catid,'shop_id'=>$shop_id])}}" title="Share this">
                                <i class="fa fa-facebook"></i>
                               
                            </a>
                            <a target="_blank" class="twitter-share nectar-sharing" href="https://twitter.com/intent/tweet?text={{ $productdetails['title'] }}&url={{route('productdetails',['product_id'=>$productdetails['id'],'catid'=>$catid,'shop_id'=>$shop_id])}}" title="Tweet this">
                                <i class="fa fa-twitter"></i>
                               
                            </a>
                            <a target="_blank" class="linkedin-share nectar-sharing" href="https://api.whatsapp.com/send?text={{route('productdetails',['product_id'=>$productdetails['id'],'catid'=>$catid,'shop_id'=>$shop_id])}}" title="Share this">
                                <i class="fa fa-whatsapp"></i>
                               
                            </a>
                            <!-- <a target="_blank" class="pinterest-share nectar-sharing" href="#" title="Pin this">
                                <i class="fa fa-instagram"></i>
                              
                            </a> -->
                            </div>

                  <a id="favourite_product{{ $productdetails['id']}}" onclick="favourite_product({{ $productdetails['id'] }})"> 
                     <span class="{{ ($productdetails['is_favourite']==true)?'heart-icon':'grey-heart-icon d-heart' }}">
                  <i class="fa fa-heart"></i>
                  </span>
                  </a>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
               <div class="products-details">
                  <div class="electrical-item-title">
                     {{$productdetails['title']}} <br>
                   <span class="fontweight400">  {{$productdetails['short_description']}}</span>
                  </div>
                  <div class="product-price-blue">
                     {{$productdetails['currency']}}
                     {{$productdetails['price']}}
                  </div>
                  <hr>
                  <div class="custom-text">
                     {{$productdetails['short_description']}}
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-lg-12">

                     <div class="row">
                        <div class="col-lg-6 col-md-6" >
                              <a  onclick="add_product({{ $productdetails['id']}},1)" id="add_to_cart" class="add-to-basket-btn
                                 custom-btn">
                              <span class="plus-black-bg">
                              <i class="fa fa-plus"></i>
                              </span> Add to Cart
                              </a>

                              <a href="{{ route('cart') }}" 
                              id="view_to_cart" style="display:none;" class="add-to-basket-btn
                                 custom-btn">
                              <span class="plus-black-bg">
                              <i class="fa fa-shopping-cart"></i>
                              </span>Go to Cart
                              </a>
                        </div>
                        <div class="col-lg-6 col-md-6">
                                 <!-- <button
                                    class="request-qoute-btn
                                    custom-btn">Request
                                 a Qoute
                                 </button> -->

                                

                                 @if(isset($productdetails['seller_id']))
                                    <form action="{{ route('chat.channel.create') }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="users[]" value="{{ $productdetails['seller_id'] }}" />
                                    <input type="hidden" name="message" value="{{ $productdetails['id'] }}" />
			       	                   <input type="hidden" name="type" value="2" />
                                    <button type="submit" class="chat-btn custom-btn" style="width:100%"><img src="{{ asset('web/images/chat.png') }}" alt="">{{__('Chat') }}</button>
                                    </form>
                                 @endif
                             
                        </div>
                     </div>
                    
                       
                       
                       
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row mt-5">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-order1">
               <div class="electrical-item-title blue-txt mb-3">
                  What other customers bought
               </div>
               <div class="row">
                  @forelse ($productlisting as $item)
                  <div class="col-lg-6 col-md-12 col-12">
                     <div class="electrical-box-wrapper">
                        <div class="electrical-item
                           whitebg-border-box">
                           <a href="{{route('productdetails',['product_id'=>$item['id'],'catid'=>$catid,'shop_id'=>$shop_id])}}">
                           <img src="{{$item['image']}}" alt="item-1" class="img-fluid">
                           </a> 
                           <a id="favourite_product{{ $item['id'] }}" onclick="favourite_product({{ $item['id'] }})">
                              <span class="{{ ($item['is_favourite']==true)?'heart-icon':'grey-heart-icon' }}">
                           <i class="fa fa-heart"></i>
                           </span>
                           </a>
                           <a  onclick="add_product( {{ $item['id'] }},2)" >
                           <span class="plus_icon">
                                    +
                              </span>
                           </a>
                        </div>
                        <div class="electrical-item-content">
                           <div class="electrical-item-subtitle">
                              <div class="products-name">
                                 <a href="" class="anchor-link">
                                 {{$item['title']}}
                                 </a>
                              </div>
                              <div class="products-discription">
                                 {{$item['short_description']}}
                              </div>
                              <div class="current-type mt-2">{{$item['currency']}}
                                 <strong>{{$item['price']}}</strong>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @empty
                  No Data Found
                  @endforelse
                 
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-order2">
               <div class="electrical-item-title blue-txt mb-3">
                  Description
               </div>
               <div class="custom-text">
                  {{$productdetails['description']}}
               </div>
               <div class="electrical-item-title blue-txt mb-3">
                  Additional Info
               </div>
               <div class="products-more-info">
                  @forelse ($productdetails['additional_info'] as $item)
                  <div class="row colord-tr">
                     <div class="col-md-4">
                        <strong>{{$item['key']}}</strong>
                     </div>
                     <div class="col-md-8">
                        {{$item['value']}}
                     </div>
                  </div>
                 
                  @empty
                  NO Data Found
                  @endforelse
               </div>
            </div>
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

      $("i.fa.fa-share-alt").click(function(){
         $(".showallsocial").fadeToggle();
      });

      </script>

<script>
      function add_product(id,type) {
         $.ajax({
            url: "{{ url('add-to-cart') }}" + '/ajax/' + id,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'get',
            dataType: 'json',
            success: function(data) {
               
               
               if(data.status == 1){
                     swal(data.message, {
                     icon: "success",
               });
               }else{
                     swal(data.message, {
                     icon: "warning",
               });
               }
               if(type==1){
                  $("#view_to_cart").show();
                   $("#add_to_cart").hide();
               }
            },
            cache: false,
            contentType: false,
            processData: false,
         });       
      };
   </script>
@endpush