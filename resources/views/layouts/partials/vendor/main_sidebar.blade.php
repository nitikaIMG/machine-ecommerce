<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('seller.index') }}" class="brand-link">
        <img src="{{ asset('assets/backend/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{__('Machine SELLER')}}</span>
    </a>
    @php
        $navActive = 'active';
        $menuOpen = 'menu-is-opening menu-open';
        $urlSegmentTwo = request()->segment(2) ?? 'account';
    @endphp
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @php($userdata = request()->user())
            <div class="image">
                <img src="{{ asset('assets/backend/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:;" class="d-block">{{ $userdata->name }}</a>
                <span class="badge badge-pill badge-success">{{ $userdata->type_text }}</span>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('seller.index') }}"
                        class="nav-link {{ $urlSegmentTwo === 'dashboard' ? $navActive : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           {{__('Dashboard')}}
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
            <li class="nav-item">
                <a href="{{ route('seller.product.index') }}"
                    class="nav-link {{ $urlSegmentTwo === 'product' ? $navActive : '' }}">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>
                        {{__('Products')}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('seller.order.index') }}"
                    class="nav-link {{ $urlSegmentTwo === 'order' ? $navActive : '' }}">
                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                    <p>
                        {{__('Orders')}}
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('seller.product.list') }}"
                    class="nav-link {{ $urlSegmentTwo === 'product.list' ? $navActive : '' }}">
                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                    <p>
                        {{__('My products')}}
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('seller.shops.index') }}"
                    class="nav-link {{ $urlSegmentTwo === 'shops' ? $navActive : '' }}">
                    <i class="nav-icon fas fa-store-alt"></i>
                    <p>
                        {{__('My shops')}}
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('seller.quotations.index') }}"
                    class="nav-link {{ $urlSegmentTwo === 'quotations' ? $navActive : '' }}">
                    <i class="nav-icon fas fa-store-alt"></i>
                    <p>
                        {{__('Quotations')}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('seller.chat.index') }}"
                    class="nav-link {{ $urlSegmentTwo === 'chat' ? $navActive : '' }}">
                    <i class="nav-icon fas fas fa-comments"></i>
                    <p>
                        {{__('Chats')}}
                    </p>
                </a>    
            </li>


            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
