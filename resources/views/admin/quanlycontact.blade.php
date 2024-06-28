<x-admin-layout>
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
        <div style='text-align:center;font-weight:bold;color:#15c;'><h2>QUẢN LÝ LIÊN HỆ</h2></div>
        <div style="margin:10px; text-align: right;">
        </div>
    <table class='table table-striped table-bordered' id="product-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Nội dung</th>
                <th>Ngày gửi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{$row->id_contact}}</td>
                <td>{{$row->name_contact}}</td>
                <td>{{$row->email_contact}}</td>
                <td>{{$row->phone_contact}}</td>
                <td>{{$row->content_contact}}</td>
                <td>{{$row->created_at}}</td>
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