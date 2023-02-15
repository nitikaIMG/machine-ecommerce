@extends('customer.layouts.main')
{{-- @dd($orderdetails) --}}
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
                                <div class="card p-3" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="title">My Orders</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="order-wrap">
                                                <div class="sb-header">
                                                    <div class="name">
							<span>
                                                            <strong>{{ $orderdetails['seller'] }}</strong></span> <br>
                                                        <span>Order NO :
                                                            <strong>{{ $orderdetails['order_no'] }}</strong></span>
                                                        <span class="order-id">Date:
                                                            <strong>{{ $orderdetails['date'] }}</strong></span>
                                                    </div>
                                                    <div class="action">
                                                        <span class="date " style="color: #01e501; margin-bottom:6px;"> <strong>{{ $orderdetails['status'] }}</strong></span>

                                                        <form action="{{ route('chat.channel.create') }}" method="POST" >
                                                        @csrf
                                                        <input type="hidden" name="users[]" value="{{ $orderdetails['items'][0]['sellerid'] }}" />
                                                        <input type="hidden" name="message" value="{{ $orderdetails['order_no'] }}">
							                            <input type="hidden" name="type" value="1" /> 
                                                        <button type="submit" class="btn btn-primary"><img src="images/chat-icon-btn.png" alt="">{{__('Chat') }}</button>
                                                        </form>
                                                        
                                                    </div>

                                                   
                                                </div>
                                                <div class="row-divider">
					 @php
                           		 $total = 0;
                           		@endphp
							<div class="row">
                                                  @forelse ($orderdetails['items'] as $item)
							@php
                           				
                                                		$total += $item['quantity'] * isset($item['biddings'][0]['bid']) ? $item['biddings'][0]['bid'] : $item['price'] ;
                                            		
                                       
                           				@endphp

                                                        
                                                            <div class="col-md-6 col-lg-6">
                                                                <div class="product order-products-img">
                                                                    <figure>
                                                                        <img src="{{ $item['image'] }}" alt=""
                                                                            class="img-fluid">
                                                                    </figure>
                                                                    <div class="content">
                                                                        {{-- @dd($orderdetails['items']) --}}
                                                                        <div class="name">{{ $item['title'] }}</div>
                                                                        <div class="name">{{ $item['short_description'] }}</div>
                                                                        <div class="qty">Quantity:
                                                                            {{ $item['quantity'] }}</div>
                                                                        <div class="price">{{ $item['currency'] }}
                                                                        {{ isset($item['biddings'][0]['bid']) ? $item['biddings'][0]['bid'] : $item['price'] }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                    @empty
                                                        No Data Found
                                                    @endforelse
						</div>
                                                </div>


                                                

                                                 <div class="order-information">
                                                    <div class="title">Order Information</div>
                                                    <table class="table-order">
                                                        <tbody>
                                                            <tr>
                                                                <th>Shipping address:</th>
                                                                <td>{{ $orderdetails['customer_address'] }}
                                                                </td>
                                                            </tr>
                                                           <!-- <tr>
                                                                <th>Delivery Method:</th>
                                                                <td>FedEx, 3 Days, AED15</td>
                                                            </tr> -->
                                                            <tr>
                                                                <th>Total Amount:</th>
                                                                <td>AED {{ number_format($total,2) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>  
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
