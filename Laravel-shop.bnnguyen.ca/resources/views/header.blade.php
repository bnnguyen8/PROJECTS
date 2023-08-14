@php 
if(request()->path() == "about") {
    $active = 'header-v4';
} else {
    $active = '';
}
@endphp
<header class="{{ $active }}">
    @php 
        // $menusHtml = \App\Helpers\Helper::menus($menus); 
        $menusHtml = ""
    @endphp
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="/admin" class="flex-c-m trans-04 p-lr-25">
                        My Account
                    </a>
                    <!-- <a href="#" class="flex-c-m trans-04 p-lr-25">
                        EN
                    </a>
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        USD
                    </a> -->
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="/template/images/icons/logo.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        @php 
                            if(request()->path() == "") {
                                $active = 'active-menu';
                            } else {
                                $active = '';
                            }
                        @endphp
                        <li class="{{ $active }}">
                            <a href="/">Home</a>
                        </li>
                        @php 
                            if(request()->path() == "products") {
                                $active = 'active-menu';
                            } else {
                                $active = '';
                            }
                        @endphp
                        <li class="label1 {{ $active }}" data-label1="hot">
                            <a href="/products">Shop</a>
                        </li>
                        @php 
                            if(request()->path() == "/blogs") {
                                $active = 'active-menu';
                            } else {
                                $active = '';
                            }
                        @endphp
                        <!-- <li class="{{ $active }}">
                            <a href="/blogs">Blog</a>
                        </li> -->
                        @php 
                            if(request()->path() == "/contact") {
                                $active = 'active-menu';
                            } else {
                                $active = '';
                            }
                        @endphp
                        <li class="{{ $active }}">
                            <a href="/contact">Contact</a>
                        </li>
                        @php 
                            if(request()->path() == "/about") {
                                $active = 'active-menu';
                            } else {
                                $active = '';
                            }
                        @endphp
                        <li class="{{ $active }}">
                            <a href="/about">About</a>
                        </li>
                        
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                         data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="/"><img src="/template/images/icons/logo.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a class="label1 rs1" data-label1="hot" href="/products">Shop</a>
            </li>
            <!-- <li class="{{ $active }}">
                <a href="/blogs">Blog</a>
            </li> -->
            <li>
                <a href="/contact">Contact</a>
            </li>
            <li>
                <a href="/about">About</a>
            </li>
                
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" action="/products">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                @php 
                    if(isset($_POST['search']) && $_POST['search'] != "") {
                        $search = $_POST['search'];
                    } else if(isset($_GET['search']) && $_GET['search'] != "") {
                        $search = $_GET['search'];
                    } else {
                        $search = '';
                    }
                @endphp
                <input class="plh3" type="text" value="{{ $search }}" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
