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
                                <div class="card p30" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="title">Request for Quote</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="order-wrap">
                                                <div class="sb-header">
                                                    <div class="name">
                                                        <span>Order NO :
                                                            <strong>{{ $orderdetails['order_no'] }}</strong></span>
                                                        <span class="order-id">Date:
                                                            <strong>{{ date('d-m-Y', strtotime($orderdetails['created_at'])) }}</strong></span>
                                                    </div>
                                                    <div class="action">
                                                        <span class="date"> </span>
							                            <form action="{{ route('chat.channel.create') }}" method="POST" >
                                                        @csrf 
                                                        <input type="hidden" name="users[]" value="{{ $orderdetails['items'][0]['sellerid'] }}" />
                                                        <input type="hidden" name="message" value="{{ $orderdetails['order_no'] }}">
							                            <input type="hidden" name="type" value="1" />
                                                        <button type="submit" class="btn btn-primary"><img src="{{ asset('web/images/chat-icon-btn.png') }}" alt="">{{__('Chat') }}</button>
                                                        </form>
                                                        <div class="delivered"></div>
                                                    </div>
                                                </div>
                                                <div class="row-divider">
                                                <div class="row">
                                                    @forelse ($orderdetails['items'] as $item)
                                                        
                                                            <div class="col-md-6 col-lg-6">
                                                                <div class="product">
                                                                    <figure>
                                                                        <img src="{{ $item['image'] }}" alt=""
                                                                            class="img-fluid">
                                                                    </figure>
                                                                    <div class="content">
                                                                     
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


                                                {{-- <div class="row-divider">
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="product">
                                                            <figure>
                                                                <img src="images/pro-img.jpg" alt="" class="img-fluid">
                                                            </figure>
                                                            <div class="content">
                                                                <div class="name">Philips 125W HPI Lamps- N 125W/541 B22d-3 SG 1SL</div>
                                                                <div class="qty">Quantity: 3</div>
                                                                <div class="price">AED 25.56</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="product">
                                                            <figure>
                                                                <img src="images/pro-img.jpg" alt="" class="img-fluid">
                                                            </figure>
                                                            <div class="content">
                                                                <div class="name">Philips 125W HPI Lamps- N 125W/541 B22d-3 SG 1SL</div>
                                                                <div class="qty">Quantity: 3</div>
                                                                <div class="price">AED 25.56</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}


                                                <!-- <div class="order-information">
                                                    <div class="title">Quatation Information</div>
                                                    <table class="table-order">
                                                        <tbody>
                                                            <tr>
                                                                <th>Shipping address:</th>
                                                                <td>3 Newbridge Court, <br> Chino hills,<br> CA 91709, UAE
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Delivery Method:</th>
                                                                <td>FedEx, 3 Days, AED15</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Amount:</th>
                                                                <td>$38.56</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> -->
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
