@extends('web.layouts.main')

@section('content')
    <section class="main-wraper">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('web.seller.leftmenu')
                </div>
                <div class="col-md-12 col-lg-9">
                    <section class="center-wraper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p-3" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-5">
                                                <div class="title">Request For Quote</div>
                                            </div>
                                            <div class="col-md-8 col-lg-7">
                                                <ul class="nav nav-tabs accordion" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="News-tab" data-bs-toggle="tab"
                                                            data-bs-target="#News" type="button" role="tab"
                                                            aria-controls="News" aria-selected="true">New</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                                            data-bs-target="#completed" type="button" role="tab"
                                                            aria-controls="completed" aria-selected="false">In
                                                            progress</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="Cancelled-tab" data-bs-toggle="tab"
                                                            data-bs-target="#Cancelled" type="button" role="tab"
                                                            aria-controls="Cancelled" aria-selected="false">Closed</button>
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
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="News" role="tabpanel"
                                            aria-labelledby="News-tab">
                                            <div class="table-responsive">
                                                <table class="table" id="rfq-pending-datatable-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Request ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="completed" role="tabpanel"
                                            aria-labelledby="completed-tab">
                                            <div class="table-responsive">
                                                <table class="table in-progress" id="rfq-confirmed-datatable-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Request ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Price</th>
                                                            {{-- <th scope="col">Quote Price</th> --}}
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="Cancelled" role="tabpanel"
                                            aria-labelledby="Cancelled-tab">
                                            <div class="table-responsive">
                                                <table class="table" id="rfq-delivered-datatable-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Request ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
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

@push('custom_js')
    <script>
        $(document).ready(function() {
            $(function() {
                rfqPendingTable = $('#rfq-pending-datatable-table').DataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "order": [
                        [0, 'desc']
                    ],
                    'iDisplayLength': 4,
                    "bAutoWidth": false,
                    ajax: {
                        url: "{{ asset('getRfqList') }}",
                        data: function(data) {
                            data.type = 'pending';
                        }
                    },
                    columns: [{
                            data: 'order_no',
                            name: 'order_no',
                        },
                        {
                            data: 'seller_orders[0].seller',
                            name: 'seller_orders[0].seller'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'item',
                            name: 'item',

                            render: function(data, type, full, meta) {
                                return full.item.price + ' ' + full.item.currency;
                            }

                        },
                        {
                            data: 'action',
                            name: 'action',

                            // render: function(data, type, full, meta) {
                            //     var result = full.action;
                            //     console.log(full);
                            //     // if (full.apppinment_status == "2") {
                            //     result += '<a data-id="' + full.id +
                            //         '" class="btn btn-outline-primary mb-2 mr-2 uploadReport" id="uploadReport">Upload Report</a>';
                            //     // }
                            //     return result;
                            // },
                        },
                    ]
                });

                rfqConfirmedTable = $('#rfq-confirmed-datatable-table').DataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "order": [
                        [0, 'desc']
                    ],
                    'iDisplayLength': 4,
                    "bAutoWidth": false,
                    ajax: {
                        url: "{{ asset('getRfqList') }}",
                        data: function(data) {
                            data.type = 'confirmed';
                        }
                    },
                    columns: [{
                            data: 'order_no',
                            name: 'order_no',
                        },
                        {
                            data: 'seller_orders[0].seller',
                            name: 'seller_orders[0].seller'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'item',
                            name: 'item',

                            render: function(data, type, full, meta) {
                                return full.item.price + ' ' + full.item.currency;
                            }

                        },
                        {
                            data: 'action',
                            name: 'action',
                        },
                    ]
                });

                rfqDeliveredTable = $('#rfq-delivered-datatable-table').DataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "order": [
                        [0, 'desc']
                    ],
                    'iDisplayLength': 4,
                    "bAutoWidth": false,
                    ajax: {
                        url: "{{ asset('getRfqList') }}",
                        data: function(data) {
                            data.type = 'delivered';
                        }
                    },
                    columns: [{
                            data: 'order_no',
                            name: 'order_no',
                        },
                        {
                            data: 'seller_orders[0].seller',
                            name: 'seller_orders[0].seller'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'item',
                            name: 'item',

                            render: function(data, type, full, meta) {
                                return full.item.price + ' ' + full.item.currency;
                            }

                        },
                        {
                            data: 'action',
                            name: 'action',
                        },
                    ]
                });
            });
        });
    </script>
    <script>
        function acceptorrehectbid(bid,accept) {
            let fData = new FormData();
            fData.append('bid', bid);
            fData.append('accepted', accept);
            swal({
                    title: "Are you sure?",
                    text: "Do you want to " + (accept == 1 ? 'accept' : 'deny') + " the bid",
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
                                if (data.status == 1) {
                                    swal(data.message, {
                                        icon: "success",
                                    });
                                } else {
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
                        swal("Canceled!", {
                            icon: "warning",
                        });
                    }
                });
        }
    </script>
@endpush
