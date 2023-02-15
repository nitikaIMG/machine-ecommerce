@extends('layouts.admin')
@section('title', __('Show'))
@section('pageheading')
Users: {{ $user->email }}
@endsection
@section('content')
<div class="page-content read container-fluid">
   @if($user->role == "customer")
   <div class="row">
      <div class="col-md-12">
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Role') }}</h4>
               <h6 class="card-subtitle">{{ \ucwords($user->role) ?? 'NA'  }}</h6>
            </div>
         </div>
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">
                  #{{ $user->id ?? 'NA' }}
                  {{ $user->name  ?? 'NA' }}
                  @if ($user->verified)
                  <i class="fas fa-check-circle text-success"></i>
                  <small>E-mail Verified</small>
                  @else
                  <i class="fas fa-times-circle text-danger"></i>
                  <small>E-mail Not Verified</small>
                  @endif
               </h4>
               <h6 class="card-subtitle text-muted">{{ $user->email ?? 'NA'  }}</h6>
            </div>
         </div>
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Phone') }}</h4>
               <h6 class="card-subtitle">{{ $user->phone ?? 'NA' }}</h6>
            </div>
         </div>
         
      </div>
   </div>
   @else
    <div class="row">
      <div class="col-md-12">
          <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Role') }}</h4>
               <h6 class="card-subtitle">{{ \ucwords($user->role) ?? 'NA'  }}</h6>
            </div>
         </div>
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">
                  #{{ $user->id }}
                  {{ $user->name  }}
                  @if ($user->verified)
                  <i class="fas fa-check-circle text-success"></i>
                  <small>E-mail Verified</small>
                  @else
                  <i class="fas fa-times-circle text-danger"></i>
                  <small>E-mail Not Verified</small>
                  @endif
               </h4>
               <h6 class="card-subtitle text-muted">{{ $user->email ?? 'NA' }}</h6>
            </div>
         </div>
       

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Phone') }}</h4>
               <h6 class="card-subtitle">{{ $user->phone ?? 'NA'  }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Registration number') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->user_shop->registration_no ?? 'NA'  }}</h6>
            </div>
         </div>

         @if(!empty($user->image))
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Id') }}</h4>
               <img src="{{asset("storage/{$user->image}")}}" style="max-height: 125px; max-width:450px ;">
            </div>
         </div>
         @endif

         @if(count($user_company_photos) > 0)
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Shop images') }}</h4>
               @foreach($user_company_photos as $shop)
                  <img src="{{asset("storage/{$shop->photo}")}}" style="max-height: 125px; max-width:450px ;">
               @endforeach
            </div>
         </div>
         @endif

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Address line 1') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->user_shop->address_1 ?? 'NA' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Address line 2') }}</h4>
               <h6 class="card-subtitle">{{ $user_shop->user_shop->address_2 ?? 'NA'  }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Country') }}</h4>
               <h6 class="card-subtitle">{{ $user->country ?? 'NA'  }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('State') }}</h4>
               <h6 class="card-subtitle">{{ $user->state ?? 'NA' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('City') }}</h4>
               <h6 class="card-subtitle">{{ $user->city ?? 'NA' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Product categories') }}</h4>
               @foreach ($categories as $category) 
               <?php if(in_array($category->id,$catArray)){?>          
               <h6 class="card-subtitle">{{ $category->title ?? 'NA' }}</h6><hr>
               <?php } ?>
               @endforeach
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Working hours from') }}</h4>          
               <h6 class="card-subtitle">{{ $user_shop->user_shop->working_hours_from ?? 'NA' }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Working hours to') }}</h4>         
               <h6 class="card-subtitle">{{ $user_shop->user_shop->working_hours_to ?? 'NA' }}</h6>
            </div>
         </div>

         
        
      </div>
   </div>
   @endif
</div>
@endsection