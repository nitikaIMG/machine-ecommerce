@extends('customer.layouts.main')

@push('custom_css')
@endpush

@section('content')
      <!-- Main Section -->
      <section class="main-wraper">
        <div class="container">
            <div class="row">
              <form action="{{ route('submit_quotation') }}" method="POST">
                @csrf
                <div class="col-md-12 col-lg-12">
                <section class="center-wraper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p30" id="myTab">
                                <div class="row">
                                            <div class="col-md-12">
                                                <div class="title">Cart List</div>
                                            </div>
                                        </div>
                @if (session('success'))
                        <span style="color:green">{{ session('success') }}</span>
                    @else
                        <span style="color:red">{{ session('error') }}</span>
                    @endif
</div>
</div>
</div>
</section>
                @if(!empty($data["primary_address"] && $data["items"]))
                    <section class="center-wraper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p30" id="myTab">
                                    <div class="header">
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="title">Deliver To</div>
                                            </div>
                                        </div>
                                       
                                        <div class="row border-bottom pb-4">
                                            <div class="col-md-8">
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="electrical-item-content">
                                    
                                                        <div class="electrical-item-subtitle">
                                                            
                                                         <div class="products-name mt-2">
                                                         <input type="checkbox" name="delivery_type" value="delivery"> Delivery  <input type="checkbox" name="delivery_type" value="pick-up"> Pick Up
                                                        </div>
                                                       
                                                    </div>
                                                  </div>
                                                  <div class="col-md-12">
                                                    <div class="electrical-item-content">
                                    
                                                        <div class="electrical-item-subtitle">
                                                            
                                                         <div class="products-name mt-2">
                                                         <input type="hidden" name="address_id" value='{{$data["primary_address"]["id"] }}' >
                                                              <div class="current-type mt-2">Primary Address : {{ $data["primary_address"]["name"] }}, {{ $data["primary_address"]["address_1"] }}    </div>
                                                              <a href="{{ route('settings') }}">Change Address</a>
                                                        </div>
                                                       
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                    @endif                       <!-- Main Section -->
   
                    <section class="center-wraper">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card p30" id="myTab">
                                    <div class="header">
                                     @if(!empty($data["items"]))
                                     <div class="row">
                                            <div class="col-md-12">
                                                <div class="title">Product List</div>
                                            </div>
                                        </div>
                                        @foreach($data["items"] as $item)

                                        <div class="row border-bottom pb-4">
                                            <div class="col-md-8">
                                                <div class="row">
                                                  <div class="col-md-3">
                                                    <div class="electrical-item-small whitebg-border-box">
                                                        <a href="">
                                                           <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="img-fluid">
                                                          </a>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <div class="electrical-item-content">
                                    
                                                        <div class="electrical-item-subtitle">
                                                            
                                                         <div class="products-name mt-2">
                                                            <a href="" class="anchor-link">
                                                            {{ $item["title"] }} </a></div>
                                                              <div class="current-type mt-2">{{ $item["currency"] }} <strong>{{ $item["price"] }}</strong> </div>
                                                        </div>
                                                        
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="count-wrapper mt-4">
                                                <input type="hidden" name="items['product_id'][]" value="{{ $item['id'] }}" >
                                                @if($item['price_type']=='bid')
                                                
                                                <input type="text" name="items['bid'][]" placeholder="Bid Amount" required>
                                                </br>
                                                @else
                                                <input type="hidden" name="items['bid'][]" value="{{ $item['price'] }}" >
                                                @endif
                                                <form action="" method="POST" >
                                                    @csrf
                                                   
                                                    <a href="{{ route('remove_from_cart',$item['id']) }}" class="btn btn-blank minus-icon">
                                                    <i class="fa fa-minus"></i>
                                                        </a>    
                                                    
                                                
                                                    <input type="text" value="{{ $item['quantity'] }}" placeholder="1" class="countnum">
                                                    
                                                    <a href="{{ route('add_to_cart', $item['id']) }}" class="btn btn-blank delete-icon">
                                                        <i class="fa fa-plus"></i>
                                                    </a> 
                                                   
                                                    
                                                  
                                                    <a href="{{ route('delete_from_cart',$item['id']) }}" class=" btn btn-blank delete-icon">
                                                        <i class="fa fa-trash"></i>
                                                    </a>    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="row">
                                            <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="title"> {{ $data["cart_items"] }} Item </div>
                                                <div class="product-price-blue">
                                                {{ $data["currency"] }} {{ $data["total_sum"] }}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{ route('chat.index') }}" class="blue-common-btn custom-btn pull-right text-white">Chat
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="blue-common-btn custom-btn pull-right text-white">Send A Quote
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                       <center>
                                        <h4 style="color:#0eb0da;"> <ul>Please Add Product...! </ul></h4>
                                        <center>
                                    @endif
                                       

                                    </div>
                                
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
              </form>
            </div>
        </div>
    </section>
@endsection
