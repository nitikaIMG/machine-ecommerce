@extends('layouts.admin')
@section('title', __('Users'))
@section('pageheading')
    {{ __('Report') }}
@endsection
@section('content')
    <div class="container-fluid">
            <div class="row mb-3">
                {{-- <h6 class="col-12 text-bold">Filter</h6> --}}
                <div class="col-lg-12">
                    <form class="row" method="get" action="{{route('admin.userreport',['type'=>$type])}}">
                        <div class="col-12 mb-3">
                            @include('admin.dashboard._filters')
                        </div>
                    </form>
                </div>
                <div class="col-lg-1">
                    <form action="{{route('admin.downloadPDF',['type'=>$type,'file'=>'pdf'])}}" method="post">
                        @csrf
                        <input type="hidden" name="status" value="{{request()->has('status') ? request()->status:''}}">
                        <input type="hidden" name="email" value="{{request()->has('email') ? request()->email:''}}">
                        <input type="hidden" name="refer_code" value="{{request()->has('refer_code') ? request()->refer_code:''}}">
                        <input type="hidden" name="country" value="{{request()->has('country') ? request()->country:''}}">
                        <button type="submit" class="btn-sm btn-warning">PDF</button>
                    </form>
                
                </div>
                <div class="col-lg-1">
                    <form action="{{route('admin.downloadPDF',['type'=>$type,'file'=>'xls'])}}" method="post">
                        @csrf
                        <input type="hidden" name="status" value="{{request()->has('status') ? request()->status:''}}">
                        <input type="hidden" name="email" value="{{request()->has('email') ? request()->email:''}}">
                        <input type="hidden" name="refer_code" value="{{request()->has('refer_code') ? request()->refer_code:''}}">
                        <input type="hidden" name="country" value="{{request()->has('country') ? request()->country:''}}">
                        <button type="submit" class="btn-sm btn-success">Excel</button>
                             
                    </form>
                </div>
            </div>


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
                                <th>{{__('Created')}}</th>
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
                                        <td>{{ $user->created_at }}</td>
                                        
                                    </tr>
                                @endforeach
                            @endif
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
