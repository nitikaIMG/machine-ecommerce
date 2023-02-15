@extends('seller.layouts.vendor')
@section('title', 'Dashboard')
@section('pageheading')
{{__('Orders')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p-3" id="myTab">
            <div class="header">
               <form>
                  <div class="row">
                     <div class="col-md-4 col-lg-4">
                        <div class="title">{{__('My Orders') }}</div>
                     </div>
                     <div class="col-md-8 col-lg-8">
                        <ul class="nav nav-tabs accordion" role="tablist">
                           <li class="nav-item" role="presentation">
                              <a class="nav-link @if($status  == 'confirmed') active @endif" href="{{ route('seller.order.index') }}?status=confirmed">{{__('New') }}</a>
                           </li>
                           <li class="nav-item" role="presentation">
                              <a class="nav-link @if($status  == 'delivered') active @endif" href="{{ route('seller.order.index') }}?status=delivered">{{__('Completed') }}</a>
                           </li>
                           <li class="nav-item " role="presentation">
                              <button class="nav-link @if($status  == 'cancelled') active @endif" href="{{ route('seller.order.index') }}?status=cancelled">{{__('Cancelled') }}</button>
                           </li>
                           <li class="nav-item" role="presentation">
                           <input type="hidden" name="status" value="{{ $status }}" />
                              <select name="sortbydate" id="sortbydate" class="sort" onchange="this.form.submit()">
                                 <option value="ASC">{{__('By Date ASC') }}</option>
                                 <option value="DESC">{{__('By Date DESC') }}</option>
                              </select>
                           </li>
                           <script>document.getElementById("sortbydate").value = "{{ $sort }}"; </script>
                           <!-- <li class="nav-item" role="presentation">
                              <select name="" id="" class="sort">
                                  <option value="">Sort by Price</option>
                              </select>
                              </li> -->
                        </ul>
                     </div>
                  </div>
               </form>
            </div>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">{{__('SN') }}</th>
                              <th scope="col">{{__('Order No.')}}</th>

                              <th scope="col">{{__('User name')}}</th>

                              <th scope="col">{{__('Date')}}</th>
                              <th scope="col" class="text-center">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($orders as $order)  
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{$order->order_no}}</td>
                              <td>{{$order->user->name ?? 'NA' }}</td>

                              @if(!empty($order->created_at))
                              <td>{{$order->created_at->format('d-m-Y') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                              <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
                              @csrf
                              <input type="hidden" name="users[]" value="{{ $order->customer_id }}" />
                              <input type="hidden" name="quotationid" value="{{ $order->quotationid }}">
                              <button style="margin-bottom: 4px;" type="submit" class="btn deny">{{__('Chat') }}</button>
                              </form>
                                 <a href="{{ route('seller.order.show',$order->id) }}" class="accept">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     <div style="float: right;"><span>	{!! $orders->render() !!} </span></div>
                  </div>
               </div>
               <!-- <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                  <div class="table-responsive">
                     <table class="table in-progress">
                        <thead>
                           <tr>
                              <th scope="col">{{__('Request ID') }}</th>
                              <th scope="col">{{__('Order number')}}</th>
                              <th scope="col">{{__('Cart')}}</th>
                              <th scope="col">{{__('User name')}}</th>
                              <th scope="col">{{__('User email')}}</th>
                              <th scope="col">{{__('Created')}}</th>
                              <th scope="col" class="text-center">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($orders->where('order_status','delivered') as $order)  
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{$order->order_no}}</td>
                              <td> {{$order->cart_id}}</td>
                              <td>{{$order->user->name ?? 'NA' }}</td>
                              <td>{{$order->user->email ?? 'NA'}}</td>
                              @if(!empty($order->created_at))
                              <td>{{$order->created_at->format('Y/m/d') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                                 <a href="{{ route('seller.order.show',$order->id) }}" class="accept">{{ __('Show')}}</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade" id="Cancelled" role="tabpanel" aria-labelledby="Cancelled-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">{{__('Request ID') }}</th>
                              <th scope="col">{{__('Order number')}}</th>
                              <th scope="col">{{__('Cart')}}</th>
                              <th scope="col">{{__('User name')}}</th>
                              <th scope="col">{{__('User email')}}</th>
                              <th scope="col">{{__('Created')}}</th>
                              <th scope="col" class="text-center">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($orders->where('order_status','cancelled') as $order)  
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{$order->order_no}}</td>
                              <td> {{$order->cart_id}}</td>
                              <td>{{$order->user->name ?? 'NA' }}</td>
                              <td>{{$order->user->email ?? 'NA'}}</td>
                              @if(!empty($order->created_at))
                              <td>{{$order->created_at->format('Y/m/d') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                                 <a href="{{ route('seller.order.show',$order->id) }}" class="accept">{{ __('Show')}}</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
   </div>
</section>
@endsection