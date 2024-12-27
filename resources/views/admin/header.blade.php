<header class="main-header">
    <!-- Logo -->
    <a  class="logo">Admnistration</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Administrator</span>
                    </a>
                    <ul class="dropdown-menu">

                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 pull-right">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                                </form>
                                
                            </div>  
                        </li>
                        <!-- Menu Footer-->
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>