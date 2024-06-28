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
    <form action="{{route('blogsave',['action'=>$action])}}" method = "POST" enctype="multipart/form-data">
        @if($action=="add")
            <div style='text-align:center;font-weight:bold;color:#15c;'>THÊM THÔNG TIN SẢN PHẨM</div>

        @else
            <div style='text-align:center;font-weight:bold;color:#15c;'>SỬA THÔNG TIN SẢN PHẨM</div>

        @endif
            <label>Tiêu đề</label>
            <input type='text' class='form-control form-control-sm' name='title' value="{{$data->title??''}}">

            <label>Phần đầu</label>
            <textarea  style="resize: none"  id='first_part' class="form-control" rows="7"  name='first_part'>{{$data->first_part??''}}</textarea>

            <label>Phần thân</label>
            <textarea  style="resize: none"  id='second_part' class="form-control" rows="7"  name='second_part'>{{$data->second_part??''}}</textarea>

            <label>Phần kết</label>
            <textarea  style="resize: none"  id='end_part' class="form-control" rows="7"  name='end_part'>{{$data->end_part??''}}</textarea>

            <label>Ảnh tiêu đề</label><br>
                @if($action=="edit")
                    <img src="{{asset('storage/front/image/'.$data->image_title) }}" width="70px" class='mb-1'/>
                    
                    <input type="file" name="image_title" id="image_title" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @else
                    <input type="file" name="image_title" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @endif

            <label>Ảnh 1</label><br>
                @if($action=="edit")
                    <img src="{{asset('storage/front/image/'.$data->image_1) }}" width="70px" class='mb-1'/>
                    
                    <input type="file" name="image_1" id="image_1" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @else
                    <input type="file" name="image_1" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @endif

            <label>Ảnh 2</label><br>
                @if($action=="edit")
                    <img src="{{asset('storage/front/image/'.$data->image_2) }}" width="70px" class='mb-1'/>
                    
                    <input type="file" name="image_2" id="image_2" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @else
                    <input type="file" name="image_2" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @endif
                

            <label>Ảnh 3</label><br>
                @if($action=="edit")
                    <img src="{{asset('storage/front/image/'.$data->image_3) }}" width="70px" class='mb-1'/>
                    
                    <input type="file" name="image_3" id="image_3" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @else
                    <input type="file" name="image_3" accept="image/*" class="form-control-file">
                    <input type ='hidden' value='{{$data->id_blog}}' name='id'>
                @endif
            

            <label>Loại bài viết</label>
            <select name='cate_id' class='form-control form-control-sm' value="{{$data->cate_id??''}}"> 
                @php
                    $selected = isset($data->the_loai)?$data->the_loai:"";
                @endphp

                @foreach($the_loai as $row)
                    <option value='{{$row->cate_id}}' {{$selected==$row->cate_id?'selected':''}}>
                    {{$row->cate_name}}
                    </option>
                @endforeach
            </select>
            {{ csrf_field() }}
            <div style='text-align:center;'><input type='submit' class='btn btn-primary mt-1' value='Lưu'></div>
    </form>
</div>
</x-admin-layout> 