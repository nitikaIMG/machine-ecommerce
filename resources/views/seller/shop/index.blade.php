@extends('seller.layouts.vendor')
@section('title', 'Manage Shop')
@section('pageheading')
{{__('Manage Shop')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p-3 card_new" id="myTab">
            <div class="card_header">
               <div class="title">{{__('Manage a Shop')}}</div>
               <a class="save-btn" href="{{ route('seller.shops.create') }}">{{__('Add a Shop')}}</a>  
            </div> 
            @if (session('success'))
         <span style="color:green">{{ session('success') }}</span>
            @else
               <span style="color:red">{{ session('error') }}</span>
            @endif   
         </div> 
          
  
      </div>
    @forelse($user_shops as $shop)
      <div class="col-md-12">
         <div class="card p-3 card_new" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-6">
                     <div class="title">{{ $shop->shop_name }}
                     <a href="{{ route('seller.shop.edit',[$shop->id,$shop->user_id])}}" class="edit">
                        <i class="fa fa-pencil"></i>
                     </a>

                     <a href="{{ route('seller.shop.show',[$shop->id,$shop->user_id])}}" class="edit">
                        <i class="fa fa-eye"></i>
                     </a>
                     </div>
                     <div class="shop-name">
                     
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="float-md-end">
                        <div class="shop-categories">@if(isset($shop->categories[0]->title)) {{__('Category')}}: {{ $shop->categories[0]->title }} @endif  
                        </div>
                        @if(isset($shop->categories[0]->id))
                           <div class="shop-date"> 
                                 <a href="{{ route('seller.product.category',[$shop->categories[0]->id,$shop->id] )}}" class="edit">
                                    Add Product
                                 </a>
                           </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 col-lg-3">
                  <div class="shop-block">
                     <div class="ttl">{{__('Quote')}}</div>
                     <table>
                        <tr class="border-wht">
                           <td>{{__('New')}}</td>
                           <td>{{__('In Progress')}}</td>
                           <td>{{__('Closed')}}</td>
                        </tr>
                        <tr>
                           <td>{{ $shop->quotation_quotation_total }}</td>
                           <td>{{ $shop->quotation_process_total }}</td>
                           <td>{{ $shop->quotation_close_total }}</td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="shop-block">
                     <div class="ttl">Orders</div>
                     <table>
                        <tr class="border-wht">
                           <td>{{__('New')}}</td>
                           <td>{{__('In Progress')}}</td>
                           <td>{{__('Closed')}}</td>
                        </tr>
                        <tr>
                           <td>{{ $shop->quotation_process_total }}</td>
                           <td>{{ $shop->close_order_pick_up_total }}</td>
                           <td>{{ $shop->close_order_delivery_total }}</td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="shop-block">
                     <div class="ttl">{{__('Closed Orders')}}</div>
                     <table>
                        <tr class="border-wht">
                           <td>{{__('Pickup')}}</td>
                           <td>{{__('Delivery')}}</td>
                        </tr>
                        <tr>
                           <td>{{ $shop->close_order_pick_up_total }}</td>
                           <td>{{ $shop->close_order_delivery_total }}</td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="shop-block">
                     <div class="ttl">Products</div>
                     <table cellspacing="2">
                        <tr class="border-wht">
                           <td>{{__('Active')}}</td>
                           <td>{{__('On Sale')}}</td>
                        </tr>
                        <tr>
                           <td>{{ $shop->active_sale_total }}</td>
                           <td>{{ $shop->on_sale_total }}</td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
    @empty
    <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
               <div class="row">
                   <p class="text-center">{{__('No Records Found.')}}</p>
                </div>
            </div>
        </div>
    </div>
        @endforelse
   </div>
</section>
<!-- Section 2 -->
<!-- <section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-6">
                     <div class="title">Select Machines</div>
                  </div>
                  <div class="col-md-6">
                     <div class="select-all">
                        <input type="checkbox">
                        <label>Select all</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="table-repsponsive th-auto">
                     <table class="table">
                        <thead>
                           <tr>
                              <th></th>
                              <th>Product Name</th>
                              <th>Price</th>
                           </tr>
                        </thead>
                        <tbody class="max-height600">
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <div class="product-name-image">
                                    <img src="images/product-image.png" alt=""> <span class="name">Philips 125W HPI</span>
                                 </div>
                              </td>
                              <td>
                                 <div class="price-blk">
                                    <label>AED</label>
                                    <input type="text" value="25.56">
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section> -->
@endsection