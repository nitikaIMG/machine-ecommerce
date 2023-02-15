 <!-- header -->
 <div class="container-fluid menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ route('seller.dashboard') }}">
                                <img src="{{ asset('seller/images/machine-logo.png') }}" alt="Machine Enquiry">
                            </a>
                               <div id="mb-menu-toshow">
                                    <span class="navbar-toggler-icon"></span>
                                </div>
                                <!-- start  -->
                                <ul class="mobile-cart-notifi">
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
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- <div class="d-flex ms-auto select-wrap">
                                    <select name="" id="" class="select">
                                        <option value="">Abu Dhabi</option>
                                    </select>
                                </div> -->
                                <!-- <form class="d-flex ms-auto serach-wrap">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form> -->
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-nav">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('seller.dashboard') }}">
                                            <img src="{{ asset('seller/images/house-icon.png') }}" alt="" class="img-fluid">
                                        </a>
                                       
                                    </li>
                                   <!-- <li class="nav-item dropdown notification-nav">
                                        <a href="{{ route('seller.chat.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('seller/images/chat-icon.png') }}" alt="" class="img-fluid">
					                @if(webMsgUserCount() > 0)
                                           	 <span class="badge">{{ webMsgUserCount() }}</span>
                                            @endif
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link notificationread" href="{{ route('seller.chat.index') }}"  >
                                            <img src="{{ asset('seller/images/chat-icon.png') }}" alt="" class="img-fluid">
                                            @if(webMsgUserCount() > 0)
                                            <span class="badge" >{{ webMsgUserCount() }}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown notification-nav">
                                        <a class="nav-link notificationread" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('seller/images/notification-icon.png') }}" alt="" class="img-fluid">
                                            @if(getNotificationSeller() > 0)
                                            <span class="badge" id="notificationscount">{{ getNotificationSeller() }}</span>
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu profile-dropdown notification" aria-labelledby="navbarDropdown" style="height:250px;overflow-y: auto;">
                                            <li>
                                                <div class="profile-blk">
                                                    <div class="left">
                                                        <p class="name">Notification</p>
                                                    </div>
                                                    <div class="right">
                                                        <a href="{{route('seller.notificationlist')}}">
                                                            <img src="{{ asset('seller/images/notification-dots.png') }}" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php 
                                            foreach (getSellerNotificationUserData() as $key => $value) {
                                           
                                            
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
                                            <!-- <li>
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
                                        <a class="nav-link user_img" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if(isset(Auth::user()->profile_pic))
                                        <img src="{{ storage_url(Auth::user()->profile_pic) }}"  alt="" class="img-fluid">
                                        @else
                                        <img src="{{asset('seller/images/profie-icon.png')}}"  alt="" class="img-fluid">
                                        @endif   
                                       
                                        </a>
                                        <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul> -->
                                    </li>
                                    <li class="nav-item dropdown quick-nav">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ isset(auth()->user()->name) ? auth()->user()->name : ''}}
                                        </a>
                                        <ul class="dropdown-menu profile-dropdown profile-right" aria-labelledby="navbarDropdown">
                                            <li>
                                                <div class="profile-blk">
                                                    <div class="left">
                                                        <p class="name">{{ isset(auth()->user()->name) ? auth()->user()->name : ''}}</p>
                                                        <p class="email">{{ isset(auth()->user()->email) ? auth()->user()->email : ''}}</p>
                                                        <p class="phone">{{ isset(auth()->user()->phone) ? auth()->user()->phone : ''}}</p>
                                                    </div>
                                                    <div class="right">
                                                        <a href="{{ route('seller.settings') }}" class="edit">Edit</a>
                                                    </div>
                                                    <a href="{{ route('seller.shops.index') }}" class="manage-shop">
                                                        <i class="icon">
                                                            <img src="{{ asset('seller/images/manageshop-icon.png') }}" alt="">
                                                        </i>
                                                        <span>Manage a Shop</span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-item">
                                                    <a href="#">
                                                        <i class="icon"><img src="{{ asset('seller/images/dropdown-icon/notification.png') }}" alt=""></i> Notification
                                                    </a>
                                                    <div class="switch-btn">
                                                        <label class="switch">
                                                            <input type="checkbox" checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('seller.product.list') }}"><i class="icon"><img src="{{ asset('seller/images/dropdown-icon/address.png') }}" alt=""></i>My Products</a></li>
                                            <li><a class="dropdown-item" href="{{ route('seller.shops.create') }}"><i class="icon"><img src="{{ asset('seller/images/dropdown-icon/address.png') }}" alt=""></i>Add a Shop</a></li>
                                            <!-- <li>
                                                <div class="dropdown-item">
                                                    <a href="#">
                                                        <i class="icon"><img src="{{ asset('seller/images/dropdown-icon/permission.png') }}" alt=""></i>Access Permission
                                                    </a>
                                                    <div class="switch-btn">
                                                        <label class="switch">
                                                            <input type="checkbox">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li> -->
                                            <li><a class="dropdown-item" href="{{ route('about-us') }}"><i class="icon"><img src="{{ asset('seller/images/dropdown-icon/about.png') }}" alt=""></i>About us</a></li>
                                            <!-- <li><a class="dropdown-item" href="#"><i class="icon"><img src="{{ asset('seller/images/dropdown-icon/language.png') }}" alt=""></i>Language</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="icon"><img src="{{ asset('seller/images/dropdown-icon/country.png') }}" alt=""></i>Country</a></li> -->
                                            <li><a class="dropdown-item" href="{{ route('seller.help_and_support') }}"><i class="icon"><img src="{{ asset('seller/images/dropdown-icon/help.png') }}" alt=""></i>Help & Support</a></li>
                                            <li>
                                            <form id="logout_form" action="{{ route('seller.logout') }}" method="post">
                                                @csrf
                                                <a class="dropdown-item" href="javascript:;" role="button" title="logout"
                                                    onclick="event.preventDefault(); $('#logout_form').submit();">    
                                                <img src="{{ asset('seller/images/dropdown-icon/log-out.png') }}" alt=""></i>   &nbsp;&nbsp;Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>


      <!-- Mobile Side Menu -->
      <div class="mobile-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-end">
                    <img src="{{ asset('seller/images/menu-icon.svg')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

