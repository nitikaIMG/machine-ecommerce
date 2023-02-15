@php
$navActive = 'active';
$menuOpen = 'menu-is-opening menu-open';
$urlSegmentTwo = request()->segment(2) ?? 'dashboard';
@endphp
<aside class="card">
   <div class="close-menu">
      <i class="fa fa-close"></i>
   </div>
   <ul class="side-nav">
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
      <li>
         <a href="{{ route('seller.dashboard') }}" class="{{ $urlSegmentTwo === 'dashboard' ? $navActive : '' }}" >
         <i class="icon">
         <img src="{{ asset('seller/images/menu-icon/home.png') }}" alt="" class="icon-img">
         <img src="{{ asset('seller/images/menu-icon/home-hover.png') }}" alt="" class="icon-hover">
         </i>  {{__('Home')}}
         </a>
      </li>
      <li>
         <a href="{{ route('seller.quotations.index') }}" class="{{ $urlSegmentTwo === 'rfq' ? $navActive : '' }}">
         <i class="icon">
         <img src="{{ asset('seller/images/menu-icon/rfq.png') }}" alt="" class="icon-img">
         <img src="{{ asset('seller/images/menu-icon/rfq-hover.png') }}" alt="" class="icon-hover">
         </i> {{__('RFQ')}}
         </a>
      </li>
      <li>
         <a href="{{ route('seller.order.index') }}" class="{{ $urlSegmentTwo === 'order' ? $navActive : '' }}">
         <i class="icon">
         <img src="{{ asset('seller/images/menu-icon/order.png') }}" alt="" class="icon-img">
         <img src="{{ asset('seller/images/menu-icon/order-hover.png') }}" alt="" class="icon-hover">
         </i> {{__('Orders')}}
         </a>
      </li>
      <li>
         <a href="{{ route('seller.chat.index') }}" class="{{ $urlSegmentTwo === 'chat' ? $navActive : '' }}">
         <i class="icon">
         <img src="{{ asset('seller/images/menu-icon/chat.png') }}" alt="" class="icon-img">
         <img src="{{ asset('seller/images/menu-icon/chat-hover.png') }}" alt="" class="icon-hover">
         </i> {{__('Chat')}}
         </a>
      </li>
      <li>
         <a href="{{ route('seller.shops.index') }}" class="{{ $urlSegmentTwo === 'shops' ? $navActive : '' }}">
         <i class="icon">
         <img src="{{ asset('seller/images/menu-icon/shop.png') }}" alt="" class="icon-img">
         <img src="{{ asset('seller/images/menu-icon/shop-hover.png') }}" alt="" class="icon-hover">
         </i> {{__('Manage a Shop')}}
         </a>
      </li>
      <li>
         <a href="{{ route('seller.settings') }}" class="{{ $urlSegmentTwo === 'settings' ? $navActive : '' }}">
         <i class="icon">
         <img src="{{ asset('seller/images/menu-icon/setting.png') }}" alt="" class="icon-img">
         <img src="{{ asset('seller/images/menu-icon/setting-hover.png') }}" alt="" class="icon-hover">
         </i> {{__('Settings')}}
         </a>
      </li>
      <li>
      <form id="logout_form" action="{{ route('seller.logout') }}" method="post">
                @csrf
                <a class="nav-link" href="javascript:;" role="button" title="logout"
                    onclick="event.preventDefault(); $('#logout_form').submit();">
                    
                    <i class="icon">
         <img src="{{ asset('seller/images/menu-icon/logout.png') }}" alt="" class="icon-img">
         <img src="{{ asset('seller/images/menu-icon/logout-hover.png') }}" alt="" class="icon-hover">
         </i> {{__('Logout')}}
         </a>
            </form>
         
      </li>
   </ul>
</aside>