<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Xứ Bạc Jewels</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- bootstrap -->
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/themify-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}" type="text/css">  
    <link rel="stylesheet" href="{{asset('front/css/sweetalert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/lightslider.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/lightgallery.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/prettify.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/main.css')}}" type="text/css">

</head>

<body>
    <!-- Start coding here -->
    <!-- Page Preloder 
    <div id="preloder">
        <div class="loader"></div>
    </div> -->
    <!-- Header section begin -->
            <div class="header-middle">
                <div class="container">
                    <div class="inner-header">
                        <div class="row" style="text-algin:center;">
                            <div class="col-lg-3">
                                <div class="logo" style="justify-content: center;padding-top: 30px;padding-bottom: 30px;">
                                    <a href="{{route('product')}}">
                                        <img src="{{asset('front/image/logo.jpg')}}" width="90px" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="logo-slogan"  style="justify-content: center;padding-top: 30px;padding-bottom: 30px;">
                                    <img src="{{asset('front/image/slogan.jpg')}}" width="auto" height="100px" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3" >
                                <div class="header-middle-right" style="display: flex;justify-content: center;padding-top: 30px;padding-bottom: 30px;">
                                    <ul class="nav-right" >
                                        @auth
                                            
                                            <li class="header-middle-right-item dropdown open">
                                                <a href="" >
                                                    <i class="fa fa-user" style="text-align:center;"></i>
                                                </a>
                                                <div class="auth-container">
                                                    
                                                    <span class="text-tk" >{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></span>
                                                </div>
                                                <ul class="header-middle-right-menu">
                                                    <li><a id="manager_user" href="{{route('manager_user')}}"> Quản lý tài khoản</a></li>
                                                    <li>
                                                        <form method="POST" action="{{route('logout')}}">
                                                            @csrf
                                                            <a class="dropdown-item" onclick="event.preventDefault();
                                                                                this.closest('form').submit();">Đăng xuất</a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                        @else
                                            <li class="header-middle-right-item dropdown open">
                                                <a href="" >
                                                    <i class="fa fa-user" style="text-align:center;"></i>
                                                </a>
                                                <div class="auth-container">
                                                    <span class="text-dndk">Đăng nhập / Đăng ký</span>
                                                    <span class="text-tk" >Tài khoản <i class="fa fa-caret-down"></i></span>
                                                </div>
                                                <ul class="header-middle-right-menu">
                                                    <li><a id="login" href="{{route('login')}}"><i class="fa fa-right-to-bracket"></i> Đăng nhập</a></li>
                                                    <li><a id="signup" href="{{route('register')}}"><i class="fa fa-pen"></i> Đăng ký</a></li>
                                                </ul>
                                            </li>
                                        @endauth
                                        <li class="cart-icon" onclick="openCart()" style='color:white;position:relative' class='mr-2'>
                                            <a href="{{route('cart')}}" style='cursor:pointer;color:pink;'>
                                                <i class="fa fa-cart-plus fa-lg mr-2 mt-2" aria-hidden="true"></i>
                                            </a>
                                            <div style='width:20px; height:20px; background-color:#B22222; font-size:12px; border:none;
                                                border-radius:50%; position:absolute; right:-3px; top:-2px; padding-left:6px;' id='cart-number-product'>
                                                @if (session('cart'))
                                                    {{ count(session('cart')) }}
                                                @else
                                                    0
                                                @endif
                                            </div>
                                            <!--
                                            <div class="cart-hover">
                                                <div class="select-item">
                                                    <table>
                                                        <tbody>
                                                        
                                                            <tr>
                                                                <td class="si-pic"></td>
                                                                <td class="si-text">
                                                                    <div class="product-selected">
                                                                        <p> số lượng x giá</p>
                                                                        <h6>Tên</h6>
                                                                    </div>
                                                                </td>
                                                                <td class="si-close">
                                                                    <i class="ti-close"></i>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="select-total">
                                                    <span>Tổng cộng:
                                                    </span>
                                                    <h5>tổng tiền</h5>
                                                </div>
                                                <div class="select-button">
                                                    <a href="">ĐẶT HÀNG</a>
                                                </div>
                                            </div>
                                            -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="nav-item">
            <div class="container">
                <nav class="nav-menu mobile-menu" style="width:1300px;">
                    <ul>                       
                        <li class=""><a href="{{route('product')}}">Trang chủ</a></li>
                        <li ><a href="#">Trang sức</a>
                            <ul class="dropdown">
                                <li><a class="nav-link" href="{{url('product/categories/1')}}">Nhẫn</a></li>
                                <li><a class="nav-link" href="{{url('product/categories/2')}}">Bông tai</a></li>
                                <li><a class="nav-link" href="{{url('product/categories/3')}}">Lắc tay</a></li>
                                <li><a class="nav-link" href="{{url('product/categories/4')}}">Dây chuyền</a></li>
                                
                            </ul>
                        </li>
                        <li><a class="nav-link" href="{{url('product/categories/5')}}">PHỤ KIỆN </a>
                        </li>
                        <li><a class="nav-link" href="{{route('sale-off')}}">SALE OFF </a>
                        </li>
                        <li><a href="#">Thông tin</a>
                            <ul class="dropdown">
                                <li><a href="{{route('baoquan')}}">Chính sách bảo hành</a></li>
                                <li><a href="{{route('doitra')}}">Chính sách đổi trả</a></li>
                                <li><a href="{{route('chinhsachtt')}}">Chính sách thanh toán</a></li>
                                <li><a href="{{route('baomat')}}">Chính sách bảo mật</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('cate_blog',['id'=>1])}}">Blog</a>
                            <ul class="dropdown">
                                <li><a class="nav-link" href="{{route('cate_blog',['id'=>1])}}">Tin tức</a></li>
                                <li><a class="nav-link" href="{{route('cate_blog',['id'=>2])}}">Kiến thức trang sức</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('about-us')}}">About us</a>
                            <ul class="dropdown">
                                <li><a class="nav-link" href="{{route('about-us')}}">Giới thiệu</a></li>
                                <li><a class="nav-link" href="{{route('contact')}}">Liên hệ</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="header-middle-center" style="width:300px;margin-top:5px;">
                        <form method="get" action="{{url('/search')}}" class="form-search">
                            <span class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" name='keyword'  class="form-search-input" placeholder="Tìm kiếm sản phẩm..."
                                oninput="searchProducts()">
                            <button class="filter-btn"><i class="fa-light fa-filter-list"></i><span>Tìm</span></button>
                            {{csrf_field()}}
                        </form>
                    </div>
                </nav>
                <div id="mobile-mwnu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- header section end -->

    <main>
        <div class='row'>
            <div class='col-12'>
               {{$slot}}
            </div>
        </div>
    </main>


    <!-- footer section end -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#">
                                <img src="{{asset('front/image/logo.jpg')}}" height="150" alt="">
                            </a>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="footer-widget">
                        <h5>THÔNG TIN</h5>
                        <ul>
                            <li><a href="{{route('product')}}">Trang chủ</a></li>
                            <li><a href="{{route('about-us')}}">Giới thiệu</a></li>
                            <li><a href="{{route('contact')}}">Liên hệ</a></li>
                            <li><a href="{{url('/blog/cat/2')}}">Kiến thức trang sức</a></li>
                            
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h5>DỊCH VỤ KHÁCH HÀNG</h5>
                        <ul>
                            <li><a href="{{route('baoquan')}}">Chính sách bảo hành</a></li>
                            <li><a href="{{route('doitra')}}">Chính sách đổi trả</a></li>
                            <li><a href="{{route('chinhsachtt')}}">Chính sách thanh toán</a></li>
                            <li><a href="{{route('baomat')}}">Chính sách bảo mật</a></li>
                        </ul>
                        
                    </div>
                   
                </div>
                <div class="col-lg-4">
                    <div class="footer-right">
                        <h5>KẾT NỐI VỚI CHÚNG TÔI</h5>
                        <div class="footer-social">
                            <ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> S10.06.01S19 Origami Vinhomes Grand Park, Quận 9, Thủ Đức, HCM.</li>
                                <li><i class="fa fa-phone"></i> 097 585 43 25</li>
                                <li><i class="fa fa-envelope-o"></i> xubac1010@gmail.com</li>
                            </ul>

                            <a href="{{url('https://www.facebook.com/profile.php?id=100092602959709')}}" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                            <a href="{{url('https://www.instagram.com/xubacjewels')}}" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                            <a href="{{url('https://www.tiktok.com/@xubacjewels.vn')}}" target="_blank"><i class="fa fa-tiktok fa-lg"></i></a>
                        </div>
                        
                    </div>
                   
                </div>
            </div>
            
        </div>
        <div class=" copyright-reserved">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        Copyright <i class="fa fa-copyright"></i> 2024 <a href="">Xứ Bạc Jewels</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Js Plugins -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.dd.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front/js/main.js')}}"></script>
    <script src="{{asset('front/js/lightslider.js')}}"></script>
    <script src="{{asset('front/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('front/js/prettify.js')}}"></script>
    <script src="{{asset('front/js/sweetalert.min.js')}}"></script>
</body>

</html>