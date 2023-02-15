<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.settings') }}" role="button" title="settings">
                <i class="fas fa-cog"></i>
            </a>
        </li>
        <li class="nav-item">
            <form id="logout_form" action="{{ route('logout') }}" method="post">
                @csrf
                <a class="nav-link" href="javascript:;" role="button" title="logout"
                    onclick="event.preventDefault(); $('#logout_form').submit();">
                    <i class="fas fa-sign-out-alt">Logout</i>
                </a>
            </form>
        </li>
    </ul>
</nav>
