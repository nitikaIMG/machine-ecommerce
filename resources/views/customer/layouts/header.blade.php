@if(Auth::user())
<!-- header -->



<div class="container-fluid menu-bar">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <nav class="navbar navbar-expand-lg">
               <a class="navbar-brand" href="{{ route('main.home') }}">
               <img src="{{asset('web/images/machine-logo.png') }}" alt="Machine Enquiry">
               </a>
               <div id="mb-menu-toshow">
                  <span class="navbar-toggler-icon"></span>
               </div>
               <!-- start  -->
               <ul class="mobile-cart-notifi">
                  <li class="nav-item dropdown message-nav">
                     <a class="nav-link" href="{{ route('cart') }}" aria-expanded="false">
                     <img src="{{asset('web/images/add.jpg')}}" style="height:27px;"  alt="" class="img-fluid">
                     @if(countCartItem() > 0)
                     <span class="badge">{{ countCartItem() }}</span>
                     @endif
                     </a>
                  </li>
                  <li class="nav-item dropdown notification-nav">
                     <a class="nav-link notificationread" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="{{asset('web/images/notification-icon.png')}}"  alt="" class="img-fluid">
                     @if(getNotificationUser() > 0)
                     <span class="badge" id="notificationscount">{{ getNotificationUser() }}</span>
                     @endif
                     </a>
                     <ul class="dropdown-menu profile-dropdown notification"
                        aria-labelledby="navbarDropdown" style="height:250px;overflow-y: auto;">
                        <li>
                           <div class="profile-blk">
                              <div class="left">
                                 <p class="name">Notification</p>
                              </div>
                              <div class="right">
                                 <a href="{{ route('notificationlist')}}">
                                 <img src="{{asset('web/images/notification-dots.png')}}"  alt="">
                                 </a>
                              </div>
                           </div>
                        </li>
                        <?php 
                           foreach (getUserNotificationSellerData() as $key => $value) {
                            ?>
                        <li>
                           <a class="dropdown-item" href="#">
                           <span class="text"> {{ $value['title'] }}</span>
                           <span class="text"> {{ $value['body'] }}</span>
                           <span class="minutes">{{ \Carbon\Carbon::parse($value['created_at'])->diffForHumans() }}</span>
                           </a>
                        </li>
                        <?php //}    
                           }
                           
                           ?>                   
                     </ul>
                  </li>
               </ul>
               <!-- end  -->
               <button class="navbar-toggler mb-dashboard-toggle" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <form class="d-flex ms-auto serach-wrap" action="{{ route('searchshop') }}" method="GET" id="formsearchshop" >
                     <div class="d-flex ms-auto select-wrap">
                        <!-- <select name="" id="" class="select">
                           <option value="">Abu Dhabi</option>
                           </select> -->
                        <input class="select" type="search" name="searchshpelocation" id="searchshpelocation" placeholder="Search Location"
                           aria-label="Search" value="{{ isset($_GET['searchshpelocation']) ? $_GET['searchshpelocation'] : '' }}">
                        <input id="latshop" type="hidden" name="latshop" value="{{ isset($_GET['latshop']) ? $_GET['latshop'] : '' }}">
                        <input id="lngshop" type="hidden" name="lngshop" value="{{ isset($_GET['lngshop']) ? $_GET['lngshop'] : '' }}">
                     </div>
                     <input class="form-control me-2" type="search" name="shoptitle" id="shoptitle"  value="{{ isset($_GET['shoptitle']) ? $_GET['shoptitle'] : '' }}" placeholder="Search Shop"
                        aria-label="Search">
                     <!--                                        <input id="lat" type="hidden" name="lat">
                        <input id="lng" type="hidden" name="lng"> -->
                     <button class="btn btn-outline-success" id="formsubmitsearchshop" type="button">Search</button>
                  </form>
                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-nav">
                     <li class="nav-item dropdown store-nav">
                        <a class="nav-link" href="{{ route('dashboard') }}" 
                           aria-expanded="false">
                        <img src="{{asset('web/images/house-icon.png')}}"  alt="" class="img-fluid">
                        </a>
                     </li>
                     <li class="nav-item dropdown message-nav">
                        <a class="nav-link" href="{{ route('chat.index') }}" aria-expanded="false">
                        <img src="{{asset('web/images/chat-icon.png')}}"  alt="" class="img-fluid">
                        @if(webMsgUserCount() > 0)
                        <span class="badge" >{{ webMsgUserCount() }}</span>
                        @endif
                        </a>
                     </li>
                     <li class="nav-item dropdown message-nav">
                        <a class="nav-link" href="{{ route('cart') }}" aria-expanded="false">
                        <img src="{{asset('web/images/add.jpg')}}" style="height:27px;"  alt="" class="img-fluid">
                        @if(countCartItem() > 0)
                        <span class="badge" >{{ countCartItem() }}</span>
                        @endif
                        </a>
                     </li>
                     <li class="nav-item dropdown notification-nav">
                        <a class="nav-link notificationread" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('web/images/notification-icon.png')}}"  alt="" class="img-fluid">
                        @if(getNotificationUser() > 0)
                        <span class="badge" id="notificationscount">{{ getNotificationUser() }}</span>
                        @endif
                        </a>
                        <ul class="dropdown-menu profile-dropdown notification"
                           aria-labelledby="navbarDropdown" style="height:250px;overflow-y: auto;">
                           <li>
                              <div class="profile-blk">
                                 <div class="left">
                                    <p class="name">Notification</p>
                                 </div>
                                 <div class="right">
                                    <a href="{{ route('notificationlist')}}">
                                    <img src="{{asset('web/images/notification-dots.png')}}"  alt="">
                                    </a>
                                 </div>
                              </div>
                           </li>
                           <?php 
                              foreach (getUserNotificationSellerData() as $key => $value) {
                               ?>
                           <li>
                              <a class="dropdown-item" href="#">
                              <span class="text"> {{ $value['title'] }}</span>
                              <span class="text"> {{ $value['body'] }}</span>
                              <span class="minutes">{{ \Carbon\Carbon::parse($value['created_at'])->diffForHumans() }}</span>
                              </a>
                           </li>
                           <?php //}    
                              }
                              
                              ?>                                            <!-- <li>
                              <a class="dropdown-item" href="#">
                                  <span class="text">Excepteur sint occaecat cupidatat</span>
                                  <span class="minutes">2mins</span>
                              </a>
                              </li>
                              <li>
                              <a class="dropdown-item" href="#">
                                  <span class="text">Excepteur sint occaecat cupidatat</span>
                                  <span class="minutes">2mins</span>
                              </a>
                              </li>
                              <li>
                              <a class="dropdown-item" href="#">
                                  <span class="text">Excepteur sint occaecat cupidatat</span>
                                  <span class="minutes">2mins</span>
                              </a>
                              </li>
                              <li>
                              <a class="dropdown-item" href="#">
                                  <span class="text">Excepteur sint occaecat cupidatat</span>
                                  <span class="minutes">2mins</span>
                              </a>
                              </li> -->
                        </ul>
                     </li>
                     <li class="nav-item dropdown profile-nav">
                        <a class="nav-link user_img" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                        @if(isset(Auth::user()->profile_pic))
                        <img src="{{ storage_url(Auth::user()->profile_pic) }}"  alt="" class="img-fluid">
                        @else
                        <img src="{{asset('web/images/profie-icon.png')}}"  alt="" class="img-fluid">
                        @endif
                        </a>
                        <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                           <li><a class="dropdown-item" href="#">Action</a></li>
                           <li><a class="dropdown-item" href="#">Another action</a></li>
                           <li>
                               <hr class="dropdown-divider">
                           </li>x
                           <li><a class="dropdown-item" href="#">Something else here</a></li>
                           </ul> -->
                     </li>
                     <li class="nav-item dropdown quick-nav">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(!empty(session()->get('user_data')))
                        {{ session()->get('user_data')['name'] }}
                        @endif
                        </a>
                        <ul class="dropdown-menu profile-dropdown" aria-labelledby="navbarDropdown">
                           <li>
                              <div class="profile-blk">
                                 <div class="left">
                                    <p class="name">{{ Auth::user()->name }}</p>
                                    <p class="email">{{ Auth::user()->email }}</p>
                                    <p class="phone">+91 {{ Auth::user()->phone }}</p>
                                 </div>
                                 <div class="right">
                                    <a href="{{route('account')}}" class="edit">Edit</a>
                                 </div>
                              </div>
                           </li>
                           <li style="display:none">
                              <div class="dropdown-item">
                                 <a href="#">
                                 <i class="icon"><img
                                    src="{{asset('web/images/dropdown-icon/notification.png')}}" 
                                    alt=""></i> Notification
                                 </a>
                                 <div class="switch-btn">
                                    <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                    </label>
                                 </div>
                              </div>
                           </li>
                           <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="icon"><img
                              src="{{asset('web/images/dropdown-icon/address.png')}}" 
                              alt=""></i>Manage Address</a></li>
                           <li style="display:none">
                              <div class="dropdown-item">
                                 <a href="#">
                                 <i class="icon"><img
                                    src="{{asset('web/images/dropdown-icon/permission.png')}}" 
                                    alt=""></i>Access Permission
                                 </a>
                                 <div class="switch-btn">
                                    <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                    </label>
                                 </div>
                              </div>
                           </li>
                           <li><a class="dropdown-item" href="{{ route('about-us') }}"><i class="icon"><img
                              src="{{asset('web/images/dropdown-icon/about.png')}}" 
                              alt=""></i>About
                              us</a>
                           </li>
                           <!-- <li><a class="dropdown-item" href="#"><i class="icon"><img
                              src="{{asset('web/images/dropdown-icon/language.png')}}" 
                              alt=""></i>Language</a></li>                                              <li><a class="dropdown-item" href="#"><i class="icon"><img
                              src="{{asset('web/images/dropdown-icon/country.png')}}" 
                              alt=""></i>Country</a></li> -->
                           <li><a class="dropdown-item" href="{{ route('help_support') }}"><i class="icon"><img
                              src="{{asset('web/images/dropdown-icon/help.png')}}" 
                              alt=""></i>Help &
                              Support</a>
                           </li>
                           <li><a class="dropdown-item" href="{{route('sessionlogout')}}"><i class="icon"><img
                              src="{{asset('web/images/dropdown-icon/log-out.png')}}" 
                              alt=""></i>Logout</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
      </div>
   </div>
