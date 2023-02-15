@extends('customer.layouts.main') @push('custom_css') @endpush @section('content')
<!-- Main Section -->
<section class="main-wraper">
  <div class="container">
    <div class="row">
      <form action="{{ route('submit_quotation') }}" method="POST"> 
        @csrf 
        <div class="card p-4">
          <section class="center-wraper">
            <div class="row pb-2 mb-2">
              <div class="col-md-12">
                <div class="" id="myTab">
                  <div class="row">
                    <div class="col-md-12 cartlist">
                      <div class="title">My Cart</div>
                    </div>
                  </div> @if (session('success')) <span style="color:green">{{ session('success') }}</span> @else <span style="color:red">{{ session('error') }}</span> @endif
                </div>
              </div>
            </div>
          </section> 
          @if(!empty($data["primary_address"] && $data["items"])) 
          <section class="center-wraper">
            <div class="row mt-0 m-4" style="background:#f5fafe">
              <div class="col-md-12">
                <div class="" id="myTab">
                  <div class="header">
                    <div class="row " >
                      <div class="col-md-6 cartlist mt-2">
                        <div class="title">Deliver to : </div>
                      </div>
                      <div class="col-md-6 cartlist mt-2 text-end text-bold fw-bolder">
                      <a href="{{ route('settings') }}">Change Address</a>
                      </div>
                    </div>
                    <div class="row pb-2">
                      <div class="col-md-8">
                        <div class="row">
                          
                            <div class="col-md-12">
                              <div class="electrical-item-content card-content">
                                <div class="electrical-item-subtitle">
                                  <div class="products-name mt-2">
                                    <input type="hidden" name="address_id" value='{{$data["primary_address"]["id"] }}'>
                                    <div class="current-type mt-2">
                                      <b>{{ $data["primary_address"]["name"] }},</b>  {{ $data["primary_address"]["address_1"] }}
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </section> @endif
          <!-- Main Section -->
          <section class="center-wraper">
            <div class="row m-3">
              <div class="col-md-12">
                <div class="" id="myTab">
                  <div class="header"> @if(!empty($data["items"])) <div class="row">
                      
                    </div> @foreach($data["items"] as $item) <div class="row border-bottom pb-2">
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-md-3 col-6">
                            <div class="electrical-item-small">
                              <a href="">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="img-fluid">
                              </a>
                            </div>
                          </div>
                          <div class="col-md-6 col-6">
                            <div class="electrical-item-content card-content">
                              <div class="electrical-item-subtitle">
                                <div class="products-name mt-2">
                                  <a href="" class="anchor-link">
                                    {{ $item["title"] }} </a>
                                </div>
                                <div class="current-type mt-2">{{ $item["currency"] }}
                                  <strong id="basePrice{{ $item['id'] }}">{{ $item["price"] }}</strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="count-wrapper mt-4">
                          <input type="hidden" name="items['product_id'][]" value="{{ $item['id'] }}"> @if($item['price_type']=='bid') <input class="bidamount" type="text" name="items['bid'][]" placeholder="Bid Amount" id="bidamount{{ $item['id'] }}" onkeyup="myFunction({{ $item['id'] }});" required>
                          </br> @else <input type="hidden" name="items['bid'][]" id="" value="{{ $item['price'] }}"> @endif <form action="" method="POST"> @csrf <button type="button" onclick="remove_from_cart({{ $item['id'] }})" class="btn btn-blank minus-icon">
                              <i class="fa fa-minus"></i>
                              </a>
                            </button>
                            <input type="text" value="{{ $item['quantity'] }}" id="quantity{{ $item['id'] }}" placeholder="1" class="countnum">
                            <button type="button" onclick="add_to_cart({{ $item['id'] }})" class="btn btn-blank delete-icon">
                              <i class="fa fa-plus"></i>
                            </button>
                            <button onclick="delete_from_cart({{ $item['id'] }})" type="button" class=" btn btn-blank delete-icon">
                              <i class="fa fa-trash"></i>
                            </button>
                        </div>
                      </div>
                    </div> 
                    @endforeach 
                    <div class="row mt-2">
                    
                      
                        <div class="col-md-6">
                            <div class="electrical-item-content card-content">
                              <div class="electrical-item-subtitle">
                                <div class="products-name mt-2">
                                  <input type="radio" name="delivery_type" checked value="delivery"> Please delivery to my address <br>
                                  <input type="radio" name="delivery_type" value="pick-up"> I will come and collect
                                </div>
                              </div>
                            </div>
                        </div>
                        

                        <div class="col-md-6" >
                          <div class="title text-end">
                            <b>{{ $data["cart_items"] }} Items</b>
                          </div>
                          <div class="product-price-blue text-end">
                            <b class="blcktxt">
                            <span id="currency"> {{ $data["currency"] }} </span>
                            <span id="total_sum"> {{ $data["total_sum"] }}</span></b>
                          </div>
                        
                        <div class="mt-4">
                          <button type="submit" id="sent_a_quote" class="blue-common-btn custom-btn pull-right text-white ml-1">
                            <img src="{{ asset('web/images/send-qoute.png') }}" alt="" class="chaticon20">Send A Quote </button>
                          <a href="{{ route('chat.index') }}" class="blue-common-btn custom-btn pull-right text-white">
                            <img src="{{ asset('web/images/chat.png') }}" alt="" class="chaticon20"> Chat </a>
                        </div>
                        </div>
                       @else
                        <center>
                        <h4 style="color:#0eb0da;">
                          <ul>Please Add Items...! </ul>
                        </h4>
                        <center> @endif
                    </div>
                  </div>
                </div>
              </div>
          </section>
        </div>
      </form>
    </div>
  </div>
</section> @endsection @push('custom_js') <script>
  function add_to_cart(id) {
    $.ajax({
      url: "{{ url('add-to-cart') }}/ajax" + '/' + id,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      type: 'get',
      dataType: 'json',
      success: function(data) {
        if (data.status == 1) {
          var qty = $("#quantity" + "" + id).val();
          $("#quantity" + "" + id).val(++qty);
          $("#currency").html(data.data.currency);
          $("#total_sum").html(data.data.total_sum);
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
  };

  function remove_from_cart(id) {
    $.ajax({
      url: "{{ url('remove-from-cart') }}" + '/' + id,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      type: 'get',
      dataType: 'json',
      success: function(data) {
        if (data.status == 1) {
          var qty = $("#quantity" + "" + id).val();
          if (qty == 1) {
            location.href = "/cart";
          } else {
            var newqty = $("#quantity" + "" + id).val(--qty);
          }
          $("#currency").html(data.data.currency);
          $("#total_sum").html(data.data.total_sum);
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
  };

  function delete_from_cart(id) {
    swal({
      title: "Are you sure?",
      text: "are you sure you want to remove the item?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "{{ url('delete-from-cart') }}" + '/' + id,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          type: 'get',
          dataType: 'json',
          success: function(data) {
            if (data.status == 1) {
              swal("Poof! Your Item has been deleted!", {
                icon: "success",
              });
              location.href = "/cart";
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
      }
    });
  };

  function myFunction(id) {
    var basePrice = parseInt($("#basePrice" + id).html().toString());
    var bidamount = parseInt($("#bidamount" + id).val());
    if (basePrice < bidamount) {
      $("#sent_a_quote").attr("disabled", true);
      alert('Bid Amount must be less than product Amount.')
    } if(bidamount==0){
      alert('Bid Amount must be greater than 0.')
    }
    else {
      $("#sent_a_quote").attr("disabled", false);
    }
  }
</script> @endpush