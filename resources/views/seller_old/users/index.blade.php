@extends('layouts.vendor')
@section('title', __('Users'))
@section('pageheading')
Manage {{ ($type ?? '') === 'user' ? __('Subscribers'):__('Users') }}
@endsection
@section('content')
<?php
   $full_url = url()->full(); 
   ?>
<div class="container-fluid">
  
</div>
@if(request()->type=="seller")
<div class="row mb-3">
   <div class="col-lg-12">
      <form class="row" method="get">
         <div class="col-lg-6">
            <div class="form-group">
               {{-- <input type="hidden" name="type" value="seller"> --}}
               <a href="{{route('admin.users.seller_create')}}" class="btn-sm btn-info">{{__('Add new vendor')}}</a>
            </div>
         </div>
      </form>
   </div>
</div>
@endif
 {{-- date filter --}}
   <div class="my-2">
      <form action="{{route('seller.users.index')}}" method="get" class="my-2">
         <h4 class="text-bold">{{__('Filter based on dates:')}} </h4>
         <div class="row align-items-center">
            <div class="col-12 col-sm-4 form-group">
               <label for="">{{__('FROM')}}</label>
               <input type="date" class="form-control " name="start_date"
                  value="{{ request()->query('start_date') }}" >
            </div>
            <div class="col-12 col-sm-4 form-group">
               <label for="">{{__('TO')}}</label>
               <input type="date" class="form-control " name="end_date"
                  value="{{ request()->query('end_date') }}" >
            </div>
            <div class="col">
               <button class="btn btn-primary" style="margin-top:13px">{{__('Filter')}}</button>
            </div>
         </div>
      </form>
   </div>
   <div class="my-2">
      <form action="" class="my-2">
         <h4 class="text-bold">{{__('Search content')}} </h4>
         <div class="row align-items-center">
            <div class="col-12 col-sm-4 form-group">
               <input type="text" name="q" placeholder="Find or Search Users...!" class="form-control " 
                  value="{{ request()->query('q') }}" >
               @if($full_url == URL::to('seller/users?type=seller'))
               <input type="hidden" name="type" id="" value="seller">
               
               @else
               @endif
            </div>
            <div class="col">
               <button class="btn btn-primary" style="margin-bottom:18px">{{__('Search')}}</button>
            </div>
         </div>
      </form>
   </div>
   {{-- <button class="btn btn-primary backBTN" style="margin-bottom: 18px;">{{__('Back')}}</button> --}}
<div class="row">
   <div class="col-lg-12">
      <div class="table-responsive">
         <table id="dataTable" class="display table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{__('Name')}}</th>
                  <th>{{__('RoleName')}}</th>
                  <th>{{__('Email')}}</th>
                  <th>{{__('Status')}}</th>
                  <th>{{__('Created')}}</th>
                  <th>{{__('Actions')}}</th>
               </tr>
            </thead>
            <tbody>
               @if ($users->count())
               @foreach ($users as $user)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                     <div>{{ $user->name }}</div>
                  </td>
                  <td>
                     <div class="badge badge-primary">
                        {{ $user->role }}
                     </div>
                  </td>
                  <td>{{ $user->email }}</td>
                  <td>
                     <div>
                        <form method="post"
                           action="{{ route('admin.users.update', ['user' => $user]) }}"
                           onsubmit="return confirm('Are you sure to change the status?');">
                           @csrf
                           @method('put')
                           
                           @if($user->role == "seller" )
                           <input type="hidden" name="change_seller_status">
                           <input type="hidden" name="time" id="time" value="">
                         
                           @endif
                           {{-- change status modal --}}
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal">
                           Change Status
                           </button>
                           <!-- Modal -->
                           <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       @if (is_null($user->deactivated_till))
                                       <span class="badge badge-success">
                                       {{ __('Activate')}}
                                       </span>
                                       @if($user->role == "customer" || $user->role=="seller")
                                       (
                                       <div class="dropdown" style="margin:-23px 0px 0px 68px">
                                          {{__('Deactivate')}}
                                          <select  onchange="$(this).closest('form').submit();" name="time" id="time">
                                             <option value="">{{ __('Select')}}</option>
                                             <option value="24">{{ __('24')}}</option>
                                             <option value="48">{{ __('48')}}</option>
                                             <option value="0">{{ __('Permanent')}}</option>
                                          </select>
                                          )
                                          @else
                                          ( <a href="javascript:;"
                                             onclick="$(this).closest('form').submit();"class="status_deactivate"> {{__('Deactivate')}}</a> )
                                          @endif
                                          @else
                                          <span class="badge badge-danger">
                                          {{ __('DeActivate')}}
                                          </span>
                                          (  <a href="javascript:;"
                                             onclick="$(this).closest('form').submit();" class="dropbtn status_activate">{{__('Activate')}}</a> )
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           {{-- end --}}
                        </form>
                     </div>
                     @if ( $user->role=="seller")
                     <div>
                        @if (is_null($user->deactivated_till))
                        (<span class="text-xs text-success font-weight-bold">{{ __('Active') }}</span>)
                        @else
                        (<span
                           class="text-xs text-danger font-weight-bold">{{ __('DeActive') }}</span>)
                        @endif
                     </div>
                     @endif
                     @if ($user->role=="seller")
                     <div>
                        @if (is_null($user->seller_verified))
                        <span class="text-xs text-warning font-weight-bold">{{ __('Not
                        Verified')}}</span>
                        @elseif ($user->seller_verified=="1")
                        <span
                           class="text-xs text-success font-weight-bold">{{ __('Approved') }}</span>
                        @else
                        <span
                           class="text-xs text-danger font-weight-bold">{{ __('DisApproved') }}</span>
                        @endif
                     </div>
                     @endif
                  </td>
                  <td>{{ $user->created_at->format('d/m/Y') }}</td>
                  <td>
                     @if($user->role == "seller")
                     <div class="btn-group">
                        <a href="{{ route('admin.users.edit', ['user' => $user, 'type' => $user->role]) }}"
                           class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i>
                        Edit
                        </a>
                        <a href="{{ route('admin.users.show', ['user' => $user,'type' => $user->role]) }}" class="btn btn-xs btn-warning ml-2"><i class="fas fa-eye"></i>Show</a>
                     </div>
                     @endif
                    
                     
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
         {{ $users->links() }}
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
   $("#time1").click(function(){
       // alert($('#time1').text())
       $("#time").val($('#time1').text());
   });
      $("#time2").click(function(){
      // alert($('#time2').text())
      $("#time").val($('#time2').text());
   });
      $("#time3").click(function(){
      $("#time").val($('#time3').text());
   });
   });
</script>
@stop