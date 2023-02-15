@extends('layouts.admin')
@section('title', __('Dashboard'))
@section('pageheading')
{{ __('Dashboard') }}
@endsection
@section('content')
<div class="container-fluid">
   {{-- @include('admin.index._filters') --}}
   <!-- Small boxes (Stat box) -->
   <div class="row">
      <div class="col-lg-3 col-6">
         <!-- small box -->
         <div class="small-box bg-info">
            <div class="inner">
               <h3>{{ $total->users }}</h3>
               <p>{{ __('Total Customer') }}</p>
            </div>
            <div class="icon">
               <i class="fas fa-users"></i>
            </div>
            {{-- @can('manage users') --}}
            <a href="{{ route('admin.users.index', ['type' => "customer"]) }}"
            class="small-box-footer">{{ __('More info') }}  <i class="fas fa-arrow-circle-right"></i></a>
            {{-- @endcan --}}
         </div>
      </div>
      
      <div class="col-lg-3 col-6">
         <!-- small box -->
         <div class="small-box bg-info">
            <div class="inner">
               <h3>{{ $total->sellers }}</h3>
               <p>{{ __('Vendor users') }} </p>
            </div>
            <div class="icon">
               <i class="fas fa-users"></i>
            </div>
            {{-- @can('manage users') --}}
            <a href="{{ route('admin.users.index', ['type' => "seller"]) }}"
            class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
            {{-- @endcan --}}
         </div>
      </div>

      <div class="col-lg-3 col-6">
         <!-- small box -->
         <div class="small-box bg-info">
            <div class="inner">
               <h3>{{ $total->products }}</h3>
               <p>{{__('Products')}}</p>
            </div>
            <div class="icon">
               <i class="fas fa-users"></i>
            </div>
            {{-- @can('manage users') --}}
            <a href="{{ route('admin.product.index') }}"
            class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            {{-- @endcan --}}
         </div>
      </div>
   </div>
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection