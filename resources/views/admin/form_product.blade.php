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
    <form action="{{route('productsave',['action'=>$action])}}" method = "post" enctype="multipart/form-data">
        @if($action=="add")
            <div style='text-align:center;font-weight:bold;color:#15c;'>THÊM THÔNG TIN SẢN PHẨM</div>
        @else
            <div style='text-align:center;font-weight:bold;color:#15c;'>SỬA THÔNG TIN SẢN PHẨM</div>
        @endif
            <label>Tên sản phẩm</label>
            <input type='text' class='form-control form-control-sm' name='name' value="{{$data->name??''}}">

            <label>Mô tả</label>
            <textarea  style="resize: none"  id='content' class="form-control" rows="7"  name='content'>{{$data->content??''}}</textarea>

            <label>Giá bán</label>
            <input type='text' class='form-control form-control-sm' name='price' value="{{$data->price??''}}">

            <label>Giảm giá</label>
            <input type='text' class='form-control form-control-sm' name='discount' value="{{$data->discount??''}}">

            <label>Hình ảnh 1</label><br>
            @if($action=="edit")
                <img src="{{asset('storage/front/image/'.$data->image) }}" width="70px" class='mb-1'/>
                
                <input type="file" name="image" id="image" accept="image/*" class="form-control-file">
                <input type ='hidden' value='{{$data->id}}' name='id'>
            @else
            <input type="file" name="image" accept="image/*" class="form-control-file">
            @endif

            <label>Hình ảnh 2</label><br>
            @if($action=="edit")
                
                <img src="{{asset('storage/front/image/'.$data->image_1) }}" width="70px" class='mb-1'/>
                <input type="file" name="image_1" id="image_1" accept="image/*" class="form-control-file">
                <input type ='hidden' value='{{$data->id}}' name='id'>
            @else
            <input type="file" name="image_1" accept="image/*" class="form-control-file">
            @endif

            <label>Hình ảnh 3</label><br>
            @if($action=="edit")
                
                <img src="{{asset('storage/front/image/'.$data->image_2) }}" width="70px" class='mb-1'/>
                <input type="file" name="image_2" id="image_2" accept="image/*" class="form-control-file">
                <input type ='hidden' value='{{$data->id}}' name='id'>
            @else
            <input type="file" name="image_2" accept="image/*" class="form-control-file">
            @endif
            <br>
            <label>Loại sản phẩm</label>
            <select name='categories' class='form-control form-control-sm' value="{{$data->categories??''}}">
                @php
                    $selected = isset($data->the_loai)?$data->the_loai:"";
                @endphp

                @foreach($the_loai as $row)
                    <option value='{{$row->id}}' {{$selected==$row->id?'selected':''}}>
                    {{$row->c_name}}
                    </option>
                @endforeach
            </select>
            {{ csrf_field() }}
            <div style='text-align:center;'><input type='submit' class='btn btn-primary mt-1' value='Lưu'></div>
    </form>
</div>
</x-admin-layout> 