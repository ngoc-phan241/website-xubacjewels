<x-admin-layout>
@if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
        @endif
        <div style='text-align:center;font-weight:bold;color:#15c;'><h2>QUẢN LÝ SẢN PHẨM</h2></div>
    <div style="display:flex; margin-bottom:20px;">
        <a href ="{{route('productadd')}}" class="btn btn-success">Thêm</a>
        <form action="{{ route('exportproduct') }}" method="GET" style="margin-left:5px">
            <button type="submit" class="btn btn-primary">Xuất file</button>
        </form>
    </div>
    <table class='table table-striped table-bordered' id="product-table">
        <thead>
            <tr>    
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th>Giá bán</th>
                <th>Giảm giá</th>
                <th>Số lượng tồn kho</th>
                <th>Hình ảnh 1</th>
                <th width='115px'>Cập nhật</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr style="text-align:center;">
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->c_name}}</td>
                <td>{{$row->price}}</td>
                <td>{{$row->discount}}</td>
                <td>{{$row->stock}}</td>
                <td><img src="{{asset('storage/front/image/'.$row->image)}}" width="100px"></td>
                <td>
                    <a href ="{{route('productedit',['id'=>$row->id])}}" class="btn btn-primary">Chi tiết</a> 
                </td>
                <td>
                    <form method='post' action = "{{route('productdelete')}}" 
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
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