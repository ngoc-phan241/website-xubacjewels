<x-admin-layout>
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
        <div style='text-align:center;font-weight:bold;color:#15c;'><h2>QUẢN LÝ ADMIN</h2></div>
        <a href ="{{route('admincreate')}}" class="btn btn-success">Thêm</a>
        <div style="margin:10px; text-align: right;">
        </div>
    <table class='table table-striped table-bordered' id="product-table">
        <thead>
            <tr>
                <th>Tên admin</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Cập nhật</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->phone}}</td>
                <td>{{$row->address}}</td>
                <td>
                    <a href ="{{route('adminedit',['id'=>$row->id])}}" class="btn btn-primary">Cập nhật</a> 
                </td>
                <td>
                    <form method='post' action = "{{route('admindelete')}}" 
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa admin này không?');">
                            <input type='hidden' value='{{$row->id}}' name='id'>
                            <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                            {{ csrf_field() }}
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            $("#product-table").DataTable(
                {
                    responsise: true, //sự co giãn-->
                    "bStateSave": true
                }
            );
        });
    </script>
</x-admin-layout>