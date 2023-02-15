    <!-- Footer -->
    <footer class="container-fluid">
        <div class="container max-1170">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">About Upshop</div>
                    <p class="text"> @php

                   

                            $result = App\Traits\APICall::callAPI(
                                'POST',config('app.url') .App\Http\Controllers\Customer\EndPoints::STATIC_CONTENT,
                                json_encode([
                                    'slug' => 'about-us',
                                ]),
                            );
                         
                             $content = json_decode($result, true);
                            @endphp
                        
                           {{ isset($content['data']['content']) ? substr($content['data']['content'],0,200) : '' }}...<a href="{{ route('about-us') }}" style="color:white;">more</a>
                        </p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">Quick Links</div>
                    <ul class="ftr-links">
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <!-- <li><a href="">Add Shop</a></li> -->
                        <li><a href="">Download the App</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">Term and Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">Contact Us</div>
                    <ul class="address">
                        <li><i class="fa fa-map-marker"></i> <span>3 Newbridge Court Chino Hills, CA91709, United Arab
                                Emirates</span></li>
                        <li><i class="fa fa-phone"></i> <span>987 654 3210</span></li>
                        <li><i class="fa fa-envelope"></i> <span>info@upshop.com</span></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">Subscribe</div>
                    <form action="" class="news-letter">
                        <input type="email" placeholder="ex:user@upshop.com" name="subscribe" id="subscribe">
                        <button class="send-btn" id="subscribe_btn"></button>
                    </form>
                    <ul class="social-media">
                        <li>
                            <a href="">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>
    <!--  -->
    <!-- Modal -->
        <div class="modal fade chat-modal" id="cusChatOrderModal" tabindex="-1"         aria-labelledby="cusChatOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                



                                <h5 id="chatorderidmodel"></h5>
                        <div class="virtual-chat even chat-product-wrap chatordermodel" id="chatordermodel">                         
                                                                           
                        </div>


                        
                        <!-- <div class="virtual-chat even chat-product-wrap">                         
                            <div class="img-wrap">
                                <img src="images/app-img.png" alt=" ">
                            </div>
                            <div class="content-details">
                                <h5>695 5G Processor</h5>

                                <p>
                                    With this excellent smartphone's flawless performance
                                </p>
                                <div class="chat-product-price">
                                    AED 25.79  <span> Qty:5 </span> 
                                </div>

                            </div>                                               
                        </div> -->



                        
                        <!-- <div class="virtual-chat even chat-product-wrap">                         
                            <div class="img-wrap">
                                <img src="images/3.png" alt=" ">
                            </div>
                            <div class="content-details">
                                <h5>Order No: 194586 </h5>

                                <p>
                                    Philips 125W HPI Lamps- N 125W/541 B22d-3 SG 1SL
                                </p>
                                <div class="chat-product-price">
                                    AED 36.04  <span> Qty:1 </span> 
                                </div>

                            </div>                                               
                        </div> -->
                </div>
               
            </div>
            </div>
        </div>

       <!-- Modal -->

         <!--chat product details Modal -->
        <div class="modal fade chat-modal" id="cusChatProductModal" tabindex="-1"         aria-labelledby="cusChatProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                



                                <!-- <h5 id="chatorderidmodel"></h5> -->
                        <div class="virtual-chat even chat-product-wrap chatproductmodel" id="chatproductmodel">                         
                                                                           
                        </div>




                </div>
               
            </div>
            </div>
        </div>

        <!--chat shop details Modal -->
        <div class="modal fade chat-modal" id="cusChatShopModal" tabindex="-1" aria-labelledby="cusChatShopModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                



                                <!-- <h5 id="chatorderidmodel"></h5> -->
                        <div class="virtual-chat even chat-product-wrap chatshopmodel" id="chatshopmodel">                         
                                                                           
                        </div>




                </div>
               
            </div>
            </div>
        </div>
        <!-- Modal -->

    <div class="footer-rights">
        <p>Copyright 2022 UpShop. All rights reserved.</p>
    </div>
@include('customer.layouts.script')
@push('custom_js')
    <script>
        $('#subscribe_btn').click(function(e) {
            e.preventDefault();
            var subscribe = $('#subscribe').val();
                        $.ajax({
                            url: "{{ route('subscribe') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: "email="+subscribe,
                            type: 'get',
                            dataType: 'json',
                            error: function(xhr, textStatus) {
                                let errorMsg = 'Something went wrong. Please try again.';
                                    errorMsg = xhr.responseJSON.message;
                                   
                                    swal(errorMsg, {
                                    icon: "error",
                                });
                                // $('#apiMsg3').html(
                                //     '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                                //     errorMsg + '</p>');
                                $('.' + formLoader).css('display', 'none');
                                $('.button_' + formLoader).prop('disabled', false);
                            },
                            success: function(data) {
                               
                                if(data.status ==false){
                                    swal(data.data.error.email[0], {
                                    icon: "error",
                                });
                                }

                                if(data.status == 1){
                                    swal(data.message, {
                                    icon: "success",
                                    });
                                }
                            },

                            cache: false,
                            contentType: false,
                            processData: false,
                        });
                    
                
        });

    </script>
@endpush