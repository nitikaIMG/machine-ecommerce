@extends('seller.layouts.vendor')
@section('title', 'Request For Quote')
@section('pageheading')
{{__('Request For Quote')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p-3" id="myTab">
            <div class="header">
              <form>
                  <div class="row">
                     <div class="col-md-4 col-lg-5">
                        <div class="title">{{__('Request For Quote') }}</div>
                     </div>
                     <div class="col-md-8 col-lg-7">
                        <ul class="nav nav-tabs accordion" role="tablist">
                           <li class="nav-item" role="presentation">
                              <a class="nav-link @if($status  == 'quotation') active @endif" href="{{ route('seller.quotations.index') }}?status=quotation" >{{__('New') }}</a>
                           </li>
                           <li class="nav-item" role="presentation">
                              <a class="nav-link @if($status  == 'confirmed') active @endif" href="{{ route('seller.quotations.index') }}?status=confirmed" >{{__('In Progress') }}</a>
                           </li>
                           <li class="nav-item" role="presentation">
                           <a class="nav-link @if($status  == 'delivered') active @endif" href="{{ route('seller.quotations.index') }}?status=delivered" >{{__('Closed') }}</a>
                           </li>
                           <li class="nav-item" role="presentation">
                              <input type="hidden" name="status" value="{{ $status }}" />
                              <select name="sortbydate" id="sortbydate" class="sort"  onChange="this.form.submit()">
                                 <option value="ASC">{{__('By Date ASC') }}</option>
                                 <option value="DESC"  >{{__('By Date DESC') }}</option>
                              </select>
                           </li>
                           <script>document.getElementById("sortbydate").value = "{{ $sort }}"; </script>
                           <!-- <li class="nav-item" role="presentation">
                              <select name="sortbyprice" id="sortbyprice" class="sort" onchange="this.form.submit()">
                                  <option value="">By Price ASC</option>
                                  <option value="">By Price DESC</option>
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
	         <th scope="col">{{__('Date')}}</th>

            <th scope="col">{{__('Shop name')}}</th>

            <th scope="col" colspan="2">{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($quotations as $quotation)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $quotation->orders['order_no'] ?? 'NA' }}</td>
	         <td>{{ $quotation['created_at']->format('d-m-Y') ?? 'NA' }}</td>
            <td>{{ $quotation['usershop']['shop_name'] ?? 'NA' }}</td>

            <td colspan="2">
              
               <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
                  @csrf
                  <input type="hidden" name="users[]" value="{{ $quotation->orders->customer_id }}" />
                  <input type="hidden" name="chatorderid" value="{{ $quotation->orders['order_no'] }}">
                  <input type="hidden" name="quotationid" value="{{ $quotation->id }}">
                  <button style="margin-bottom: 4px;" type="submit" class="btn deny">{{__('Chat') }}</button>
            </form>
             
            <a href="{{ route('seller.quotations.show',$quotation->id) }}" class="btn deny">{{ __('Details')}}</a>
            </td>
            </tr>
            
            @empty
            <tr>
            <th colspan="7" class="text-center">{{__('No Record Found.')}}</th>
            </tr>
            @endforelse
            </tbody>
            </table>
            <div style="float: right;"><span> {!! $quotations->render() !!} </span></div>
            </div>
            </div>
            <!-- <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
            <div class="table-responsive">
            <table class="table in-progress">
            <thead>
            <tr>
            <th scope="col">{{__('Request ID')}}</th>
            <th scope="col">{{__('Order number')}}</th>
            <th scope="col">{{__('Seller name')}}</th>
            <th scope="col">{{__('Seller email')}}</th>
            <th scope="col">{{__('Shop name')}}</th>
            <th scope="col">{{__('Status')}}</th>
            <th scope="col">{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($quotations->where('status',$status) as $quotation)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $quotation->order['order_no'] ?? 'NA' }}</td>
            <td>{{ $quotation->seller['name'] ?? 'NA' }}</td>
            <td>{{ $quotation->seller['email'] ?? 'NA' }}</td>
            <td>{{ $quotation->usershop['shop_name'] ?? 'NA' }}</td>
            <td>{{ $quotation->status ?? 'NA' }}</td>
            <td>
            <form action="{{ route('seller.chat.channel.create') }}" method="POST" >
            @csrf
            <input type="hidden" name="users[]" value="{{ $quotation->orders->customer_id }}" />
            <button type="submit" class="btn deny">{{__('Chat') }}</button>
            </form>
            <a style="margin-top: 4px;" href="{{ route('seller.quotations.show',$quotation->id) }}" class="deny">{{__('Details') }}</a>
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
            <th scope="col">{{__('Request ID')}}</th>
            <th scope="col">{{__('Order number')}}</th>
            <th scope="col">{{__('Seller name')}}</th>
            <th scope="col">{{__('Seller email')}}</th>
            <th scope="col">{{__('Shop name')}}</th>
            <th scope="col">{{__('Status')}}</th>
            <th scope="col">{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($quotations->where('status',$status) as $quotation)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $quotation->order['order_no'] ?? 'NA' }}</td>
            <td>{{ $quotation->seller['name'] ?? 'NA' }}</td>
            <td>{{ $quotation->seller['email'] ?? 'NA' }}</td>
            <td>{{ $quotation->usershop['shop_name'] ?? 'NA' }}</td>
            <td>{{ $quotation->status ?? 'NA' }}</td>
            <td>
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
            </div> -->
         </div>
      </div>
   </div>
</section>
@endsection