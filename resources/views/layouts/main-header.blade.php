<!-- Logo -->
<a href="{{ url('') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><i class="fa fa-cart-plus"></i></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>{{ env('APP_NAME', 'Laravel') }}</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle hidden" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset(\Auth::User()->getImageProfile()) }}" class="user-image img-user" alt="User Image">
                    <span class="hidden-xs">{{ \Auth::User()->getFullname() }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{ asset(\Auth::User()->getImageProfile()) }}" class="img-circle img-user" alt="User Image">
                        <p>
                            {{ \Auth::User()->getFullname() }} - {{ \Auth::User()->getRolesInfo() }}
                            <small>Member since {{ \Carbon\Carbon::parse(\Auth::User()->created_at)->toFormattedDateString() }} </small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ route('profiles.index') }}" class="btn btn-default btn-flat" data-toggle='tooltip' data-placement='top'  data-original-title='Edit Profile'>
                                <i class="fa fa-user-plus"></i>&nbsp;Profile
                            </a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat" data-toggle='tooltip' data-placement='top'  data-original-title='Sign Out'>
                                <i class="fa fa-sign-out"></i>&nbsp;Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>