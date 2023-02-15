@php

$navActive = 'active';
$menuOpen = 'menu-is-opening menu-open';
$urlSegmentTwo = request()->segment(1) ?? 'dashboard';
@endphp
<style>
    
@media screen and (max-width:991px) {
    .mb-dashboard-toggle
    {
        display:none
    }
}
</style>
<aside class="card">
    <div class="close-menu">
        <i class="fa fa-close"></i>
    </div>
    <ul class="side-nav">
        <!-- start  -->

                                     <li class="nav-item dropdown profile-nav mobile--left-menu">
                                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            @if(isset(Auth::user()->profile_pic))
                                            <img src="{{ storage_url(Auth::user()->profile_pic) }}"  alt="" style="height:50px; border-radius: 50%;" class="img-fluid">
                                            @else
                                            <img src="{{asset('web/images/profie-icon.png')}}"  alt="" class="img-fluid">
                                            @endif
                                        </a>
                                        <div class="mobile-name-details">
                                         <span class="name">{{ Auth::user()->name }}</span>
                                         
                                            <div class="phone">+91 {{ Auth::user()->phone }}</div>
                                            
                                            </div>
                                    </li>
                                            <li class="mobile--left-menu">
                                                <div class="profile-blk profile-blk-mb">
                                                    <div class="left">
                                                        <p class="email">{{ Auth::user()->email }}</p>
                                                     
                                                    </div>
                                                    <div class="right">
                                                        <a href="{{route('account')}}" class="edit edit-desk">Edit</a>
                                                         <a href="{{route('account')}}" class="edit edit-mobile">
                                                            <i class="fa fa-pencil"></i>
                                                         </a>
                                                    </div>
                                                </div>
                                            </li>
                                    <!-- ends  -->
        <li>
            <a href="{{ url('dashboard') }}" class="{{ $urlSegmentTwo === 'dashboard' ? $navActive : '' }}">
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/home.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/home-hover.png') }}" alt="" class="icon-hover">
                </i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('favourites') }}" class="{{ $urlSegmentTwo === 'favourites-shops' ? $navActive : '' }}">
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/heart.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/heart-hover.png') }}" alt="" class="icon-hover">
                </i>Favourites Shop
            </a>
        </li>

        <li>
            <a href="{{ route('favourites.product') }}" class="{{ $urlSegmentTwo === 'favourites-products' ? $navActive : '' }}">
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/heart.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/heart-hover.png') }}" alt="" class="icon-hover">
                </i>Favourites Product
            </a>
        </li>
        <li>
            <a href="{{route('quatations')}}" class="{{ $urlSegmentTwo === 'quatations' ? $navActive : '' }}">
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/order.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/order-hover.png') }}" alt="" class="icon-hover">
                </i> RFQ's
            </a>
        </li>
        <li>
            <a href="{{route('order')}}" class="{{ $urlSegmentTwo === 'order' ? $navActive : '' }}">
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/order.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/order-hover.png') }}" alt="" class="icon-hover">
                </i> Orders
            </a>
        </li>
        <li>
            <a href="{{route('chat.index')}}" class="{{ $urlSegmentTwo === 'chat' ? $navActive : '' }}">
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/chat.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/chat-hover.png') }}" alt="" class="icon-hover">
                </i> Chat
            </a>
        </li>
        <li>
            <a href="{{route('account')}}" class="{{ $urlSegmentTwo === 'account' ? $navActive : '' }}">
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/setting.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/setting-hover.png') }}" alt="" class="icon-hover">
                </i> Settings
            </a>
        </li>
         <li class="mobile--left-menu"><a class="dropdown-item" href="{{ route('settings') }}"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/address.png')}}" 
                                                            alt="" class="desk-menu-icon">
                                                        <img
                                                            src="{{asset('web/images/dropdown-icon/address2.png')}}" 
                                                            alt="" class="mb-menu-icon" width="18"></i> Manage Address</a></li>
                                          
                                            <!-- <li class="mobile--left-menu"><a class="dropdown-item" href="{{ route('about-us') }}"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/about.png')}}" 
                                                            alt="" class="desk-menu-icon">
                                                         <img
                                                            src="{{asset('web/images/dropdown-icon/address2.png')}}" 
                                                            alt="" class="mb-menu-icon"></i> About
                                                    us</a></li>
                                      
                                            <li class="mobile--left-menu"><a class="dropdown-item" href="{{ route('help_support') }}"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/help.png')}}" 
                                                            alt="" class="desk-menu-icon">
                                                         <img
                                                            src="{{asset('web/images/dropdown-icon/info.png')}}" 
                                                            alt="" class="mb-menu-icon" width="18" style="margin-right: 4px;margin-left: 5px;"></i>  Help &
                                                    Support</a></li> -->
                                            <li class="mobile--left-menu"><a class="dropdown-item" href="{{route('sessionlogout')}}"><i class="icon"><img
                                                            src="{{asset('web/images/dropdown-icon/log-out.png')}}" 
                                                            alt="" class="desk-menu-icon">
                                                         <img
                                                            src="{{asset('web/images/dropdown-icon/power-off.png')}}" 
                                                            alt="" class="mb-menu-icon"  width="18" style="margin-right: 4px;margin-left: 5px;"></i>  Logout</a></li>



                                    <li class="nav-item dropdown quick-nav mobile--left-menu mb-profule-dropdown-arrow">
                                        <a class="nav-link dropdown-toggle mb-dis-none" href="#" id="navbarDropdown"
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
                                           
                                        </ul>
                                    </li>
                                    
<!-- end  -->


        <!-- <li>
            <a href="{{route('sessionlogout')}}" >
                <i class="icon">
                    <img src="{{ asset('web/images/menu-icon/logout.png') }}" alt="" class="icon-img">
                    <img src="{{ asset('web/images/menu-icon/logout-hover.png') }}" alt="" class="icon-hover">
                </i> Logout
            </a>
        </li> -->
    </ul>
</aside>