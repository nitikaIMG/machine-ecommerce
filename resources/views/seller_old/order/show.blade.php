@extends('layouts.vendor')
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
                     @if(!empty($abc['bid']))
                     <th>{{__('Bidding details')}}</th>

                     <td>ID: <br>{{ ($abc['bid']->id) ?? 'NA'  }}</td>
                     <td>Customer Id:<br> {{ ($abc['bid']->customer_id) ?? 'NA' }}</td>
                     <td>Customer name:<br>{{ ($abc['bidcustomer']->name) ?? 'NA'  }}</td>
                     <td>bid price:<br>{{ ($abc['bid']->bid) ?? 'NA'  }}</td>
                     <td>status:<br>{{ ($abc['bid']->accepted==0) ? 'No action taken':''  }}</td>


                     @else
                     <th>{{__('Bidding details')}}</th>
                     <td>NA</td>
                     @endif
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