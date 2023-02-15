@extends('layouts.vendor')
@section('title', 'Dashboard')
@section('pageheading')
    {{__('Dashboard')}}
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                {{-- <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total->sellers }}</h3>

                        <p>{{__('Total Sellers')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('seller.users.index', ['type' => "seller"]) }}"
                        class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                </div> --}}
            </div>
          
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection


