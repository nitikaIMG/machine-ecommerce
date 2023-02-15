@extends('customer.layouts.main')
{{-- @dd($useraddress); --}}
@push('custom_css')
@endpush
@section('content')
<section class="main-wraper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('customer.inner.leftmenu')
            </div>
            <div class="col-md-12 col-lg-9">
                <section class="center-wraper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p30" id="myTab">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="title">Shipping Address</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row address-flex">
                                    <div class="col-md-4 mb-2">
                                        <div class="address-wrap" data-bs-toggle="modal" data-bs-target="#shop-address">
                                            <a href="{{route('add_address')}}" class="add-address">
                                                <i class="fa fa-plus"></i>
                                                <span class="text">Add Address</span>
                                            </a>
                                        </div>
                                    </div>
                                    @forelse ($useraddress as $item)
                                    <div class="col-md-4 text-center mb-2">                                   
                                        <div class="address-wrap">
                                            <div class="action">
                                                <a href="{{url('edit?id='.$item['id'])}}" class="edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{route('destroy',$item['id'])}}" class="delete">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                            <div class="content">
                                                <div class="name">{{$item->name}}</div>
                                                <div class="address">{{$item->address_1}}</div>
                                                <div class="address">{{$item->address_2}}</div>
                                                <div class="ship">
                                                 {{-- @dd($item['is_primary']) --}}
                                                    @if($item['is_primary']==1)
                                                    <input type="checkbox" name="is_primary[]" checked >
                                                    @else
                                                    <form action="{{ route('set_primary_address',$item->id) }}" method="get">
                                                     <input type="checkbox" name="is_primary[]" onChange='submit();' >
                                                    </form>
                                                    @endif
                                                    
                                                    <span class="text">Use As The Shipping Address</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    No Data Found
                                @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

@endsection