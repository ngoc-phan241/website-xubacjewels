<x-admin-layout>
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
        <div style='text-align:center;font-weight:bold;color:#15c;'><h2>QUẢN LÝ KHÁCH HÀNG</h2></div>
        <div style="margin:10px; text-align: right;">

        <form action="{{route('exportuser')}}" method="GET">
            <button type="submit" class="btn btn-primary">Xuất file</button>
        </form>
        
        </div>
    <table class='table table-striped table-bordered' id="product-table">
        <thead>
            <tr>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->phone}}</td>
                <td>{{$row->address}}</td>
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