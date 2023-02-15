@extends('layouts.admin')
@section('title', __('Order detail'))
@section('pageheading')
{{ __('Order detail') }}
@endsection
@section('content')

<div class="container-fluid">
  
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="table-responsive">
         <table id="dataTable" class="display table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{__('Product id')}}</th>
                  <th>{{__('Seller product id')}}</th>
                  <th>{{__('Product title')}}</th>
                  <th>{{__('Product short description')}}</th>
                  <th>{{__('Product Image')}}</th>
                  <th>{{__('Product price type ')}}</th>
                  <th>{{__('Product price ')}}</th>
                  <th>{{__('Product quantity ')}}</th>
                  <th>{{__('Shop name')}}</th>
                  <th>{{__('Bid')}}</th>

               </tr>
            </thead>
            <tbody>
               @if ($carts->count() > 0)
               @foreach ($carts as $abc)
               <tr>
                  <td>{{ $loop->iteration }}</td>
               
                  <td>
                     {{$abc->pro['id'] ?? 'NA' }}
                  </td>
                  <td>
                     {{ $abc->seller['id'] ?? 'NA' }}
                  </td>
                  <td>
                     {{$abc->pro['title'] ?? 'NA'}}
                  </td>
                  <td>
                     {{$abc->pro['short_description'] ?? 'NA'}}
                  </td>
                  <td>
                     <img src="{{asset("storage/{$abc->pro['cover_image']}")}}" style="max-height: 125px; max-width:450px ;">
                  </td>
                  <td>
                     {{$abc->seller['price_type'] ?? 'NA'}}
                  </td>
                  <td>
                     {{$abc->seller['price'] ?? 'NA'}}
                  </td>
                  <td>
                     {{$abc->seller['qty'] ?? 'NA'}}
                  </td>
                   <td>
                     {{$abc->usershop['shop_name'] ?? 'NA' }}
                  </td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal{{$abc->pro['id']}}">
                           {{__('Bid details')}}
                           </button>
                           <!-- Modal -->
                           <div class="modal fade" id="statusModal{{$abc->pro['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">{{__('Bid info')}}</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                    @if(!empty($abc['bid']))
                                    <h6>ID:{{ ($abc['bid']->id) ?? 'NA'  }}</h6>
                                    <h6>Customer ID:{{ ($abc['bid']->customer_id) ?? 'NA' }}</h6>
                                    <h6>Customer name:{{ ($abc['bidcustomer']->name) ?? 'NA'  }}</h6>
                                    <h6>Bid price:{{ ($abc['bid']->bid) ?? 'NA'  }}</h6>
                                    <h6>status:{{ ($abc['bid']->accepted==0) ? 'No action taken':''  }}</h6>
                                    @else
                                    <!-- <h1>{{__('Bidding details')}}</h1> -->
                                    <h6>NA</h6>
                                    @endif

                                    </div>
                                 </div>
                              </div>
                           </div>
                           {{-- end --}}
                  </td>
                  
               </tr>
               @endforeach
               @else
               <tr>
                  <td>{{__('No result found!')}}</td>
               </tr>
               @endif
            </tbody>
         </table>
      </div>
   </div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')
<script type="text/javascript">
   $(function(){
   $('#dataTable').DataTable();
   });
</script>
@stop