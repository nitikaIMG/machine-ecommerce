@extends('layouts.admin')
@section('title', __('Orders'))
@section('pageheading')
{{ __('Manage Orders') }}
@endsection
@section('content')
<?php
$full_url = url()->full(); 
?>
<div class="container-fluid">
  
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="table-responsive">
         <table id="dataTable" class="display table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{__('Order number')}}</th>
                  <th>{{__('Cart')}}</th>
                  <th>{{__('User name')}}</th>
                  <th>{{__('User email')}}</th>
                  <th>{{__('Created at')}}</th>
                  <th>{{__('Actions')}}</th>
               </tr>
            </thead>
            <tbody>
               @if ($orders->count() > 0)
               @foreach ($orders as $order)
               <tr>
                  <td>{{ $loop->iteration }}</td>
               
                  <td>
                     {{$order->order_no}}
                  </td>
                  <td>
                     {{$order->cart_id}}
                  </td>
                  <td>

                     {{$order->user->name ?? 'NA' }}
                  </td>
                  <td>{{$order->user->email ?? 'NA'}}</td>
                  @if(!empty($order->created_at))
                  <td>{{$order->created_at->format('Y/m/d') }}</td>
                  @else
                  <td>{{'NA'}}</td>
                  @endif
                  <td>
                     <a href="{{ route('admin.order.show',$order->id) }}" class="btn btn-xs btn-warning ml-2"><i class="fas fa-eye"></i>{{ __('Show')}}</a>
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