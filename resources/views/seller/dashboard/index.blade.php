@extends('seller.layouts.vendor')
@section('title', 'Dashboard')
@section('pageheading')
{{__('Dashboard')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-4">
         <div class="card text-center">
            <figure>
               <img src="images/1.png" alt="">
            </figure>
            <p class="number">{{ $order_total }}</p>
            <p class="number-text">Total No. of Orders</p>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card text-center">
            <figure>
               <img src="images/2.png" alt="">
            </figure>
            <p class="number">{{ $quotation_total }}</p>
            <p class="number-text">{{ __('Total No. of RFQs') }}</p>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card text-center">
            <figure>
               <img src="images/3.png" alt="">
            </figure>
            <p class="number">{{ $msg_total }}</p>
            <p class="number-text">Total No. of Chats</p>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-4 col-lg-5">
                     <div class="title">{{ __('New RFQ’s') }}</div>
                  </div>
                  <div class="col-md-8 col-lg-7">
                     <ul class="nav nav-tabs accordion" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="New-tab" data-bs-toggle="tab" data-bs-target="#New" type="button" role="tab" aria-controls="New" aria-selected="true">{{ __('New') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="In-progres-tab" data-bs-toggle="tab" data-bs-target="#In-progres" type="button" role="tab" aria-controls="In-progres" aria-selected="false">{{ __('In Progress') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="Closed-tab" data-bs-toggle="tab" data-bs-target="#Closed" type="button" role="tab" aria-controls="Closed" aria-selected="false">{{ __('Closed') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a href="{{ route('seller.quotations.index') }}" class="nav-link view-all" >{{ __('View All') }}</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="New" role="tabpanel" aria-labelledby="New-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">{{__('SN') }}</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('Shop name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                             
                              
                              
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse ($quotations->where('status','quotation')->take(10) as $quotation)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $quotation->order['order_no'] ?? 'NA' }}</td>
                              <td>{{ $quotation->usershop['shop_name'] ?? 'NA' }}</td>
                              <td>{{ $quotation->created_at->format('d-m-Y') ?? 'NA'  }}</td>
                           
                             
                              
                              <td>
                              <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="users[]" style="border:0px;" value="{{ $quotation->orders->customer_id }}" />
                                    <input type="hidden" name="chatorderid" value="{{ $quotation->orders->order_no }}">
                                    <input type="hidden" name="quotationid" value="{{ $quotation->id }}">
                                    <button type="submit" class="btn btn-primary">{{ __('Chat')}}</button>
                                 </form>
                                 <a href="{{ route('seller.quotations.show',$quotation->id) }}" class="accept">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade" id="In-progres" role="tabpanel" aria-labelledby="In-progres-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                           <th scope="col">{{__('SN') }}</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('Shop name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse ($quotations->where('status','confirmed')->take(10) as $quotation)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $quotation->order['order_no'] ?? 'NA' }}</td>
                              <td>{{ $quotation->usershop['shop_name'] ?? 'NA' }}</td>
                              <td>{{ $quotation->created_at->format('d-m-Y') ?? 'NA'  }}</td>
                              <td>
                              <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="users[]" style="border:0px;" value="{{ $quotation->orders->customer_id }}" />
                                    <input type="hidden" name="chatorderid" value="{{ $quotation->orders->order_no }}">
                                    <input type="hidden" name="quotationid" value="{{ $quotation->id }}">
                                    <button type="submit" class="btn btn-primary">{{ __('Chat')}}</button>
                                 </form>
                                 <a href="{{ route('seller.quotations.show',$quotation->id) }}" class="accept">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade" id="Closed" role="tabpanel" aria-labelledby="Closed-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                           <th scope="col">{{__('SN') }}</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('Shop name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse ($quotations->where('status','delivered')->take(10) as $quotation)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $quotation->order['order_no'] ?? 'NA' }}</td>
                              <td>{{ $quotation->usershop['shop_name'] ?? 'NA' }}</td>
                              <td>{{ $quotation->created_at->format('d-m-Y') ?? 'NA'  }}</td>
                              <td>
                              <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="users[]" style="border:0px;" value="{{ $quotation->orders->customer_id }}" />
                                    <input type="hidden" name="chatorderid" value="{{ $quotation->orders->order_no }}">
                                    <input type="hidden" name="quotationid" value="{{ $quotation->id }}">
                                    <button type="submit" class="btn btn-primary">{{ __('Chat')}}</button>
                                 </form>
                                 <a href="{{ route('seller.quotations.show',$quotation->id) }}" class="accept">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade" id="View-All" role="tabpanel" aria-labelledby="View-All-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">Request ID</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('User name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                             
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse ($quotations as $quotation)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $quotation->order['order_no'] ?? 'NA' }}</td>
                              <td>{{ $quotation->user['name'] ?? 'NA' }}</td>
                              <td>{{ $quotation->created_at->format('d-m-Y') ?? 'NA' }}</td>
                              <td>
                              <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="users[]" style="border:0px;" value="{{ $quotation->orders->customer_id }}" />
                                    <input type="hidden" name="chatorderid" value="{{ $quotation->orders->order_no }}">
                                    <input type="hidden" name="quotationid" value="{{ $quotation->id }}">
                                    <button type="submit" class="btn btn-primary">{{ __('Chat')}}</button>
                                 </form>
                                 <a href="{{ route('seller.quotations.show',$quotation->id) }}" class="accept">{{ __('Show')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card p-3" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-4 col-lg-5">
                     <div class="title">{{__('New Orders') }}</div>
                  </div>
                  <div class="col-md-8 col-lg-7">
                     <ul class="nav nav-tabs accordion" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="News-tab" data-bs-toggle="tab" data-bs-target="#News" type="button" role="tab" aria-controls="News" aria-selected="true">{{__('New') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">{{__('Completed') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="Cancelled-tab" data-bs-toggle="tab" data-bs-target="#Cancelled" type="button" role="tab" aria-controls="Cancelled" aria-selected="false">{{__('Cancelled') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a href="{{ route('seller.order.index') }}" class="nav-link view-all" >{{__('View All') }}</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">Request ID</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('User name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                             
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($orders->where('order_status','confirmed')->take(10) as $order)  
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $order->order_no}}</td>
                             
                              <td>{{$order->user->name ?? 'NA' }}</td>
                              
                              @if(!empty($order->created_at))
                              <td>{{$order->created_at->format('d-m-Y') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                                 <a href="{{ route('seller.order.show',$order->id) }}" class="btn btn-primary">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">Request ID</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('User name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                             
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($orders->where('order_status','delivered')->take(10) as $order)  
                           <tr>
                           <td>{{ $loop->iteration }}</td>
                              <td>{{ $order->order_no}}</td>
                             
                              <td>{{$order->user->name ?? 'NA' }}</td>
                              
                              @if(!empty($order->created_at))
                              <td>{{$order->created_at->format('d-m-Y') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                                 <a href="{{ route('seller.order.show',$order->id) }}" class="accept">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade" id="Cancelled" role="tabpanel" aria-labelledby="Cancelled-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">Request ID</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('User name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                             
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($orders->where('delivery_type','cancelled')->take(10) as $order)  
                           <tr>
                           <td>{{ $loop->iteration }}</td>
                              <td>{{ $order->order_no}}</td>
                             
                              <td>{{$order->user->name ?? 'NA' }}</td>
                              
                              @if(!empty($order->created_at))
                              <td>{{$order->created_at->format('d-m-Y') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                                 <a href="{{ route('seller.order.show',$order->id) }}" class="accept">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade" id="View-Alls" role="tabpanel" aria-labelledby="View-Alls-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">Request ID</th>
                              <th scope="col">{{__('Order No')}}</th>
                              <th scope="col">{{__('User name')}}</th>
                              <th scope="col">{{__('Date')}}</th>
                             
                              <th scope="col">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($orders as $order)  
                           <tr>
                           <td>{{ $loop->iteration }}</td>
                              <td>{{ $order->order_no}}</td>
                             
                              <td>{{$order->user->name ?? 'NA' }}</td>
                              
                              @if(!empty($order->created_at))
                              <td>{{$order->created_at->format('d-m-Y') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                                 <a href="{{ route('seller.order.show',$order->id) }}" class="accept">{{ __('Details')}}</a>
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <th colspan="7" class="text-center">{{__('No Record Found.')}}.</th>
                           </tr>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection