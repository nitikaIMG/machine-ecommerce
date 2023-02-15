@extends('seller.layouts.vendor')
@section('title', 'Manage Shop')
@section('pageheading')
{{__('Manage Shop')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-6 col-lg-5">
                     <div class="title">{{ __('Edit product') }}</div>
                  </div>
                  <!-- <div class="col-md-6 col-lg-7 text-md-end">
                     <a class="title underline">Manage Shop</a>
                     </div> -->
               </div>
            </div>
 @if (session('success'))
                                            <span style="color:green">{{ session('success') }}</span>
                                        @else
                                            <span style="color:red">{{ session('error') }}</span>
                                        @endif
            <form  action="{{ route('seller.product.update', ['us_product' => $product->id]) }}"
                    method="post"  enctype="multipart/form-data">
                    @csrf
                   
                   @method('PATCH')

                   <input type="hidden" name="product_id" value="{{$product->id}}">
                   <input type="hidden" name="category" value="{{$cat}}">

                   <input type="hidden" name="seller_id" value="{{Auth()->user()->id ?? null}}">

               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Title')}} :</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" name="title" placeholder="Title" value="{{$product->title ?? 'N/A'}}">
                  </div>
                  @error('title')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Description')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" placeholder="Description" name="description" value="{{$product->description ?? 'N/A'}}">
                  </div>
                  @error('description')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Price type')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="input-group mb-3">
                        
                        <select class="form-control" name="price_type" id="price_type">
                            <option value="fixed" {{ $product->price_type == 'fixed' ? 'selected' : '' }}>
                                {{ __('Fixed') }}</option>
                            <option value="bid" {{ $product->price_type == 'bid' ? 'selected' : '' }}>{{ __('Bid') }}
                            </option>
                        </select>
                        @error('price_type')
                        <span style="color:red">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Fixed price')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="pic-wrap">
                        <input type="text" class="form-control" name="fixed_price" id="fixed_price"
                            value="{{ $product->fixed_price }}">
                        @error('fixed_price')
                        <span style="color:red">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
               </div>

               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Shop')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="pic-wrap">
                        <select class="form-control" name="shops" id="shops">
                            @foreach ($shop_datas as $shops)
                            <option value="{{$shops->id}}">{{$shops->shop_name}}</option>
                            @endforeach
                           
                        </select> 
                        @error('shops')
                        <span style="color:red">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Quantity')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="pic-wrap">
                        <input type="text" class="form-control" name="quantity" id="quantity">
                        @error('quantity')
                        <span style="color:red">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Shop')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="pic-wrap">
                        <input type="checkbox" name="status" id="status" value="1" {{ $product->status ? 'checked' : '' }}>
                        <label for="status">{{ __('Status') }}</label>
                        
                     </div>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label"></label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <button  class="btn btn-primary">{{__('Save')}}</button>
                     <a href="" class="btn btn-warning">{{__('Cancel')}}</a>
                  </div>
               </div>
            </form>
            <!-- <div class="row form-group">
               <div class="col-md-6 col-lg-3">
                   <label for="" class="label"></label>
               </div>
               <div class="col-md-6 col-lg-6">
                   <a href="" class="social fa fa-facebook"></a>
                   <a href="" class="social fa fa-linkedin"></a>
                   <a href="" class="social fa fa-instagram"></a>
               </div>
               </div> -->
         </div>
      </div>
   </div>
</section>
@endsection