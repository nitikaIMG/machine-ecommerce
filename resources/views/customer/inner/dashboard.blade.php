@extends('customer.layouts.main')

@push('custom_css')

@endpush
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<style>
    .mb-menu-show {
    display: none;
}

</style>
@section('content')
    <!-- Main Section -->
    <section class="main-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('customer.inner.leftmenu')
                </div>
                <div class="col-md-12 col-lg-9">
                    <section class="center-wraper">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <figure>
                                        <img src="{{ asset('web/images/1.png') }}" alt="">
                                    </figure>
                                    <p class="number">{{ $order_count }}</p>
                                    <p class="number-text">Total No. of Orders</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <figure>
                                        <img src="{{ asset('web/images/2.png') }}" alt="">
                                    </figure>
                                    <p class="number">{{ $quotation_total }}</p>
                                    <p class="number-text">Total No. of RFQs</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <figure>
                                        <img src="{{ asset('web/images/3.png') }}" alt="">
                                    </figure>
                                    <p class="number">{{ $msg_total }}</p>
                                    <p class="number-text">Total No. of Chats</p>
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
