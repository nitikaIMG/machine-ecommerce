@extends('customer.layouts.main')
{{-- @dd($orderListing) --}}
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
                            <div class="card p-3" id="myTab">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 mb-2">
                                            <div class="title"> {{__('Request For Quote') }}</div>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <!-- <ul class="nav nav-tabs accordion" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="News-tab" data-bs-toggle="tab" data-bs-target="#News" type="button" role="tab" aria-controls="News" aria-selected="true">Pending</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Confirmed</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="Cancelled-tab" data-bs-toggle="tab" data-bs-target="#Cancelled" type="button" role="tab" aria-controls="Cancelled" aria-selected="false">Delivered</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <select name="" id="" class="sort">
                                                        <option value="">Sort by Date</option>
                                                    </select>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <select name="" id="" class="sort">
                                                        <option value="">Sort by Price</option>
                                                    </select>
                                                </li>
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Request ID</th>
                                                       
                                                        <th scope="col">Date</th>
                                                        <th scope="col" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                        @forelse ($quotations as $item)
                                                        <tr>
                                                        <td>{{$item['order_no']}}</td>
                                                        
                                                        <td>{{ $item['created_at']->format('d-m-Y') }}</td>
                                                       
                                                        <td class="text-center">
                                                            <a href="{{ route('quotationDetails',$item['order_no']) }}" style="background:#26d5c5;" class="deny">View Quote</a>
                                                        </td>
                                                        </tr>
                                                        @empty
                                                            No Orders Found
                                                        @endforelse
                                                </tbody>
                                            </table>
                                            <div style="float: right;"><span> {!! $quotations->render() !!} </span></div>
                                        </div>
                                        
                                    </div>
                                  
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