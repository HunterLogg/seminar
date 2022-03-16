@extends('admin.layouts.header')
@section('contents')
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="/admin" class="logo">
        Admin Page
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #3 overloaded.</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="img" src="">
                <span class="username">{{ Auth::user()->name }}</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fa fa-key"></i>Log Out
                </a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    <input type="hidden" name="redirect" value="admin">
                    @csrf
                </form>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="/admin">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu dcjq-parent-li">
                    <a class=" dcjq-parent" href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>User</span>
                    <span class="dcjq-icon"></span></a>
                    <ul class="sub" style="display: block;">
                        <li><a href="/admin/user">List User</a></li>
                        <li><a href="/admin/user/create">Create USer</a></li>
                    </ul>
                </li>
                <li class="sub-menu dcjq-parent-li">
                    <a class=" dcjq-parent" href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Category</span>
                    <span class="dcjq-icon"></span></a>
                    <ul class="sub" style="display: block;">
                        <li><a href="/admin/category">List Category</a></li>
                        <li><a href="/admin/category/create">Create Category</a></li>
                    </ul>
                </li>
                <li class="sub-menu dcjq-parent-li">
                    <a class=" dcjq-parent" href="javascript:;">
                        <i class="fa fa-braille"></i>
                        <span>Brand</span>
                    <span class="dcjq-icon"></span></a>
                    <ul class="sub" style="display: block;">
                        <li><a href="/admin/brand">List Brand</a></li>
                        <li><a href="/admin/brand/create">Create Brand</a></li>
                    </ul>
                </li>
                <li class="sub-menu dcjq-parent-li">
                    <a class=" dcjq-parent" href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Product</span>
                    <span class="dcjq-icon"></span></a>
                    <ul class="sub" style="display: block;">
                        <li><a href="/admin/product">List Product</a></li>
                        <li><a href="/admin/product/create">Create Product</a></li>
                    </ul>
                </li>
                <li class="sub-menu dcjq-parent-li">
                    <a class=" dcjq-parent" href="javascript:;">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Cart</span>
                    <span class="dcjq-icon"></span></a>
                    <ul class="sub" style="display: block;">
                        <li><a href="/admin/cart">List Cart</a></li>
                        <li><a href="/admin/cart/create">Create Cart</a></li>
                    </ul>
                </li>
                <li class="sub-menu dcjq-parent-li">
                    <a class=" dcjq-parent" href="javascript:;">
                        <i class="fa fa-truck"></i>
                        <span>Order</span>
                    <span class="dcjq-icon"></span></a>
                    <ul class="sub" style="display: block;">
                        <li><a href="/admin/order">Manage Order</a></li>
                    </ul>
                </li>
                
                
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        @yield('content')
        
</section>
 <!-- footer -->
          <div class="footer">
            <div class="wthree-copyright">
              <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
            </div>
          </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>


@endsection