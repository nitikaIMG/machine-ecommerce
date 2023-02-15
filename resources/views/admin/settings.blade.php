@extends('layouts.admin')

@section('title', __('Dashboard'))
@section('pageheading')
{{ __('Settings') }}
@endsection 

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                           {{ __('Manage password') }} 
                        </h3>
                    </div>
                    <form action="{{ route('admin.changePassword') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="password" name="old_password"
                                    class="form-control @error('old_password') is-invalid @enderror"
                                    placeholder="Old Password" value="{{ old('old_password') }}"
                                    autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror"
                                    placeholder="New Password" value="{{ old('new_password') }}"
                                    autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="new_password_confirmation"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    placeholder="New Password Confirmation" value="{{ old('new_password_confirmation') }}"
                                    autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('new_password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('Change password') }}</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
