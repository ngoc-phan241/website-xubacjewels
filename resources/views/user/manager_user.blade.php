<x-shop-layout>
    <style>
        .ttcn{
            width:500px; 
            height:30px; 
            border: 1px solid #f0f0f0; 
            border-radius:8px;
            justify-content: flex-start;  
            margin-bottom:5px;
        }
        .ttcn-layout{
            
            display: grid;
            grid-template-columns: repeat(2,17%);
            grid-gap: 20px;
        }
        .ttcn-tieude{
            margin-bottom:40px;
        }
        .danhmuc-ttcn{
            margin: 30px 40px 30px 40px;
            border: 1px solid #333;
            padding:15px;
            border-radius:8px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Thông tin tài khoản</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-3">
                <div class="danhmuc-ttcn">
                    <div>
                        <b>Danh mục</b>
                    </div>
                    <div><a href ="{{route('manager_user')}}"> Xem thông tin tài khoản</a></div>
                    <div> <a href = "{{route('editProfile')}}"> Cập nhật thông tin</a></div>
                </div>
            </div>
            <div class="col-lg-7">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="ttcn-tieude">
                    <h4 class="name" style="margin-left:50px;margin-right: 50px;color:pink; text-align:center;"> <b>THÔNG TIN TÀI KHOẢN</b><h4>
                </div>
                <div style="margin-bottom:80px;">
                    <div class="ttcn-layout">
                        <div  class="ttcn-address">
                            Họ và tên:
                        </div>
                        <div class="ttcn" >
                            {{$user->name}}
                        </div>
                    </div>
                    <div  class="ttcn-layout">
                        <div  class="ttcn-address">
                            Số điện thoại:
                        </div>
                        <div class="ttcn" >
                            {{$user->phone}}
                        </div>
                    </div>
                    <div class="ttcn-layout">
                        <div  class="ttcn-address">
                            Email:
                        </div>
                        <div class="ttcn" >
                            {{$user->email}}
                        </div>
                    </div>
                    <div class="ttcn-layout">
                        <div class="ttcn-address">
                            Địa chỉ:
                        </div>
                        <div class="ttcn" >
                            {{$user->address}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-shop-layout>