</div>


@else
<!-- header -->
<div class="menu-bar home-page">
   <div class="border-bottom">
      <div class="container max-1170">
         <div class="row">
            <div class="col-md-12">
               <nav class="navbar navbar-expand-lg">
                  <div class="container-fluid">
                     <a class="navbar-brand" href="{{ route('main.home') }}">
                     <img src="{{ asset('web/images/machine-logo.png') }}" alt="Machine Enquiry">
                     </a>
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-nav">
                           <!-- <li class="nav-item">
                              <a class="nav-link" href="#" data-bs-toggle="modal"
                                  data-bs-target="#shop-location">
                                  Add Shop
                              </a>
                              </li> -->
                           <!-- <li class="nav-item">
                              <a class="nav-link" href="#" data-bs-toggle="modal"
                                  data-bs-target="#reset-password">
                                  Reset Password
                              </a>
                              </li> -->
                           <!-- <li class="nav-item">
                              <a class="nav-link" href="" data-bs-toggle="modal"
                                  data-bs-target="#otp">
                                  OTP
                              </a>
                              </li> -->
                           <li class="nav-item">
                              <a class="nav-link" href="" data-bs-toggle="modal"
                                 data-bs-target="#login"  data-backdrop="static" data-keyboard="false">
                              Login
                              </a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="" data-bs-toggle="modal"
                                 data-bs-target="#create-new-account" data-backdrop="static" data-keyboard="false">
                              Sign up
                              </a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link get-app" href="#">
                              Get the App
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </nav>
            </div>
         </div>
      </div>
   </div>
   <div class="search-section">
      <div class="container max-1170">
         <div class="row">
            <div class="col-md-12">
               <div class="up-logo">
                  <img src="{{asset('web/images/machine-logo.png')}}"  alt="">
               </div>
               <h1 class="title">Buying online on the local market has never been easier. </h1>
            </div>
            <div class="col-md-12">
               <form action="{{ route('searchshop') }}" method="GET" id="formsearchshop" class="formsearchshop">
                  <div class="header-search">
                     <!-- <select name="" id="" class="select">
                        <option value="">Mina Al Arab, AI Riffa</option>
                        </select> -->
                     <input class="select" type="search" name="searchshpelocation" id="searchshpelocation" placeholder="Search"
                        aria-label="Search">
                     <input id="latshop" type="hidden" name="latshop">
                     <input id="lngshop" type="hidden" name="lngshop">
                     <div class="search-wrapper">
                        <input type="text" class="form-control searchshoptitle" id="shoptitle" name="shoptitle" placeholder="Search here">
                        <button type="button" id="formsubmitsearchshop" class="serach-btn">Search</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


