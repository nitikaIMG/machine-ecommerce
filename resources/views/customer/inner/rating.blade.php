@extends('customer.layouts.main')

@push('custom_css')
@endpush
@section('content')
<style>
    .rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
    </style>
    <section class="main-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('customer.inner.leftmenu')
                </div>
                <div class="col-md-12 col-lg-9">
                <section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
                
               <div class="row">
                  <div class="col-md-6 col-lg-5">
                     <div class="title">{{__('Rating Shop')}}</div>
                  </div>
                  <!-- <div class="col-md-6 col-lg-7 text-md-end">
                     <a class="title underline">Manage Shop</a>
                     </div> -->
               </div>
            </div>
                  
            
            <form id="help_and_support_store" action="{{ route('shop.rating') }}" method="post" enctype="multipart/form-data">
               @csrf

               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Rating')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6 " >
<div class="rate" style="float:left">
                  <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
                  </div>
                  </div>
                  @error('email')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Review')}} :</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                  <input type="hidden" id="star1" name="seller_id" value="{{ $seller_id }}" />
                  <input type="hidden" id="star1" name="shop_id" value="{{ $shop_id }}" />
                     <textarea type="text" class="form-control" name="review" placeholder="" value="{{ old('name',isset(auth()->user()->name) ? auth()->user()->name : '' ) }}"></textarea>
                  </div>
                  @error('name')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
              

            
              
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label"></label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <button  class="btn btn-primary">{{__('Save')}}</button>
                     @if (session('success'))
                        <span style="color:green">{{ session('success') }}</span>
                    @else
                        <span style="color:red">{{ session('error') }}</span>
                    @endif
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
                </div>
            </div>
        </div>

        </div>
        </div>
        </div>
        </div>
       
    </section>
@endsection

