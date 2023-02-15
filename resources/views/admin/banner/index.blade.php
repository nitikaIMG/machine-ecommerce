@extends('layouts.admin')
@section('title',__('Banner'))
@section('pageheading')
   {{ __('Banner manager') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form class="row" method="get">
                 <div class="col-lg-6">
                    <div class="form-group">
                       {{-- <input type="hidden" name="type" value="customer"> --}}
                       <a href="{{url('admin/banner/create')}}" class="btn-sm btn-info">{{__('Add new')}} </a>
                    </div>
                 </div>
              </form>
                <div class="table-responsive">
                    <table id="dataTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title')}}</th>
                                <th>{{ __('Short description')}}</th>
                                <th>{{ __('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banner as $bannerData)
                            
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bannerData->title ?? '-' }}</td>
                                    <td>{{ $bannerData->short_description }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('admin.banner.edit',$bannerData->id)}}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pen"></i>
                                                {{__('Edit')}}
                                            </a>

                                            <form method="post"
                                                action="{{ route('admin.banner.destroy',$bannerData->id) }}"
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
