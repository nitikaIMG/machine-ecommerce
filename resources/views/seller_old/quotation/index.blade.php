@extends('layouts.vendor')
@section('title', __('Quotations'))
@section('pageheading')
{{__('Quotations')}}
@endsection
@section('content')
<?php
   $full_url = url()->full(); 
   ?>
<div class="container-fluid">
  
</div>
<div class="row mb-3">
   <div class="col-lg-12">
    
   </div>
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="table-responsive">
         <table id="dataTable" class="display table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{__('Order number')}}</th>
                  <th>{{__('Seller name')}}</th>
                  <th>{{__('Seller email')}}</th>
                  <th>{{__('Shop name')}}</th>
                  <th>{{__('Status')}}</th>
                  <th>{{__('Actions')}}</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($quotations as $quotation)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                     <div>{{ $quotation->order['order_no'] ?? 'NA' }}</div>
                  </td>
                  <td>
                     <div>{{ $quotation->seller['name'] ?? 'NA' }}</div>
                  </td>
                   <td>
                     <div>{{ $quotation->seller['email'] ?? 'NA' }}</div>
                  </td>
                  <td>
                     <div>{{ $quotation->usershop['shop_name'] ?? 'NA' }}</div>
                  </td>
                  <td>
                     <div>{{ $quotation->status ?? 'NA' }}</div>
                  </td>
                  <td>
                     <a href="{{ route('seller.quotations.show',$quotation->id) }}" class="btn btn-xs btn-warning ml-2"><i class="fas fa-eye"></i>{{ __('Show')}}</a>
                  </td>
            
                 
               </tr>
               @endforeach
              
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