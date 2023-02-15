@extends('layouts.vendor')
@section('title', __('Users'))
@section('pageheading')
{{__('Manage shops')}}
@endsection
@section('content')
<?php
   $full_url = url()->full(); 
   ?>
<div class="container-fluid">
  
</div>
<div class="row mb-3">
   <div class="col-lg-12">
      <form class="row" method="get">
         <div class="col-lg-6">
            <div class="form-group">
               {{-- <input type="hidden" name="type" value="customer"> --}}
               <a href="{{route('seller.shops.create')}}" class="btn-sm btn-info">{{__('Add new shop')}} </a>
            </div>
         </div>
      </form>
   </div>
</div>


   
<div class="row">
   <div class="col-lg-12">
      <div class="table-responsive">
         <table id="dataTable" class="display table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{__('Owner Name')}}</th>
                  <th>{{__('Shop name')}}</th>
                  <th>{{__('Shop email')}}</th>
                  <th>{{__('Shop contact')}}</th>
                  <th>{{__('Shop registration no')}}</th>
                  <th>{{__('Country')}}</th>
                  <th>{{__('State')}}</th>
                  <th>{{__('Actions')}}</th>
               </tr>
            </thead>
            <tbody>
               @if ($user_shops->count())
               @foreach ($user_shops as $shops)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                     <div>{{ $shops->shop_owner ?? 'NA' }}</div>
                  </td>
                  <td>
                     <div>{{ $shops->shop_name }}</div>
                  </td>
                  <td>
                     <div>{{ $shops->shop_email }}</div>
                  </td>
                  <td>{{ $shops->shop_contact ?? 'NA' }}</td>
                  <td>{{ $shops->registration_no ?? 'NA' }}</td>
                  <td>{{ $shops->country ?? 'NA' }}</td>
                  <td>{{ $shops->state ?? 'NA' }}</td>
                  <td>
                     <div class="d-flex">
                       <a href="{{ route('seller.shops.edit',[$shops->id,$user]) }}"
                           class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i>
                        {{ __('Edit')}}
                        </a>

                        <a href="{{ route('seller.shops.show', [$shops->id,$user]) }}" class="btn btn-xs btn-warning ml-2"><i class="fas fa-eye"></i>{{ __('Show')}}</a>

                        <form onsubmit="return confirm('{{__('Are you sure?')}}');" action="{{ route('seller.shops.destroy',[$shops->id,$user]) }}" method="post">
                           @method("DELETE")
                           @csrf
                           <button type="submit" class="btn btn-primary ml-1">
                               <i class="fas fa-trash"></i>
                               {{__("Delete")}}
                           </button>
                       </form>
                   </div>
                   
                  </td>
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
<!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')
<script type="text/javascript">
   $(function(){
   $('#dataTable').DataTable();
   });
</script>
@stop