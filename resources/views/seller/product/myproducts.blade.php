@extends('seller.layouts.vendor')
@section('title', 'Manage Shop')
@section('pageheading')
{{__('Manage Shop')}}
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
                        <div class="title">{{__('Products') }}</div>
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
                           <th scope="col">#</th>
                           <th scope="col">{{__('Seller name')}}</th>
                           <th scope="col">{{__('Seller email')}}</th>
                           <th scope="col">{{__('Shop name')}}</th>
                           <th scope="col">{{__('Product name')}}</th>
                           <th scope="col">{{__('Product category')}}</th>
                           <th scope="col">{{__('Price')}}</th>
                           <th scope="col">{{__('Price type')}}</th>
                           <th scope="col">{{__('Quantity')}}</th>
                           <th scope="col">{{__('Created at')}}</th>
                             
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
         </div>
      </div>
   </div>
</section>
@endsection