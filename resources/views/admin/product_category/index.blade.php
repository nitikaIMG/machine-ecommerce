@extends('layouts.admin')
@section('title', __('Product categories'))
@section('pageheading')
    {{ __('Product categories') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="d-flex">
                    <a href="{{ route('admin.product_category.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Add new') }}
                    </a>
                    @if (Request::query('filter') == 'parent_only')
                    <a href="{{ route('admin.product_category.index') }}" class="btn btn-sm btn-outline-primary ml-sm-2">
                        <i class="fas fa-eye"></i> {{ __('Show all categories') }}
                    </a>
                    @else
                    <a href="{{ route('admin.product_category.index', ['filter' => 'parent_only']) }}" class="btn btn-sm btn-outline-primary ml-sm-2">
                        <i class="fas fa-eye"></i> {{ __('Show only parent categories') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="dataTable" class="display table table-striped has-toggle-switch" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Title')}}</th>
                                <th>{{ __('Parent category') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->parent ? $category->parent->title : 'N/A' }}</td>
                                    <td>
                                        <form action="{{route('admin.product_category.update_status', ['update_status' => $category->id])}}" class="toggle-switch-form" method="post">
                                            @csrf
                                            <input type="checkbox" class="newBSswitch toggle-switch-button" data-toggle="toggle" {{$category->status ? 'checked':''}}>
                                        </form>
                                    </td>
                                    <td>{{ $category->created_at->format('Y/m/d') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('admin.product_category.edit', ['us_product_category' => $category->id])}}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pen"></i>
                                                {{__('Edit')}}
                                            </a>

                                            <form method="post"
                                                action="{{ route('admin.product_category.destroy', ['us_product_category' => $category->id]) }}"
                                                onsubmit="return confirm('Are you sure to delete this link?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger ml-2">
                                                    <i class="fas fa-trash"></i>
                                                    {{__('Delete')}}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@stop
