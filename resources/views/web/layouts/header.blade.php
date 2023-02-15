@if(!empty(session()->get('user_data')) && !request()->routeIs('home') )
    <!-- header -->
    <div class="container-fluid menu-bar">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                                <img src="{{asset('web/images/machine-logo.png') }}" alt="Machine Enquiry">
                            </a>
                                    
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="d-flex ms-auto select-wrap">
                                    <select name="" id="" class="select">
                                        <option value="">Abu Dhabi</option>
                                    </select>
                                </div>
                                <form class="d-flex ms-auto serach-wrap">
                                    <input class="form-control me-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-nav">
                                    <li class="nav-item dropdown store-nav">
                                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{asset('web/images/house-icon.png')}}"  alt="" class="img-fluid">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown message-nav">
                                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{asset('web/images/chat-icon.png')}}"  alt="" class="img-fluid">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown notification-nav">
                                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{asset('web/images/notification-icon.png')}}"  alt="" class="img-fluid">
                                            <span class="badge">3</span>
                                        </a>
                                        <ul class="dropdown-menu profile-dropdown notification"
                                            aria-labelledby="navbarDropdown">
                                            <li>
                                                <div class="profile-blk">
                                                    <div class="left">
                                                        <p class="name">Notification</p>
                                                    </div>
                                                    <div class="right">
                                                        <a href="">
                                                            <img src="{{asset('web/images/notification-dots.png')}}"  alt="">
                                                        </a>
                                                    </div>
                                                </div>
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
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown profile-nav">
                                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{asset('web/images/profie-icon.png')}}"  alt="" class="img-fluid">
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
                                        <ul class="dropdown-menu profile-dropdown" aria-labelledby="navbarDropdown" style="height:250px;overflow-y: auto;">
                                            <li>
                                                <div class="profile-blk">
                                                    <div class="left">
                                                        <p class="name">Asad Kalbonesh</p>
                                                        <p class="email">kalbonesh@msn.com</p>
                                                        <p class="phone">9178569852</p>
                                                    </div>
                                                    <div class="right">
                                                        <a href="" class="edit">Edit</a>
                                                    </div>
                                                    <a href="" class="manage-shop">
                                                        <i class="icon">
                                                            <img src="{{asset('web/images/manageshop-icon.png')}}"  alt="">
                                                        </i>
                                                        <span>Manage a Shop</span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
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
                                            <li><a class="dropdown-item" href="#"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/address.png')}}" 
                                                            alt=""></i>Manage Address</a></li>
                                            <li>
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
                                            <li><a class="dropdown-item" href="#"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/about.png')}}" 
                                                            alt=""></i>About
                                                    us</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/language.png')}}" 
                                                            alt=""></i>Language</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/country.png')}}" 
                                                            alt=""></i>Country</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/help.png')}}" 
                                                            alt=""></i>Help &
                                                    Support</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="icon"><img
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
                                <a class="navbar-brand" href="#">
                                    <img src="{{ asset('web/images/machine-logo.png') }}" alt="Machine Enquiry">
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-bs-toggle="modal"
                                                data-bs-target="#shop-location">
                                                Add Shop
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-bs-toggle="modal"
                                                data-bs-target="#reset-password">
                                                Reset Password
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="" data-bs-toggle="modal"
                                                data-bs-target="#create-new-account">
                                                Create New Account
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="" data-bs-toggle="modal"
                                                data-bs-target="#otp">
                                                OTP
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="" data-bs-toggle="modal"
                                                data-bs-target="#login">
                                                Login
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="" data-bs-toggle="modal"
                                                data-bs-target="#signup">
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
                        <div class="header-search">
                            <select name="" id="" class="select">
                                <option value="">Mina Al Arab, AI Riffa</option>
                            </select>
                            <div class="search-wrapper">
                                <input type="text" class="form-control" placeholder="Search here">
                                <button class="serach-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
