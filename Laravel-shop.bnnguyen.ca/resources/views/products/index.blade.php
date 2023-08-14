@extends('main')

@section('content')
    <div class="bg0 m-t-23 p-b-140 p-t-80">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m m-tb-10">
                    @php 
                        if($cat == 0) {
                            $active0 = 'how-active1';
                        } else {
                            $active0 = '';
                        }
                    @endphp
                    <a href="/products?t=all-products.html" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $active0 }}">Alll Products</a>

                    @foreach($menuProduct as $menu)

                    @php 
                        if($cat == $menu->id) {
                            $active = 'how-active1';
                        } else {
                            $active = '';
                        }
                    @endphp
                    
                    <a href="{{ request()->fullUrlWithQuery(['cat' => $menu->id]) }}&t={{ \Str::slug($menu->name, '-') }}.html" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $active }}">
                        {{ $menu->name }}
					</a>
                    @endforeach
					
				</div>

                <div class="flex-w flex-c-m m-tb-10">
                    @php 
                        if(isset($_GET['price']) || isset($_GET['price-from'])) {
                            $active = 'pleaseclickme';
                        } else {
                            $active = '';
                        }
                    @endphp
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter {{ $active }}">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    @php 
                        if(isset($_GET['search']) && $active == '') {
                            $active = 'pleaseclickme';
                        } else {
                            $active = '';
                        }
                    @endphp
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search {{ $active }}">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <form class="w-full" action="{{ request()->fullUrlWithQuery([]) }}" method="post">
                    <div class="dis-none panel-search w-full p-t-10 p-b-15">
                        <div class="bor8 dis-flex p-l-15">
                            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
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
                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" value="{{ $search }}" type="text" name="search" placeholder="Search">
                        </div>
                    </div>
                    @csrf
                </form>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Sort By
                            </div>

                            <ul>
                                @php 
                                    if(!isset($_GET['price'])) {
                                        $active = 'filter-link-active';
                                    } else {
                                        $active = '';
                                    }
                                @endphp
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04 {{ $active }}">
                                        Default
                                    </a>
                                </li>
                                
                                @php 
                                    if(isset($_GET['price']) && $_GET['price'] == 'asc') {
                                        $active = 'filter-link-active';
                                    } else {
                                        $active = '';
                                    }
                                @endphp
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}" class="filter-link stext-106 trans-04 {{ $active }}">
                                        Price: Low to High
                                    </a>
                                </li>
                                
                                @php 
                                    if(isset($_GET['price']) && $_GET['price'] == 'desc') {
                                        $active = 'filter-link-active';
                                    } else {
                                        $active = '';
                                    }
                                @endphp
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}" class="filter-link stext-106 trans-04 {{ $active }}">
                                        Price: High to Low
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Price
                            </div>

                            <ul>
                                @php 
                                    if(!isset($_GET['price-from'])) {
                                        $active = 'filter-link-active';
                                    } else {
                                        $active = '';
                                    }
                                @endphp
                                <li class="p-b-6">
                                    <a href="/products?cat={{ $cat }}" class="filter-link stext-106 trans-04 {{ $active }}">
                                        All
                                    </a>
                                </li>

                                @php 
                                    if(isset($_GET['price-from']) && $_GET['price-from'] == 0) {
                                        $active = 'filter-link-active';
                                    } else {
                                        $active = '';
                                    }
                                @endphp
                                
                                <li class="p-b-6">
                               
                                    <a href="{{ request()->fullUrlWithQuery(['price-from' => 0, 'price-to' => 50]) }}" class="filter-link stext-106 trans-04 {{ $active }}">
                                        $0.00 - $50.00
                                    </a>
                                </li>
                                
                                @php 
                                    if(isset($_GET['price-from']) && $_GET['price-from'] == 50) {
                                        $active = 'filter-link-active';
                                    } else {
                                        $active = '';
                                    }
                                @endphp
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price-from' => 50, 'price-to' => 100]) }}" class="filter-link stext-106 trans-04 {{ $active }}">
                                        $50.00 - $100.00
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @include('products.list')

            {!! $products->links() !!}
        </div>
    </div>
@endsection