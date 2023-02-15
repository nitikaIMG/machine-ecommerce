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
                                @if (!empty($RfqDetail))
                                    <div class="card p30" id="myTab">
                                        <div class="header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="title">Request For Quote</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="order-wrap">
                                                    <div class="sb-header">
                                                        <div class="name">
                                                            <span>{{ $RfqDetail['seller_orders'][0]['seller'] }}</span>
                                                            <span class="order-id">Quote Request ID:
                                                                <strong>{{ $RfqDetail['order_no'] }}</strong></span>
                                                        </div>
                                                        <div class="action">
                                                            <span class="date">Date: {{ $RfqDetail['date'] }}</span>
                                                            <a href="" class="deny chat"><img
                                                                    src="{{ asset('web/images/chat-icon-btn.png') }}"
                                                                    alt="">Chat</a>
                                                        </div>
                                                    </div>
                                                    <div class="row-divider">
                                                        <div class="row">
                                                            @forelse ($RfqDetail['items'] as $detail)
                                                                <div class="col-md-6 col-lg-6">
                                                                    <div class="product">
                                                                        <figure>
                                                                            <img src="{{ $detail['image'] }}" alt=""
                                                                                class="img-fluid">
                                                                        </figure>
                                                                        <div class="content">
                                                                            <div class="name">{{ $detail['title'] }}</div>
                                                                            <div class="qty">Quantity:
                                                                                {{ $detail['quantity'] }}</div>
                                                                            <div class="price">
                                                                                {{ $detail['currency'] . ' ' . $detail['price'] }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <p>No item added</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="action-btns">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6">
                                                            <a href="" class="respond">Respond</a>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 text-md-end">
                                                            <a href="javascript:void(0);" class="accept big-btn"
                                                                onClick="acceptorrehectbid('{{ $RfqDetail['id'] }}','1')">Accept</a>
                                                            <a href="javascript:void(0);"
                                                                onClick="acceptorrehectbid('{{ $RfqDetail['id'] }}','-1')"
                                                                class="deny big-btn">Deny</a>
                                                            <div class="update-quote">
                                                                <label class="labels">Update Quote:</label>
                                                                <input type="text" class="quote-input" value="15.50">
                                                            </div>
                                                            <div class="submit">
                                                                <a href="" class="submit-btn">Submit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>dd</p>
                                @endif
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
        function acceptorrehectbid(bid, accept) {
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
