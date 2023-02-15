@extends('layouts.admin')
@section('title', __('Products'))
@section('pageheading')
    {{ __('Products') }}
    <p><small>{{__('Total')}}: {{ $productsCount }}</small></p>
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
                    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Add new') }}
                    </a>
                    <div class="ml-auto">
                        <form action="{{Request::url()}}" method="get">
                            <div class="form-inline align-items-center">
                                <select name="_col_key" class="form-control">
                                    <option value="_all" {{$_col_key=='all' ? 'selected':''}}>{{__('All')}}</option>
                                    <option value="id" {{$_col_key=='id' ? 'selected':''}}>{{__('ID')}}</option>
                                    <option value="title" {{$_col_key=='title' ? 'selected':''}}>{{__('Title')}}</option>
                                    <option value="category" {{$_col_key=='category' ? 'selected':''}}>{{__('Category')}}</option>
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
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title ?? 'NA'}}</td>
                                    <td>{{$product->product_category->title ?? 'NA'}}</td>
                                    <td>
                                        <form action="{{route('admin.product.update_status', ['update_status' => $product->id])}}" class="toggle-switch-form" method="post">
                                            @csrf
                                            <input type="checkbox" class="newBSswitch toggle-switch-button" data-toggle="toggle" {{$product->status ? 'checked':''}}>
                                        </form>
                                    </td>
                                    <td>{{$product->created_at->format('Y/m/d')}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-primary" href="{{route('admin.product.edit', ['us_product' => $product->id])}}">
                                                <i class="fas fa-pen"></i>
                                                {{__("Edit")}}
                                            </a>
                                            <form onsubmit="return confirm('{{__('Are you sure?')}}');" action="{{route('admin.product.destroy', ['us_product' => $product->id])}}" method="post">
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
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
