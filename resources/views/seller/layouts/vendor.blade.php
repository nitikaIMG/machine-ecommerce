<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Up Shop') }}</title>
    <link rel="stylesheet" href="{{ asset('seller/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('seller/css/machine_enquiry.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    @yield('styles')
</head>
<input type="hidden" value="<?php echo url('/'); ?>/" id="Baseurl" name="Baseurl">
<body>
@yield('css')
@include('seller.layouts.partials.navbar')

    <!-- Main Section -->
    <section class="main-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('seller.layouts.partials.sidebar')
                    @show
                </div>
                <div class="col-md-12 col-lg-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

  

    @include('seller.layouts.partials.footer')
    @show
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('seller/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('document').ready(function() {
            $(".mobile-menu").click(function() {
                $('aside').css({
                    "left": 0
                })
            })
            $(".close-menu").click(function() {
                $('aside').css({
                    "left": -230
                })
            })
            
        var BasedUrl=$("#Baseurl").val();
        $(".notificationread").click(function(){
          // alert("yes");
        var $this = $(this);
        // var patientid = $this.data('patientid');
        $.ajax({
                    // url: BasedUrl+"customer/notificationread?patientid=" + $(this).data('patientid'),
                    url: BasedUrl+"seller/notificationread",
                    method: 'GET',
                    success: function(data) {
                      $("#notificationscount").load(location.href + " #notificationscount");
                      $(".notificationscount").load(location.href + " .notificationscount");
                        // $('#facilationcenter_list').html(data.facilationcentere);
                    }
                });

        });    
        /**/
        $(".chatorderid").click(function(e){
                          var chatorderid = $(this).data("orderid");
                          var orderid = $(this).data("chatorderid");
                          /**/
                          // alert(chatorderid);
                             $("#errormessage").html("");
                
                
                if(chatorderid !=""){
                  // var loading = $("#loading");
                  e.preventDefault();
                  // loading.show();

                  $.ajax({

                     type:'POST',
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                     // url:baseurl+"doctor/rescheduleappointment",
                     url: "{{ url('seller/orderchatid') }}",
                     data:{chatorderid:chatorderid,orderid:orderid},

                     success:function(data){
			
                         $("#chatorderidmodel").text('Order Id:'+chatorderid);
                         $("#chatordermodel").html('');
                         $.each(data,function(key,value){
                            // alert(value.product_category_id);
                            var total;
                            var price;

                             if(value.bid !=null){
                                                                        total += value.qty * value.bid.bid;
                                                                        price=value.bid.bid;
                                                                    }
                                                                    else{
                                                                        total += value.qty * value.seller.price;
                                                                        price = value.seller.price
                                                                    }

                            $("#chatordermodel").append('<div class="img-wrap"><img src="https://'+window.location.host+'/storage/'+value.pro.cover_image+'" style="height:100px;" alt="'+value.pro.title+'"></div><div class="content-details"><h5 class="chatordertitlemodel">'+value.pro.title+'</h5><p>'+value.pro.short_description+'</p><div class="chat-product-price">'+price+'<span> Qty:'+value.qty+' </span></div></div>');
                         });
                      
                       $('#sellerChatOrderModal').modal('toggle');
                       
                     }

                  });

              }else{
                $("#errormessage").html("Please Enter all Filled");
              }
                       
                          

            });
    /**/
        })
 /*for product detail model*/
    $(".productid").click(function(e){
                          var productid = $(this).data("productid");
                          /**/
                          // alert(productid);
                             $("#errormessage").html("");
                
                
                if(productid !=""){
                  // var loading = $("#loading");
                  e.preventDefault();
                  // loading.show();
                  $.ajax({

                     type:'POST',
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                     // url:baseurl+"doctor/rescheduleappointment",
                     url: "{{ url('seller/productchatid') }}",
                     data:{productid:productid},

                     success:function(data){
                         // alert(data.order_no);
                         // alert(data.date);
                         // $("#chatorderidmodel").text('Order nNo:'+data.order_no);
                         $("#chatproductmodel").html('');
                         // $.each(data,function(key,value){
                            // alert(data.title);
                            $("#chatproductmodel").append('<div class="img-wrap"><img src="'+data.image+'" style="height:100px;width:100px;" alt="'+data.title+'"></div><div class="content-details"><h5 class="chatordertitlemodel">'+data.title+'</h5><p>'+data.short_description+'</p><div class="chat-product-price">'+data.currency+' '+data.price+'</div></div>');
                         // });
                      
                       
                       $('#cusChatProductModal').modal('toggle');
                       
                     }

                  });

              }else{
                $("#errormessage").html("Please Enter all Filled");
              }
                       
                          

            });
    /**/
        /*for shop detail model*/
        $(".shopid").click(function(e) {
            var shopid = $(this).data("shopid");
            /**/
            // alert(productid);
            $("#errormessage").html("");


            if (shopid != "") {
                // var loading = $("#loading");
                e.preventDefault();
                // loading.show();
                $.ajax({

                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    // url:baseurl+"doctor/rescheduleappointment",
                    url: "{{ url('seller/shopchatid') }}",
                    data: {
                        shopid: shopid
                    },

                    success: function(data) {
                        $("#chatshopmodel").html('');
                        $("#chatshopmodel").append('<div class="img-wrap"><img src="' + data.shop.shop_logo + '" style="height:100px;width:100px;" alt="' + data.shop.shop_name + '"></div><div class="content-details"><h5 class="chatordertitlemodel">' + data.shop.shop_owner + '</h5><p>' + data.shop.shop_contact + '</p><div class="chat-product-price">' + data.shop.shop_email + '</div></div>');
                        // });


                        $('#cusChatShopModal').modal('toggle');

                    }

                });

            } else {
                $("#errormessage").html("Please Enter all Filled");
            }

        });
    /**/
    </script>
                <script>
        $("#mb-menu-toshow").click(function(){
  $("aside").css("left", "0");
});
       $("aside .close-menu").click(function(){
  $("aside").css("left", "-230px");
});
    </script>
<script>
            
              
            function  getLocation() {
                   if (navigator.geolocation) {
                       navigator.geolocation.getCurrentPosition((position) => {
                           this.long = position.coords.longitude;
                           this.lat = position.coords.latitude;
                           this.locationErrorMessage = "";
                       }, (error) => {
                           if (error.code === 1) {
                               this.locationErrorMessage = "Please allow location access.";
                           }
                       });
                   } else { 
                       console.log("Geolocation is not supported by this browser.");
                   }
               };
       
           
       
               getLocation();
   </script>
    @stack('custom_js')
</body>

</html>