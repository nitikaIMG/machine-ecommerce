@extends('seller.layouts.vendor')
@section('title', 'RFQ Details')
@section('pageheading')
    {{ __('RFQ Details') }}
@endsection
@section('content')
    <section class="center-wraper">
        <div class="row">
            <div class="col-md-12">
                <div class="card p30" id="myTab">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="title">{{ __('Request for Quote') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="order-wrap">
                                <div class="sb-header">

                                 
                                        <div class="name">
                                            <span>{{ isset($customer->name) ? $customer->name : '' }}</span>
                                            <span class="order-id">Quote Request No: <strong>{{ $order_seller->order_no }}</strong></span>
                                        </div>
                                        <div class="action">
                                            <span class="date">{{ __('Date') }}:
                                                {{ $carts[0]['created_at']->format('d-m-Y') }} </span>
                                            <form action="{{ route('seller.chat.channel.create') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="users[]"
                                                    value="{{ $customer->id }}" />
                                                <input type="hidden" name="message" value="{{ $order_seller->order_no }}">
						                        <input type="hidden" name="type" value="1">    
                                                <button type="submit" class="btn btn-primary" ><img
                                                        src="{{ asset('seller/images/chat-icon-btn.png') }}"
                                                        alt="">{{ __('Chat') }}</button>
                                            </form>

                                            <form action="{{ route('seller.chat.channel.create') }}" method="POST" style="display:none;">
                                                @csrf
                                                <input type="hidden" name="users[]"
                                                    value="{{ $customer->id }}" />
                                                <input type="hidden" name="quotationid" value="{{ $order_seller->id }}">
                                                <input type="hidden" name="deny" value="deny">  
						                        <input type="hidden" name="type" value="1">
                                                <input type="hidden" name="message" value="{{ $order_seller->order_no }}">    
                                                <button type="submit" class="btn btn-primary" id="chat_id"><img
                                                        src="{{ asset('seller/images/chat-icon-btn.png') }}"
                                                        alt="">{{ __('Chat') }}</button>
                                            </form>
                                        </div>
                                  
                                </div>
                            </div>
                            <div class="row-divider">
                                <div class="row">
                                    @php
                                    $bid=0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                        
                                           
                                            if(isset($cart->bid->bid)){
                                                $total += $cart->qty * $cart->bid->bid;
                                            }
                                            else{
                                                $total += $cart->qty * $cart->seller->price;
                                            }
                                        @endphp
                                        <div class="col-md-3 col-lg-3">
                                            <div class="product">
                                                <figure>
                                                    <img src="{{ asset("storage/{$cart->pro['cover_image']}") }}"
                                                        style="max-height: 125px; max-width:450px ;">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-lg-9">
                                            <div class="product">
                                                <div class="content">
                                                    <div class="name">{{ $cart->pro->title }}</div>
                                                    <div class="qty">{{ __('Quantity') }}: {{ $cart->qty }}
                                                    </div>
							<br>
                                                    <div class="price">{{ isset($cart->bid->bid) ? $cart->bid->bid : $cart->seller->price }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                     <div class="col-md-12">
                         <div class="action-btns">
                             <div class="row">
                                 <div class="col-md-6 col-lg-6">
                                     <div>
                                         <label class="title">{{ __('Total Amount') }} :
                                            AED {{ number_format($total, 2) }}</label>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6 text-md-end acceptdiv">
                                 @if ($order_seller->status == 'quotation')
                                 <button id="accept_cart" class="big-btn accept" style="border:none;"><b>{{ __('Accept') }}</b></button>
                                 <button id="deny_cart" class="big-btn cancel-btn2" style="border:none; color:white;"><b>{{ __('Deny') }}</b></button>
                                @else
				                    {{ ucfirst($order_seller->status) }} 
				                @endif

                                 <!-- @if(isset($carts[0]['bid']))
                                  @php 
                                    $carts[0];
                                     $bid = isset($carts[0]['bid']['id']) ? $carts[0]['bid']['id'] : null;
                                  @endphp
                                 @if($carts[0]['bid']['accepted'] == '0')
                                     @if ($order_seller->status == 'quotation' AND $carts[0]['bid']['accepted'] == 0)
                                     <button id="accept" class="big-btn accept">{{ __('Accept') }}</button>
                                        <button id="deny" class="big-btn deny">{{ __('Deny') }}</button>
                                     @endif    
                                     @endif
                                     @else -->
                                   
                                     <!-- @endif  -->
                                    
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

      <!-- <script>
         $('#accept').click(function() {
                           $.ajax({
                            url: "{{ url('seller/quotation/accept_reject_bid/') }}?bid_id={{$bid}}&&accepted=1",
                              headers: {
                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                              },
                              type: 'get',
                              dataType: 'json',
                              success: function(data) {

                                if(data.status == 1){
                                    $('.acceptdiv').html('');
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
         $('#deny').click(function() {
                           $.ajax({
                            url: "{{ url('seller/quotation/accept_reject_bid') }}?bid_id={{$bid}}&&accepted=-1",
                              headers: {
                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                              },
                              type: 'get',
                              dataType: 'json',
                              success: function(data) {

                                if(data.status == 1){
                                    $('.acceptdiv').html('');
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
      </script> -->

  <script>
         $('#accept_cart').click(function() {
                           $.ajax({
                            url: "{{ url('seller/quotation/accept_reject_quotation/') }}?id={{$id}}&&accepted=1",
                              headers: {
                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                              },
                              type: 'get',
                              dataType: 'json',
                              success: function(data) {

                                if(data.status == 1){
                                    $('.acceptdiv').html('');
                                }
                                if(data.error){
                                    swal(data.error, {
                                        icon: "warning",
                                    });
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
         $('#deny_cart').click(function() {
                           $.ajax({
                            url: "{{ url('seller/quotation/accept_reject_quotation') }}?id={{$id}}&&accepted=-1",
                              headers: {
                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                              },
                              type: 'get',
                              dataType: 'json',
                              success: function(data) {

                                if(data.status == 1){
                                    $('.acceptdiv').html('');
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
                                $('#chat_id').click();
                              },
                              cache: false,
                              contentType: false,
                              processData: false,
                           });
                     
                  
         });
    </script>
    
   @endpush
