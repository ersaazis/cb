<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ cb()->getAdminUrl() }}" title='{{ cb()->getAppName()  }}' class="logo">
        <span class="logo-mini">{{ substr(cb()->getAppName(),0,2) }}</span>
        <span class="logo-lg">{{ cb()->getAppName() }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-danger">{{ cb()->session()->countNotifications() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Kamu memiliki {{ cb()->session()->countNotifications() }} notifikasi</li>
                        <li>
                        @php
                            $x=1;
                        @endphp
                        @foreach (cb()->session()->notifications() as $item)
                        <ul class="menu">
                            <li>
                                <a href="{{ cb()->getAdminUrl("notification/go/".$item->id) }}">
                                    <i class="fa fa-bell-o text-red"></i> {{$item->content}}
                                </a>
                            </li>
                        </ul>                            
                        @php
                            if($x++ >= 5)
                                break;
                        @endphp
                        @endforeach
                        </li>
                        <li class="footer"><a href="{{ cb()->getAdminUrl("notification") }}">lihat semua</a></li>
                    </ul>
                </li>
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ cb()->session()->photo() }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ cb()->session()->name() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ cb()->session()->photo()  }}" class="img-circle" alt="User Image"/>
                            <p>
                                {{ cb()->session()->name() }}
                                <small>{{ cb()->session()->roleName() }}</small>
                                <small><em><?php echo date('d F Y')?></em></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ cb()->getProfileUrl() }}" class="btn btn-default btn-flat"><i
                                            class='fa fa-user'></i> {{ cbLang("profile")}}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ cb()->getLogoutUrl() }}" title="{{ cbLang("click_here_to_logout") }}" class="btn btn-danger btn-flat"><i class='fa fa-power-off'></i></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
