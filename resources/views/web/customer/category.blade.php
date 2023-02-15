@extends('web.layouts.main')

@push('custom_css')
    <section class="tabs-wrapper">
        <div class="container">
            <h1 class="main-title-tabs">Shop Categories</h1>
            <!-- Nav pills -->
            <ul class="nav nav-pills nav-pill-custom" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" href="#Automobiles" aria-selected="true"
                        role="tab">Automobiles</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="pill" href="#Electrical" aria-selected="false" role="tab"
                        tabindex="-1">Electrical</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" href="#Electrical2" aria-selected="false" role="tab"
                        tabindex="-1">Electrical2</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" href="#Hydraulics" aria-selected="false" role="tab"
                        tabindex="-1">Hydraulics</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content tab-content-custom">
                <div id="Automobiles" class="container tab-pane fade" role="tabpanel"><br>
                    <h3>Automobiles</h3>
                </div>
                <div id="Electrical" class="container tab-pane active show" role="tabpanel"><br>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item">
                                    <a href="">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/18/20/05/light-bulbs-1603766_1280.jpg"
                                            alt="item-1" class="img-fluid">
                                    </a>
                                    <span class="heart-icon">
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span class="offer-box">Up to 60% OFF</span>
                                    <span class="rating-box"><span class="fa fa-star checked"></span>4.5</span>
                                </div>
                                <div class="electrical-item-content">
                                    <div class="electrical-item-title">
                                        <a href="electrical-details.html">Jumbo Electricals</a>
                                        <span>
                                            <a href="electrical-details.html">
                                                <img src="images/electrical/export.png" alt=""></a>
                                        </span>
                                    </div>
                                    <div class="electrical-item-subtitle">
                                        <div class="map-wrapper">
                                            <img src="images/electrical/pin.png" alt="map" class="img-fluid"
                                                width="20px">

                                        </div>
                                        <div class="location-wrapper-txt">
                                            <span class="green-txt">3.5 Kms</span> |
                                            <span class="location-txt">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai - United Arab
                                                Emirates
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clockbox">
                                        <div class="clock-wrapper">
                                            <img src="images/electrical/clock.png" alt="map" class="img-fluid"
                                                width="16px">
                                        </div>
                                        <div class="clock-wrapper-txt">
                                            You can order for today at 10:00 am
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Electrical2" class="container tab-pane fade" role="tabpanel"><br>
                    <div class="row">

                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-icon">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-count">
                                            2
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-icon">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-icon">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-icon">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-icon">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-icon">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="electrical-box-wrapper">
                                <div class="electrical-item whitebg-border-box">
                                    <a href="">
                                        <img src="images/electrical/fan.png" alt="item-1" class="img-fluid">
                                    </a>
                                    <a href=""> <span class="add-item-icon">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                    <a href=""> <span class="grey-heart-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </a>

                                </div>
                                <div class="electrical-item-content">

                                    <div class="electrical-item-subtitle">

                                        <div class="products-name">
                                            <a href="" class="anchor-link">
                                                Khalid Bin Al Waleed Road Near Maktoum Bridge, karama, Dubai
                                                - United Arab Emirates </a>
                                        </div>
                                        <div class="current-type mt-2">AED <strong>15.50</strong> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="Hydraulics" class="container tab-pane fade" role="tabpanel"><br>
                    <h3>Menu 2</h3>
                </div>
            </div>
        </div>
    </section>
@endpush
