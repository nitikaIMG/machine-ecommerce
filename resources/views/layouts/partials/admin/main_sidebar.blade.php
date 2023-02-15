<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('assets/backend/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{__('Machine ADMIN')}}</span>
    </a>
    @php
        // $CUSTOMER = App\Models\User::CUSTOMER;
        // $VENDOR = App\Models\User::VENDOR;
        // $systemusers = 'systemusers';
        
        $navActive = 'active';
        $menuOpen = 'menu-is-opening menu-open';
        $urlSegmentTwo = request()->segment(2) ?? 'account';
        // @dd($urlSegmentTwo)
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
                    <a href="{{ route('admin.index') }}"
                        class="nav-link {{ $urlSegmentTwo === 'dashboard' ? $navActive : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{__('Dashboard') }}
                        </p>
                    </a>
                </li>
             
                    <li class="nav-item {{ ($urlSegmentTwo === 'users'  || $urlSegmentTwo === 'systemusers') ? $menuOpen : '' }}">
                        <a href="#" class="nav-link {{ $urlSegmentTwo === 'users' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{__('Manage users') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="nav-link {{ $urlSegmentTwo === 'users' && !request()->has('type') ? $navActive : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                       {{__('All') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index', ['type' => 'seller']) }}"
                                    class="nav-link {{ $urlSegmentTwo === 'users' && request()->get('type') == 'seller'? $navActive : '' }}">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>
                                        {{__('Vendor') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index', ['type' => 'customer']) }}"
                                    class="nav-link {{ $urlSegmentTwo === 'users' && request()->get('type') == 'customer'? $navActive : '' }}">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>
                                        {{__('Customer') }}  
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.systemUsers') }}"
                                    class="nav-link {{ $urlSegmentTwo === 'systemusers' ? $navActive : '' }}">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>
                                        {{__('System users') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>


                     <li class="nav-item">
                            <a href="{{ route('admin.ads.index') }}"
                                class="nav-link {{ $urlSegmentTwo === 'magcats' ? $navActive : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    {{__('Ads') }}
                                </p>
                            </a>
                        </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.product_category.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'product_category' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                {{__('Products categories')}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.product.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'product' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                {{__('Products')}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.shops.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'shops' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-store-alt"></i>
                            <p>
                                {{__('Shops')}}
                            </p>
                        </a>
                    </li>

                     <li class="nav-item">
                        <a href="{{ route('admin.content_manager.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'content_manager' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>
                                {{__('Content manager') }}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.banner.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'banner' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>
                                {{__('Banner manager') }}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item {{ in_array($urlSegmentTwo, ['reports']) ? $menuOpen : '' }}">
                        <a href="#"
                            class="nav-link {{ in_array($urlSegmentTwo, ['reports']) ? $navActive : '' }}">
                            <i class="nav-icon fas fa-photo-video"></i>
                            <p>
                                 {{__('Report manager')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.userreport',['type'=>'customer'])}}"
                                    class="nav-link {{ $urlSegmentTwo === 'userreport' ? $navActive : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>
                                        {{__('User registration')}}
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.userreport',['type'=>'seller'])}}"
                                    class="nav-link {{ $urlSegmentTwo === 'users' ? $navActive : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>
                                         {{__('Vendor registration')}}
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.contacts.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'contacts' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-store-alt"></i>
                            <p>
                                {{__('Contact listing')}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item {{ in_array($urlSegmentTwo, ['complaints']) ? $menuOpen : '' }}">
                        <a href="#"
                            class="nav-link {{ in_array($urlSegmentTwo, ['complaints']) ? $navActive : '' }}">
                            <i class="nav-icon fas fa-photo-video"></i>
                            <p>
                                Manage complaints
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.complaints.index',['status'=>0])}}"
                                    class="nav-link {{ $urlSegmentTwo === 'index' ? $navActive : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>
                                        Pending
                                        
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.complaints.index',['status'=>1])}}"
                                    class="nav-link {{ $urlSegmentTwo === 'index' ? $navActive : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>
                                        In progress
                                       
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.complaints.index',['status'=>2])}}"
                                    class="nav-link {{ $urlSegmentTwo === 'index' ? $navActive : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>
                                        Completed
                                       
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.order.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'order' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-cart-arrow-down"></i>
                            <p>
                                {{__('Orders')}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.chat.index') }}"
                            class="nav-link {{ $urlSegmentTwo === 'chat' ? $navActive : '' }}">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>
                                {{__('Chat')}}
                            </p>
                        </a>
                    </li>
            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
