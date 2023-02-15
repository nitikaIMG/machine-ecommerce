@extends('layouts.admin')
@section('title',  __('Content manager'))
@section('pageheading')
   {{ __('Content manager') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="dataTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title')}}</th>
                                <th>{{ __('Slug')}}</th>
                                <th>{{ __('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (config('app.static_content_slugs') as $slug)
                            @php
                                $content = $contents->firstWhere('slug', $slug) ?? new \App\Models\Content(['slug' => $slug]);
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $content->title ?? '-' }}</td>
                                    <td>{{ $content->slug }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary" style="margin-right: 5px;" href="{{route('admin.content_manager.edit', ['slug' => $content->slug])}}">
                                                <i class="fas fa-pencil-alt"></i>   {{ __('Edit')}}
                                            </a>
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
