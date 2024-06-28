<x-shop-layout>
<style>
        .danhmuc-ttcn{
            margin: 30px 40px 30px 40px;
            border: 1px solid #333;
            padding:15px;
            border-radius:8px;
        }

        .ttcn-tieude{
            margin-bottom:40px;
        }
</style>
<div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Cập nhật thông tin</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-3">
                <div class="danhmuc-ttcn">
                    <div>
                        <b>Danh mục</b>
                    </div>
                    <div><a href ="{{route('manager_user')}}"> Xem thông tin</a></div>
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
                    <h4 class="name" style="margin-left:50px;margin-right: 50px;color:pink;text-align:center;"> <b>CẬP NHẬT THÔNG TIN</b><h4>
                </div>
                <div style="margin-bottom:40px;">
                    <form action="{{route('updateProfile')}}" method = "POST">
                        <label><b>Họ và tên</b></label>
                        <input type='text' class='form-control form-control-sm' name='name' value="{{$user->name}}">

                        <label><b>Email</b></label>
                        <input type='email' class='form-control form-control-sm' name='email' value="{{$user->email}}">

                        <label><b>Số điện thoại</b></label>
                        <input type='text' class='form-control form-control-sm' name='phone' value="{{$user->phone}}">

                        <label><b>Địa chỉ</b></label>
                        <input type='text' class='form-control form-control-sm' name='address' value="{{$user->address}}">

                        {{ csrf_field() }}
                        <div style='text-align:center;'><input type='submit' class='btn btn-danger mt-1' value='Lưu'></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-shop-layout>