@extends('layouts.vendor')
@section('title', __('My products'))
@section('pageheading')
{{ __('My products') }}
@endsection
@section('content')
<?php
   $full_url = url()->full(); 
   ?>
<div class="container-fluid">
  
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="table-responsive">
         <table id="dataTable" class="display table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{__('Seller name')}}</th>
                  <th>{{__('Seller email')}}</th>
                  <th>{{__('Shop name')}}</th>
                  <th>{{__('Product name')}}</th>
                  <th>{{__('Product category')}}</th>
                  <th>{{__('Price')}}</th>
                  <th>{{__('Price type')}}</th>
                  <th>{{__('Quantity')}}</th>
                  <th>{{__('Created at')}}</th>


               </tr>
            </thead>
            <tbody>
               @if ($my_products->count() > 0)
               @foreach ($my_products as $products)
               <tr>
                  <td>{{ $loop->iteration }}</td>
               
                  <td>
                     @php
                     $user= App\Models\User::where('id',$products->seller_id)->first();
                     @endphp

                     {{$user->name ?? 'NA' }}
                  </td>
                  <td>{{$user->email ?? 'NA'}}</td>
                  <td>
                     @php
                     $shop= App\Models\UserShop::where('id',$products->shop_id)->first();
                     @endphp

                     {{$shop->shop_name ?? 'NA' }}
                  </td>

                  <td>
                     @php
                     $product= App\Models\Product::where('id',$products->product_id)->first();
                     @endphp

                     {{$product->title ?? 'NA' }}
                  </td>
                  <td>
                     @php
                     $product= App\Models\Product::where('id',$products->product_id)->first();
                     @endphp

                     {{$product->product_category->title  ?? 'NA' }}
                  </td>
                  <td>{{$products->price ?? 'NA'}}</td>
                  <td>{{$products->price_type}}</td>
                  <td>{{$products->qty ?? 'Unlimited'}}</td>
                  <td>{{$products->created_at->format('Y/m/d') }}</td>

                 
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