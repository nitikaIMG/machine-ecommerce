@extends('customer.layouts.main')
{{-- @dd($orderListing) --}}
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
 		        <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p-3" id="myTab">
                                <div class="header">
                                    @if (session('success'))
                                    <span style="color:green">{{ session('success') }}</span>
                                    @else
                                        <span style="color:red">{{ session('error') }}</span>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-4 col-lg-3">
                                            <div class="title">My Orders</div>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <ul class="nav nav-tabs accordion order-status-list" role="tablist">
                                                <li class="nav-item" role="presentation">
                                            <ul class="nav nav-tabs accordion" role="tablist">
                                                 
                                                <li class="nav-item" role="presentation">
                                                    <a   class="nav-link @if($status == 'confirmed') active @endif" href="{{ route('order') }}?status=confirmed" >New</a>
                                                    </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link @if($status == 'delivered') active @endif" href="{{ route('order') }}?status=delivered">Completed</a>
                                                </li>
						                        <li class="nav-item" role="presentation">
                                                    <a class="nav-link @if($status  == 'cancelled') active @endif" href="{{ route('order') }}?status=cancelled" >Cancelled</a>
                                                </li> 
                                                <li class="nav-item" role="presentation">
                                                <input type="hidden" name="status" value="{{ $status }}" />
                                                    <select name="sortbydate" id="sortbydate" class="sort" onchange="this.form.submit()">
                                                        <option value="ASC">{{__('By Date ASC') }}</option>
                                                        <option value="DESC">{{__('By Date DESC') }}</option>
                                                    </select>
                                                </li>
                                                <script>document.getElementById("sortbydate").value = "{{ $sort }}"; </script>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </form>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr><th scope="col">SN</th>

                                                        <th scope="col">Order No</th>
                                                        <th scope="col">Date</th>
                                                        <!-- <th scope="col">Price</th>-->

                                                        <th scope="col" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                        @forelse ($orderListing as $item)
                                                       <tr>
							                            <td>{{$loop->index+1}}</td>
                                                        <td>{{$item['order_no']}}</td>
                                                       
                                                        <td>{{  $item['created_at']->format('d-m-Y') }}</td>
                                                       <!-- <td>{{  $item['date_str'] }}</td>-->

                                                        <td class="text-center">
                                                            @if($status=='pending')
                                                            <div class="action">
                                                      
                                                                         <form action="{{ route('chat.channel.create') }}" method="POST" >
                                                                                @csrf
                                                                                <input type="hidden" name="users[]" value="{{ $item['seller_orders'][0]['seller_id'] }}" />
                                                                                <input type="hidden" name="chatorderid" value="{{ $item['order_no'] }}">
                                                                                <button type="submit" class="btn btn-primary mb-2"><img src="{{ asset('web/images/chat-icon-btn.png') }}" alt="">{{__('Chat') }}</button>
                                                                        </form>
                                                                              

                                                            </div>
                                                            @endif
                                                            <a href="{{ route('orderDetails',$item['id']) }}" class="deny">Details</a>
                                                            @if($status=='delivered')
                                                            <a href="{{ route('rating',[$item->item->seller_product->seller_id,$item->item->seller_product->shop_id] ) }}" class="deny">Rating</a>
                                                            @endif
                                                        </td>
                                                        </tr>
                                                        @empty
                                                            No Orders Found
                                                        @endforelse
                                                    

                                                
                                                </tbody>
                                            </table>
                                            <div style="float: right;"><span>	{!! $orderListing->render() !!} </span></div>
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