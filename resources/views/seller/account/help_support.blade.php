@extends('seller.layouts.vendor')
@section('title', 'Help & Support')
@section('pageheading')
{{__('Help & Support')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
                
               <div class="row">
                  <div class="col-md-6 col-lg-5">
                     <div class="title">{{__('Accounts')}}</div>
                  </div>
                  <!-- <div class="col-md-6 col-lg-7 text-md-end">
                     <a class="title underline">Manage Shop</a>
                     </div> -->
               </div>
            </div>
                  
            
            <form id="help_and_support_store" action="{{ route('seller.help_and_support_store') }}" method="post" enctype="multipart/form-data">
               @csrf
               
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Name')}} :</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" name="name" placeholder="Will Saunders" value="{{ old('name',isset(auth()->user()->name) ? auth()->user()->name : '' ) }}">
                  </div>
                  @error('name')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Email')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" placeholder="willsaunders@gmail.com" name="email" value="{{ old('email',isset(auth()->user()->email) ? auth()->user()->email : '' ) }}">
                  </div>
                  @error('email')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>

               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Message')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <textarea type="text" class="form-control" placeholder="Message" name="message" value="{{ old('message') }}"></textarea>
                  </div>
                  @error('message')
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
@endsection