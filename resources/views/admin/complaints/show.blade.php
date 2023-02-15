@extends('layouts.admin')
@section('title', __('Show'))
@section('pageheading')
Users: {{ $show_user->email }}
@endsection
@section('content')
<div class="page-content read container-fluid">
 
    <div class="row">
      <div class="col-md-12">
          <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Name') }}</h4>
               <h6 class="card-subtitle">{{ \ucwords($show_user->name) }}</h6>
            </div>
         </div>
         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">
                  #{{ $show_user->id }}
                  {{ $show_user->name  }}
                  @if ($show_user->verified)
                  <i class="fas fa-check-circle text-success"></i>
                  <small>E-mail Verified</small>
                  @else
                  <i class="fas fa-times-circle text-danger"></i>
                  <small>E-mail Not Verified</small>
                  @endif
               </h4>
               <h6 class="card-subtitle text-muted">{{ $show_user->email }}</h6>
            </div>
         </div>
       
        <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Complaint subject') }}</h4>
               <h6 class="card-subtitle">{{ $comp_user->subject }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Complaint description') }}</h4>
               <h6 class="card-subtitle">{{ $comp_user->description }}</h6>
            </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
               <h4 class="card-title w-100 text-bold mb-2">{{ __('Complaint status') }}</h4>
               @if($comp_user->status == 0)
               <h6 class="card-subtitle btn-danger">{{__('pending')}}</h6>
               @elseif($comp_user->status == 1)
               <h6 class="card-subtitle btn-warning">{{__('in progress')}}</h6>
               @elseif($comp_user->status == 2)
               <h6 class="card-subtitle btn-success">{{__('completed')}}</h6>
               @endif
            </div>
         </div>
         
        
      </div>
   </div>

</div>
@endsection