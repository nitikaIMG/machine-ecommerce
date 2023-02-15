@extends('seller.layouts.vendor')
@section('title', 'Order Details')
@section('pageheading')
{{__('Order Details')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title">{{ __('Order Details') }}</div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="order-wrap">
                     <div class="sb-header">
                      
                        <div class="name">
                           <span>{{ isset($customer->name) ? $customer->name : '' }}</span>
                           <span class="order-id">Order No: <strong>{{ $order->order_no }}</strong></span>
                        </div>
                        <div class="action">
                           <span class="date">Date: {{ date('d-m-Y',strtotime($carts[0]['created_at'])) }}  </span>
                           <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
                              @csrf
                              <input type="hidden" name="users[]" value="{{ $customer->id }}" />
                              <input type="hidden" name="message" value="{{ $order->order_no }}">
				<input type="hidden" name="type" value="1">
                              <button type="submit" class="btn btn-primary"><img src="{{ asset('seller/images/chat-icon-btn.png') }}" alt="">{{ __('Chat') }}</button>
                           </form>
                        </div>
                       
                     </div>
                     <div class="row-divider">
                        <div class="row">
                           @php
                           $total = 0;
                           @endphp
                           @foreach($carts as $cart)
                           @php
                           if(isset($cart->bid->bid)){
                                                $total += $cart->qty * $cart->bid->bid;
                                            }
                                                else{
                                                $total += $cart->qty * $cart->seller->price;
                                            }
                                       
                           @endphp
                              <div class="col-md-12 col-lg-6">
                                 <div class="row">
                                    <div class="col-md-6 col-lg-3">
                                       <div class="product">
                                          <figure>
                                             <img src="{{asset("storage/{$cart->pro['cover_image']}")}}" style="height: 100px; max-width:100px ;">
                                          </figure>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-lg-9">
                                       <div class="product">
                                          <div class="content">
                                             <div class="name">{{ $cart->pro->title }}</div>
                                             <div class="qty">Quantity: {{ $cart->qty }}</div>
                                             </br>
                                             <div class="price">AED {{ isset($cart->bid->bid) ? $cart->bid->bid : $cart->seller->price }}</div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="action-btns">
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <div >
                              <label class="labels">Total Amount: {{ number_format($total,2) }}</label>
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