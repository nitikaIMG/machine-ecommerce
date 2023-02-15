@extends('layouts.admin')
@section('title', __('Users'))
@section('pageheading')
{{__('Manage complaints')}}
@endsection
@section('content')
<?php
   $full_url = url()->full(); 
   ?>
<div class="container-fluid">
  
</div>
{{-- @if (request()->status == 0)

@elseif(request()->status==1)

@elseif(request()->status==2)


@endif --}}
<div class="row">
   <div class="col-lg-12">
      <div class="table-responsive">
         <table id="dataTable" class="display table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{__('Name')}}</th>
                  <th>{{__('Email')}}</th>
                  <th>{{__('Resolution status')}}</th>
                  <th>{{__('Created')}}</th>
                  <th>{{__('Actions')}}</th>
               </tr>
            </thead>
            <tbody>
               @if ($complaints->count())
               <?php
               $complaints = $complaints->where('status',request()->status);
               ?>
               @foreach ($complaints as $complaint)
               <?php
               $user_datas = \App\Models\User::where('id',$complaint->user_id)->first();
               ?>
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                     <div>{{ $user_datas->name ?? 'N/A'}}</div>
                  </td>
                  <td>
                     <div>{{ $user_datas->email ?? 'N/A' }}</div>
                  </td>
                  <td>
                     @if($complaint->status == 0)
                     <span class="badge badge-danger">
                     {{ __('pending')}}
                     </span>
                     @elseif($complaint->status == 1)
                     <span class="badge badge-warning">
                     {{ __('in progress')}}
                     @elseif($complaint->status == 2)
                     <span class="badge badge-success">
                     {{ __('completed')}}
                     @endif

                    
                  </td>
                
                  <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                  <td>
                     <div class="btn-group">
                        @if(request()->status == 0 || request()->status == 1)
                        <a href="{{ route('admin.complaints.edit', ['complaint'=>$complaint->id,'user' => $complaint->user_id]) }}"
                           class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i>
                        Edit
                        </a>
                        @endif
                        <a href="{{ route('admin.complaints.show', ['complaint'=>$complaint->id]) }}" class="btn btn-xs btn-warning ml-2"><i class="fas fa-eye"></i>Show</a>
                     </div>
                  </td>
               </tr>
               @endforeach
               
               @endif
            </tbody>
         </table>
      </div>
   </div>
</div>

@endsection
@section('scripts')
<script>
   $(document).ready(function() {
            $('#dataTable').DataTable();
   });
</script>
@stop