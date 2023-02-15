@extends('layouts.vendor')
@section('title', __('Show'))
@section('pageheading')
Seller: {{ $user->email }}
@endsection
@section('content')
<div class="page-content read container-fluid">
   
    <div class="row">
      <div class="col-md-12">
         <!-- <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Role') }}</h4>
               <h6 class="card-subtitle">{{ \ucwords($user->role) }}</h6>
            </div>
         </div> -->

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">
                  #{{ $user->id }}
                  {{ $user_shop->shop_name  ?? '' }}
               </h4>
               <h6 class="card-subtitle text-muted">{{ $user->shop_email ?? '' }}</h6>
            </div>
         </div>
       
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Shop owner') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->shop_owner ?? '' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Shop name') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->shop_name ?? '' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Phone') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->shop_contact ?? '' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Registration number') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->registration_no ?? '' }}</h6>
            </div>
         </div>

         @if(!empty($user_shop->id_document))
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Document id') }}</h4>
               <img src="{{asset("storage/{$user_shop->id_document}")}}" style="max-height: 125px; max-width:450px ;">
            </div>
         </div>
         @endif

       

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Address line 1') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->address_1 ?? '' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Address line 2') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->address_2 ?? '' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Country') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->country ?? ''}}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('State') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->state ?? '' }}</h6>
            </div>
         </div>


         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Working hours from') }}</h4>          
               <h6 class="card-subtitle">{{ $user_shop->working_hours_from ?? '' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Working hours to') }}</h4>         
               <h6 class="card-subtitle">{{ $user_shop->working_hours_to ?? ''}}</h6>
            </div>
         </div>

         
        
      </div>
   </div>

</div>
@endsection