@endif
@push('custom_js')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB-Ltp4OCt-4vHQ1Ej656YjDlLDTdDKcWk
   "></script>     
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script type="text/javascript">
   let Search = {
     
       inputAutocomplete: document.getElementById('searchfield'),
       inputLat: $("input[name=lat]"),
       inputLng: $("input[name=lng]"),
       map: {},
       geocoder: new google.maps.Geocoder(),
       autocomplete: {},
       init: function () {
           let _this = this;
   
           this.autocomplete = new google.maps.places.Autocomplete(this.inputAutocomplete);
   
           let latLng = new google.maps.LatLng(-23.6815314, -46.875502);
           if(this.inputLat.val() && this.inputLng.val()){
               latLng = new google.maps.LatLng(this.inputLat.val(), this.inputLng.val());
           }
   
          
   
           this.autocomplete.addListener('place_changed', function () {
               let place = _this.autocomplete.getPlace();
   
               _this.inputLat.val(place.geometry.location.lat());
               _this.inputLng.val(place.geometry.location.lng());
   
               let latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
   
               // create marker
               let marker = new google.maps.Marker({
                   position: latlng,
                   map: _this.map,
                   draggable: true
               });
               _this.map.setCenter(latlng);
   
              
           })
       },
      
      
      
      
      
   
   };
   /*for home page search*/
   let SearchShope = {
     
       inputAutocomplete: document.getElementById('searchshpelocation'),
       inputLat: $("input[name=latshop]"),
       inputLng: $("input[name=lngshop]"),
       map: {},
       geocoder: new google.maps.Geocoder(),
       autocomplete: {},
       init: function () {
           let _this = this;
   
           this.autocomplete = new google.maps.places.Autocomplete(this.inputAutocomplete);
   
           let latLng = new google.maps.LatLng(-23.6815314, -46.875502);
           if(this.inputLat.val() && this.inputLng.val()){
               latLng = new google.maps.LatLng(this.inputLat.val(), this.inputLng.val());
           }
   
          
   
           this.autocomplete.addListener('place_changed', function () {
               let place = _this.autocomplete.getPlace();
   
               _this.inputLat.val(place.geometry.location.lat());
               _this.inputLng.val(place.geometry.location.lng());
   
               let latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
   
               // create marker
               let marker = new google.maps.Marker({
                   position: latlng,
                   map: _this.map,
                   draggable: true
               });
               _this.map.setCenter(latlng);
   
              
           })
       },
      
      
      
      
      
   
   };
   /*end*/
   $(document).ready(function(){
    Search.init();
    var BasedUrl=$("#Baseurl").val();
    $(".notificationread").click(function(){
      // alert("dfdffdfdf");
    var $this = $(this);
    // var patientid = $this.data('patientid');
    $.ajax({
                // url: BasedUrl+"customer/notificationread?patientid=" + $(this).data('patientid'),
                url: BasedUrl+"customer/notificationread",
                method: 'GET',
                success: function(data) {
                  $("#notificationscount").load(location.href + " #notificationscount");
                  $(".notificationscount").load(location.href + " .notificationscount");
                    // $('#facilationcenter_list').html(data.facilationcentere);
                }
            });
   
    });
    SearchShope.init();
    /**/
    $('#formsubmitsearchshop').click( function() {
        
        var searchshoptitle = $("#shoptitle").val().length;
        var lngshop = $("#lngshop").val().length;
        var latshop = $("#latshop").val().length;
        
        if(searchshoptitle !=0 || lngshop != 0 || latshop != 0){
            var loggedIn = {{ auth()->check() ? 'true' : 'false' }};
            
            if(loggedIn){
   
                $('#formsearchshop').submit();
                // alert('Logged In as user!');
            }else{
   
                var shopname = $("#shoptitle").val();
                var searchshpelocation = $("#searchshpelocation").val();
                var shoplng = $("#lngshop").val();
                var shoplat =  $("#latshop").val();
                $('#login').modal('toggle');
                localStorage.setItem("searchshpelocation", searchshpelocation);
                localStorage.setItem("shoptitle", shopname);
                localStorage.setItem("lngshop", shoplng);
                localStorage.setItem("latshop", shoplat);
   
                // $("#shoptitlelog").val(shopname);
                // $("#lngshoplog").val(shoplng);
                // $("#latshoplog").val(shoplat);
                // let lastname = localStorage.getItem('shoptitle');
                // alert(lastname+' '+'not Logged In as user!');
            }
            
        }else{
            // Swal.fire('Please Enter Location or Shop Name');
            swal({
                            title: "Error",
                            text: "Please Enter Location or Shop Name",
                            icon: "error",
                            button: "Ok",
                            });
        }
    
    });
   
      
    $(".chatorderid").click(function(e){
                          var chatorderid = $(this).data("orderid");
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
                     url: "{{ url('orderchatid') }}",
                     data:{chatorderid:chatorderid},
   
                     success:function(data){
                         // alert(data.order_no);
                         // alert(data.date);
                         $("#chatorderidmodel").text('Order Id:'+data.order_no);
                         $("#chatordermodel").html('');
                         $.each(data.items,function(key,value){
                            // alert(value.title);
                            $("#chatordermodel").append('<div class="img-wrap"><img src="'+value.image+'" style="height:100px;width:100px;" alt="'+value.title+'"></div><div class="content-details"><h5 class="chatordertitlemodel">'+value.title+'</h5><p>'+value.short_description+'</p><div class="chat-product-price">'+value.currency+' '+value.price+'<span> Qty:'+value.quantity+' </span></div></div>');
                         });
                        $('#cusChatOrderModal').modal('toggle');
                       
                     }
   
                  });
   
              }else{
                $("#errormessage").html("Please Enter all Filled");
              }
                       
                          
   
            });
    /**/
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
                     url: "{{ url('productchatid') }}",
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
                    url: "{{ url('shopchatid') }}",
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
   });
</script>
<script>        
   function  getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition((position) => {
                  this.long = position.coords.longitude;
                  this.lat = position.coords.latitude;
                  this.locationErrorMessage = "";
                  $.ajax({
                  type:'POST',
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  },
                   url: "{{ url('session-store-lat-long') }}",
                  data:{long:long,lat:lat},
   
                  success:function(data){
                     //  console.log(data);
                  }
                  });				
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
<script>
   $("#mb-menu-toshow").click(function(){
   $("aside").css("left", "0");
   });
   $("aside .close-menu").click(function(){
   $("aside").css("left", "-230px");
   });
</script>
@endpush