@extends('layouts.admin')
@section('title', __('Edit complaint'))
@section('pageheading')
{{ __('Edit complaint') }}
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{ __('Edit complaint') }}</h3>
            </div>
            <form action="{{ route('admin.complaints.update', ['complaint' => $edit_comp->id,'user'=>$edit_comp->user_id]) }}" method="post" enctype="multipart/form-data">
               @csrf

               <input type="hidden" name="user_id" value="{{$edit_comp->user_id}}">
               
               <div class="card-body row">
                  <div class="form-group col-6">
                     <label for="name">{{ __('Name') }}</label>
                     <input type="text" class=" form-control col-12 @error('name') is-invalid @enderror" placeholder="Name*" value="{{ old('name',$user->name ?? null) }}"  name ="name" autocomplete="false" readonly>
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                 
                  <div class="form-group col-6">
                     <label for="email">{{ __('Email address') }}</label>
                     <input type="text" name ="email"  class=" form-control @error('email') is-invalid @enderror" placeholder="E-mail*" value="{{ old('email',$user->email ?? null) }}" autocomplete="off" readonly>
                     @error('email')
                     <span class="invalid-feedback"   role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                 
                  <div class="form-group col-6">
                     <label for="status">{{ __('Status') }}</label>
                     <select name="status" id="status" class=" form-control @error('status') is-invalid @enderror">
                        @if($edit_comp->status == 0)
                          <option value="">Please Select</option>
                          <option value="1">progress</option>
                          <option value="2">completed</option>
                        @elseif($edit_comp->status == 1)
                          <option value="">Please Select</option>
                           <option value="2">completed</option>
                        @endif   
                     </select>
                     @error('status')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>


                  <div class="form-group col-6">
                     <label for="remark">{{ __('Remark') }}</label>
                     <input type="text" name ="remark"  class=" form-control @error('remark') is-invalid @enderror" placeholder="Remark*" value="" autocomplete="off">
                     @error('remark')
                     <span class="invalid-feedback"   role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                 
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ __('Update') }}
                  {{ ucfirst($user->type_text) }}</button>
                  <a href="{{route('admin.users.index')}}" class="btn btn-primary btn-cancel">{{ __('Cancel') }}</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')

@stop