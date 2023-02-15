@extends('layouts.admin')
@section('title', __('Users'))
@section('pageheading')
{{ __('Edit users') }}
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{__('Edit users')}}</h3>
            </div>
            <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="post">
               @csrf
               @method('put')
               <div class="card-body row">
                  <div class="form-group col-6">
                     <label for="name">{{__('Full name')}} </label>
                     <input type="text" name="name" class="form-control" value="{{ $user->name }}" >
                  </div>
                  <div class="form-group col-6">
                     <label for="email">{{__('Email address')}}</label>
                     <input type="email" name="email" class="form-control" value="{{ $user->email }}" >
                  </div>

                  <div class="form-group col-6">
                     <label for="country">{{ __('Country') }}</label>
                     <select name="country" id="countryId" class="countries  form-control @error('country') is-invalid @enderror">
                        @if(!empty($user->country))
                        <option value="{{$user->country }}" @if($user->country) selected @endif>{{$user->country}}</option>
                        @else
                        <option value="" >{{ __('Select Country') }}</option>
                        @endif
                     </select>
                     @error('country')
                     <span class="invalid-feedback" id="country_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="state">{{ __('State') }}</label>
                     <select name="state" id="stateId" class=" states form-control @error('state') is-invalid @enderror">
                        @if(!empty($user->state))
                        <option value="{{$user->state }}" @if($user->state) selected @endif>{{$user->state}}</option>
                        @else
                        <option value="">{{ __('Select State') }}</option>
                        @endif
                     </select>
                     @error('state')
                     <span class="invalid-feedback" id=state_sell_err role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="city">{{ __('City') }}</label>
                     <select name="city" id="cityId" class="cities  form-control @error('city') is-invalid @enderror">
                        @if(!empty($user->city))
                        <option value="{{$user->city }}" @if($user->city) selected @endif>{{$user->city}}</option>
                        @else
                        <option value="">{{ __('Select City') }}</option>
                        @endif
                     </select>
                     @error('city')
                     <span class="invalid-feedback" id="city_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>

                   <div class="form-group col-6">
                     <label for="address">{{ __('Address line1') }}</label>
                     <input type="text" name="address" class=" form-control " value="{{ old('address_line_1',$user->address_line_1 ?? null) }}" autocomplete="false">
                     @error('address')
                     <span class="invalid-feedback" id="address_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="address2">{{ __('Address line2') }}</label>
                     <input type="text" name="address2" class=" form-control" value="{{ old('address_line_2',$user->address_line_2 ?? null) }}" autocomplete="false">
                     @error('address2')
                     <span class="invalid-feedback" id="address2_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <input type="hidden" name="type" value="customer">

                  @if(in_array($user->role,['seller','customer']))
                  <div class="form-group col-6">
                     <label for="phone">{{__('Phone')}}</label>
                     <input type="tel"  name="phone" class=" form-control @error('phone') is-invalid @enderror" placeholder="Phone Number*" min="0" value="{{ old('phone',$user->phone) }}" autocomplete="false">
                     @error('phone')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                     
                  </div>
                  @elseif (in_array($user->role,['admin']))
                  @php
                  $oldpermission = $user->pluck('id')->all();
                  @endphp
                  <div class="form-group col-6">
                     <label for="password">{{__('Select role')}}</label>
                     <select name="role" class="form-control">
                        <option value="">{{__('Select user role')}} </option>
                        <option value="admin" @if($user->role =="admin") selected @endif>{{__('ADMIN')}}</option>
                      
                     </select>
                  </div>
                 
                  @endif
                  @if ( $user->role == "customer" )
                 
                  <table class="table">
                     <thead>
                        
                     </thead>
                     <tbody>
                      
                     </tbody>
                  </table>
                  @endif
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('Update')}} 
                  {{ ucfirst($user->type_text) }}</button>
                  <a href="{{route('admin.users.index')}}" class="btn btn-primary btn-cancel">{{__('Cancel')}} </a>
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
<script src="{{ asset('js/admin.js') }}"></script>
@stop