<x-shop-layout>
    <x-slot name='title'>
       Xứ Bạc Jewels - Thanh toán
    </x-slot>
    <style>
        
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-5">
                <div class="info">
                    <div class="logo-info">
                        <a href="{{route('product')}}">
                            <img src="{{asset('front/image/logo.jpg')}}" width="150px" alt="">
                        </a>
                    </div>
                    <div>
                        <b>Địa chỉ: </b> S10.06.01S19 Origami Vinhomes Grand Park, Quận 9, Thủ Đức, HCM.<br>
                        <b>Hotline: </b>097 585 43 25<br>
                        <b>Email: </b> xubac1010@gmail.com<br>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" style="margin-bottom:50px; margin-left:40px;">
            @if ($errors->any())
                <div style='color:red;width:30%; margin:0 auto'>
                    <div >
                    {{ __('Whoops! Something went wrong.') }}
                    </div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                @if (session('status'))
                    <div class="alert alert-success">
                    {{ session('status') }}
                    </div>
                @endif
                <form action="{{route('savecontact')}}" method = "post">
                        <div style='text-align:center;font-weight:bold;color:#333;margin-bottom:20px;'>LIÊN HỆ VÀ ĐÓNG GÓP VỚI XỨ BẠC JEWELS</div>
                    
                    <label>Họ và tên</label>
                    <input type='text' class='form-control form-control-sm' name='name_contact'>

                    <label>Số điện thoại</label>
                    <input type='text' class='form-control form-control-sm' name='phone_contact'>

                    <label>Email</label>
                    <input type='text' class='form-control form-control-sm' name='email_contact'>

                    <label>Nội dung</label>
                    <textarea  style="resize: none"  id='content' class="form-control" rows="5"  name='content_contact'></textarea>
                    
                    {{ csrf_field() }}
                    <div style='text-align:center;'><input type='submit' class='btn btn-danger mt-1' value='Gửi thông tin'></div>
                </form>
            </div>
        </div>
    </div>
</x-shop-layout>