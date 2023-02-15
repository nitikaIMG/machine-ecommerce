  <!-- Footer -->
  <footer class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">About Upshop</div>
                    <p class="text">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">Quick Links</div>
                    <ul class="ftr-links">
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('seller.shops.create') }}">Add Shop</a></li>
                        <li><a href="">Download the App</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">Term and Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">Contact Us</div>
                    <ul class="address">
                        <li><i class="fa fa-map-marker"></i> <span>3 Newbridge Court Chino Hills,  CA91709, United Arab Emirates</span></li>
                        <li><i class="fa fa-phone"></i> <span>987 654 3210</span></li>
                        <li><i class="fa fa-envelope"></i> <span>info@upshop.com</span></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="ftr-hd">Subscribe</div>
                    <form action="" class="news-letter">
                        <input type="text">
                        <button class="send-btn"></button>
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

    <div class="footer-rights">
        <p>Copyright © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
    <!-- Modal -->
        <div class="modal fade chat-modal" id="sellerChatOrderModal" tabindex="-1"         aria-labelledby="sellerChatOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                                <h5 id="chatorderidmodel"></h5>
                        <div class="virtual-chat even chat-product-wrap chatordermodel" id="chatordermodel">                         
                                                                           
                        </div>

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