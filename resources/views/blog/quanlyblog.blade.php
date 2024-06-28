<x-admin-layout>
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
        <div style='text-align:center;font-weight:bold;color:#15c;'><h2>QUẢN LÝ BLOG</h2></div>
        <a href ="{{route('blogadd')}}" class="btn btn-success">Thêm</a>
        <div style="margin:10px; text-align: right;">
        </div>
    <table class='table table-striped table-bordered' id="blog-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                
                <th>Ảnh tiêu đề</th>
                <!--<th>Phần thân</th>
                <th>Ảnh thân</th>
                <th>Phần kết</th>
                <th>Ảnh kết</th>
                <th>Ảnh kết</th>-->
                <th>Thể loại</th>
                <th>Chi tiết</th>
                <th>Hình thức</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{$row->id_blog}}</td>
                <td>{{$row->title}}</td>
                
                <td><img src="{{asset('storage/front/image/'.$row->image_title)}}" width="100px"></td>
                <!--
                <td>{{$row->first_part}}</td>
                <td>{{$row->second_part}}</td>
                <td><img src="{{asset('storage/front/image/'.$row->image_1)}}" width="100px"></td>
                <td>{{$row->end_part}}</td>
                <td><img src="{{asset('storage/front/image/'.$row->image_2)}}" width="100px"></td>
                <td><img src="{{asset('storage/front/image/'.$row->image_3)}}" width="100px"></td>-->
                <td>{{$row->cate_name}}</td>
                <td>
                    <a href ="{{route('blogedit',['id'=>$row->id_blog])}}" class="btn btn-primary">Chi tiết</a> 
                </td>
                <td>
                    <form method='post' action = "{{route('blogdelete')}}" 
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa blog này không?');">
                            <input type='hidden' value='{{$row->id_blog}}' name='id'>
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
            $("#blog-table").DataTable(
                {
                    responsise: true, //sự co giãn-->
                    "bStateSave": true
                }
            );
        });
    </script>
</x-admin-layout>