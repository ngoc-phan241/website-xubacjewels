<x-admin-layout>
    @if ($errors->any())
        <div style='color:red;width:30%; margin:0 auto'>
            <div >
            {{ __('Whoops! Something went wrong.') }}
            </div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <form action="{{route('adminsave',['action'=>$action])}}" method = "post">
                @if($action=="add")
                    <div style='text-align:center;font-weight:bold;color:#15c;'>THÊM THÔNG TIN ADMIN</div>

                    <label>Tên </label>
                    <input type='text' class='form-control form-control-sm' name='name' value="{{$admin->name??''}}">

                    <label>Email</label>
                    <input type='text' class='form-control form-control-sm' name='email' value="{{$admin->email??''}}">

                    <label>Số điện thoại</label>
                    <input type='text' class='form-control form-control-sm' name='phone' value="{{$admin->phone??''}}">

                    <label>Địa chỉ</label>
                    <input type='text' class='form-control form-control-sm' name='address' value="{{$admin->address??''}}">

                    <label>Mật khẩu</label>
                    <input type='password' class='form-control form-control-sm' name='password'>

                    <input type='hidden' class='form-control form-control-sm' name='roles' value="1">

                @else
                    <div style='text-align:center;font-weight:bold;color:#15c;'>SỬA THÔNG TIN ADMIN</div>
                    
                    <label>Tên </label>
                    <input type='text' class='form-control form-control-sm' name='name' value="{{$admin->name??''}}">

                    <label>Email</label>
                    <input type='text' class='form-control form-control-sm' name='email' value="{{$admin->email??''}}">

                    <label>Số điện thoại</label>
                    <input type='text' class='form-control form-control-sm' name='phone' value="{{$admin->phone??''}}">

                    <label>Địa chỉ</label>
                    <input type='text' class='form-control form-control-sm' name='address' value="{{$admin->address??''}}">
                    <input type='hidden' class='form-control form-control-sm' name='password'>
                    <input type='hidden' name="id" value="{{ $admin->id }}">
                    
                @endif

                    {{ csrf_field() }}
                    <div style='text-align:center;'><input type='submit' class='btn btn-primary mt-1' value='Lưu'></div>
            </form>
        </div>
</x-admin-layout> 