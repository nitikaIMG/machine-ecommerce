@extends('web.layouts.main')

@push('custom_css')

@endpush
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@section('content')
    <!-- Main Section -->
    <section class="main-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('web.seller.leftmenu')
                </div>
                <div class="col-md-12 col-lg-9">
                    <section class="center-wraper">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <figure>
                                        <img src="{{ asset('web/images/1.png') }}" alt="">
                                    </figure>
                                    <p class="number">2542</p>
                                    <p class="number-text">Total No. of Orders</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <figure>
                                        <img src="{{ asset('web/images/2.png') }}" alt="">
                                    </figure>
                                    <p class="number">{{ count($SellerQuotation) }}</p>
                                    <p class="number-text">Total No. of RFQs</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <figure>
                                        <img src="{{ asset('web/images/3.png') }}" alt="">
                                    </figure>
                                    <p class="number">2542</p>
                                    <p class="number-text">Total No. of Chats</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p30" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-5">
                                                <div class="title">New RFQ’s</div>
                                            </div>
                                            <div class="col-md-8 col-lg-7">
                                                <ul class="nav nav-tabs accordion" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="New-tab" data-bs-toggle="tab"
                                                            data-bs-target="#New" type="button" role="tab"
                                                            aria-controls="New" aria-selected="true">New</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="In-progres-tab" data-bs-toggle="tab"
                                                            data-bs-target="#In-progres" type="button" role="tab"
                                                            aria-controls="In-progres" aria-selected="false">In
                                                            progres</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="Closed-tab" data-bs-toggle="tab"
                                                            data-bs-target="#Closed" type="button" role="tab"
                                                            aria-controls="Closed" aria-selected="false">Closed</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link view-all" id="View-All-tab"
                                                            data-bs-toggle="tab" data-bs-target="#View-All" type="button"
                                                            role="tab" aria-controls="View-All"
                                                            aria-selected="false">View All</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="New" role="tabpanel"
                                            aria-labelledby="New-tab">
                                            <div class="table-responsive">
                                                <table class="datatable table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Request ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($SellerQuotation as $quotation)
                                                            <tr>
                                                                <td>{{ $quotation['order_no'] }}</td>
                                                                <td>{{ $quotation['seller_orders'][0]['seller'] }}</td>
                                                                <td>{{ $quotation['date'] }}</td>
                                                                <td>{{ $quotation['item']['currency'] . ' ' . $quotation['item']['price'] }}
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0);"
                                                                        class="accept acceptorrehectbid"
                                                                        data-bid={{ $quotation['id'] }}
                                                                        data-accepted='1'>Accept</a>
                                                                    <a href="javascript:void(0);"
                                                                        data-bid={{ $quotation['id'] }} data-accepted='-1'
                                                                        class="deny acceptorrehectbid">Deny</a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <p>No Records</p>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="In-progres" role="tabpanel"
                                            aria-labelledby="In-progres-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Request ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($SellerQuotation as $quotation)
                                                            <tr>
                                                                <td>{{ $quotation['order_no'] }}</td>
                                                                <td>{{ $quotation['seller_orders'][0]['seller'] }}</td>
                                                                <td>{{ $quotation['date'] }}</td>
                                                                <td>{{ $quotation['item']['currency'] . ' ' . $quotation['item']['price'] }}
                                                                </td>
                                                                <td>
                                                                    <a href="" class="accept">Details</a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <p>No Records</p>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="Closed" role="tabpanel"
                                            aria-labelledby="Closed-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Request ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($SellerQuotation as $quotation)
                                                            <tr>
                                                                <td>{{ $quotation['order_no'] }}</td>
                                                                <td>{{ $quotation['seller_orders'][0]['seller'] }}</td>
                                                                <td>{{ $quotation['date'] }}</td>
                                                                <td>{{ $quotation['item']['currency'] . ' ' . $quotation['item']['price'] }}
                                                                </td>
                                                                <td>
                                                                    <a href="" class="accept">Details</a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <p>No Records</p>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="View-All" role="tabpanel"
                                            aria-labelledby="View-All-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">First</th>
                                                            <th scope="col">Last</th>
                                                            <th scope="col">Handle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Jacob</td>
                                                            <td>Thornton</td>
                                                            <td>@fat</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td colspan="2">Larry the Bird</td>
                                                            <td>@twitter</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="card p-3" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-5">
                                                <div class="title">New RFQ’s</div>
                                            </div>
                                            <div class="col-md-8 col-lg-7">
                                                <ul class="nav nav-tabs accordion" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="News-tab"
                                                            data-bs-toggle="tab" data-bs-target="#News" type="button"
                                                            role="tab" aria-controls="News"
                                                            aria-selected="true">New</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                                            data-bs-target="#completed" type="button" role="tab"
                                                            aria-controls="completed"
                                                            aria-selected="false">Completed</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="Cancelled-tab" data-bs-toggle="tab"
                                                            data-bs-target="#Cancelled" type="button" role="tab"
                                                            aria-controls="Cancelled"
                                                            aria-selected="false">Cancelled</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link view-all" id="View-Alls-tab"
                                                            data-bs-toggle="tab" data-bs-target="#View-Alls"
                                                            type="button" role="tab" aria-controls="View-Alls"
                                                            aria-selected="false">View All</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="News" role="tabpanel"
                                            aria-labelledby="News-tab">
                                            <div class="table-responsive">
                                                <table class="datatable table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Request ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>194586</td>
                                                            <td>Adnan Khan</td>
                                                            <td>AED 25.56</td>
                                                            <td>
                                                                <a href="" class="accept">Details</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>194586</td>
                                                            <td>Adnan Khan</td>
                                                            <td>AED 25.56</td>
                                                            <td>
                                                                <a href="" class="deny">Details</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>194586</td>
                                                            <td>Adnan Khan</td>
                                                            <td>AED 25.56</td>
                                                            <td>
                                                                <a href="" class="accept">Details</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="completed" role="tabpanel"
                                            aria-labelledby="completed-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">First</th>
                                                            <th scope="col">Last</th>
                                                            <th scope="col">Handle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Jacob</td>
                                                            <td>Thornton</td>
                                                            <td>@fat</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td colspan="2">Larry the Bird</td>
                                                            <td>@twitter</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="Cancelled" role="tabpanel"
                                            aria-labelledby="Cancelled-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">First</th>
                                                            <th scope="col">Last</th>
                                                            <th scope="col">Handle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Jacob</td>
                                                            <td>Thornton</td>
                                                            <td>@fat</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td colspan="2">Larry the Bird</td>
                                                            <td>@twitter</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="View-Alls" role="tabpanel"
                                            aria-labelledby="View-Alls-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">First</th>
                                                            <th scope="col">Last</th>
                                                            <th scope="col">Handle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Jacob</td>
                                                            <td>Thornton</td>
                                                            <td>@fat</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td colspan="2">Larry the Bird</td>
                                                            <td>@twitter</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('custom_js')
    <script>
        $('.dataTable').DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "order": [[0, 'desc']],
            'iDisplayLength': 4,
            "bAutoWidth": false
        });
    </script>
    <script>
        $('.acceptorrehectbid').click(function() {
            let bid = $(this).data('bid');
            let accept = $(this).data('accepted');
            let fData = new FormData();
            fData.append('bid', bid);
            fData.append('accepted', accept);
            swal({
                    title: "Are you sure?",
                    text: "Do you want to "+(accept == 1?'accept':'deny')+" the bid",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('acceptOrRejectBid') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: fData,
                            type: 'get',
                            dataType: 'json',
                            beforeSend: function() {
                                $('#apiMsg').html('');
                            },
                            error: function(xhr, textStatus) {
                                let errorMsg = xhr.responseJSON.message;
                                $('#apiMsg').html(
                                    '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                                    errorMsg + '</p>');
                            },
                            success: function(data) {
                                if(data.status == 1){
                                    swal(data.message, {
                                    icon: "success",
                                });
                                }else{
                                    swal(data.message, {
                                    icon: "warning",
                                });
                                }

                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                        });
                    } else {
                        swal("Canceled!",{
                            icon: "warning",
                        });
                    }
                });
        });
    </script>
@endpush
