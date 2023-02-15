@extends('layouts.admin')
@section('title', __('Products'))
@section('pageheading')
    {{ __('Shops') }}
    <p><small>{{__('Total')}}: {{ $shops->total() }}</small></p>
@endsection
@section('content')
@php
    $_col_key = Request::get('_col_key');
    $_col_value = Request::get('_col_value');
@endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="d-flex align-items-center">
                    <div class="ml-auto">
                        <form action="{{Request::url()}}" method="get">
                            <div class="form-inline align-items-center">
                                <select name="_col_key" class="form-control">
                                    <option value="_all" {{$_col_key=='all' ? 'selected':''}}>{{__('All')}}</option>
                                    <option value="shop_name" {{$_col_key=='shop_name' ? 'selected':''}}>{{__('Shop Name')}}</option>
                                    <option value="shop_owner" {{$_col_key=='shop_owner' ? 'selected':''}}>{{__('Owner')}}</option>
                                    <option value="shop_email" {{$_col_key=='shop_email' ? 'selected':''}}>{{__('Email')}}</option>
                                    <option value="registration_no" {{$_col_key=='registration_no' ? 'selected':''}}>{{__('Registration')}}</option>
                                </select>
                                <input type="text" name="_col_value" value="{{$_col_value}}" class="form-control ml-2" autofocus>
                                @if ($_col_value)
                                <a href="{{Request::url()}}" class="btn btn-sm ml-1 btn-link">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped has-toggle-switch" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Shop Name') }}</th>
                                <th>{{ __('Owner') }}</th>
                                <th>{{ __('Contact') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Registration number') }}</th>
                                <th>{{ __('Address') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $shop)
                                <tr>
                                    <td></td>
                                    <td>{{$shop->shop_name ?? '-'}}</td>
                                    <td>{{$shop->shop_owner ?? '-'}}</td>
                                    <td>{{$shop->shop_contact ?? '-'}}</td>
                                    <td>{{$shop->shop_email ?? '-'}}</td>
                                    <td>{{$shop->registration_no ?? '-'}}</td>
                                    <td>{{$shop->address ?? '-'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $shops->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
