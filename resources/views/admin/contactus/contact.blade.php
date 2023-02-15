@extends('layouts.admin')
@section('title', __('Contact listing'))
@section('pageheading')
    {{ __('Contact listing') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="d-flex">
                    {{-- <a href="{{ route('admin.product_category.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Add new') }}
                    </a> --}}
                 
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
                                <th>{{__('Name')}}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Feedback') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact_us as $contacts)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contacts->name ?? 'N/A' }}</td>
                                    <td>{{ $contacts->email ?? 'N/A' }}</td>
                                    <td>{{ $contacts->phone_number ?? 'N/A' }}</td>
                                    <td>{{ $contacts->subject ?? 'N/A' }}</td>
                                    <td>{{ $contacts->feedback ?? 'N/A' }}</td>

                                   
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
