@extends('layouts.admin')

@section('title', __('System users'))
@section('pageheading')
{{ __('System users') }}
@endsection

@section('content')
<div class="container-fluid">
   <div class="row mb-3">
      <div class="col-lg-12">
         <div class="col-lg-6">
            <div class="form-group">
               <a href="{{route('admin.users.createsystemuser')}}" class="btn-sm btn-info">{{ __('Add new system user') }}</a>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="table-responsive">
            <table id="dataTable" class="display table table-striped" style="width:100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>{{ __('Name') }}</th>
                     <th>{{ __('RoleName') }}</th>
                     <th>{{ __('Email') }}</th>
                     <th>{{ __('Status') }}</th>
                     <th>{{ __('Actions') }}</th>
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
                           {{ __('System users') }}
                        </div>
                     </td>
                     <td>{{ $user->email }}</td>
                     <td>
                        {{-- @if ($user->status == "1")
                        <div class="badge badge-success">
                           active
                        </div>
                        @else
                        <div class="badge badge-secondary">
                           blocked
                        </div>
                        @endif --}}
                        <form method="post"
                           action="{{ route('admin.users.update', ['user' => $user]) }}"
                           onsubmit="return confirm('Are you sure to change the status?');">
                           @csrf
                           @method('put')
                           <input type="hidden" name="change_admin_status">

                           {{-- change status modal --}}
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal">
                           {{__('Change status')}}
                           </button>
                           <!-- Modal -->
                           <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">{{__('Change status')}}</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       @if ($user->status)
                                       <span class="badge badge-success">
                                       {{ __('Activate') }}
                                       </span>
                                       ( <a href="javascript:;"
                                          onclick="$(this).closest('form').submit();"class="status_deactivate">{{ __('Deactivate') }}</a> )
                                       @else
                                       <span class="badge badge-danger">
                                       {{ __('DeActivate') }}
                                       </span>
                                       ( <a href="javascript:;"
                                          onclick="$(this).closest('form').submit();" class="status_activate">{{ __('Activate') }}</a> )
                                       @endif
                                    </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           {{-- end --}}
                           @if ($user->role=="admin")
                           <div>
                              @if ($user->status == 1)
                              (<span class="text-xs text-success font-weight-bold">{{ __('Active') }}</span>)
                              @else
                              (<span
                                 class="text-xs text-danger font-weight-bold">{{ __('DeActive') }}</span>)
                              @endif
                           </div>
                           @endif

                          
                        </form>
                     </td>
                     <td>
                        <div class="btn-group">
                           <a href="{{ route('admin.users.edit', ['user' => $user, 'type' => $user->type]) }}"
                              class="btn btn-xs btn-primary">
                           <i class="fas fa-pencil-alt"></i>
                             {{ __('Edit') }}
                           </a>
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
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
       $('#dataTable').DataTable();
   });
</script>
@stop