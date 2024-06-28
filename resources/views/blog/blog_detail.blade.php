<x-shop-layout>
    <style>
        .comment ul{
            display:flex;
                    
        }
        .comment li{
            color:black;
            margin-right:40px;
            list-style-type: none;
            display:flex;
        }
    </style>
        <x-slot name='title'>
            Blog
        </x-slot>
        
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">{{$data->cate_name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$data->title}}</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-3 bg">
                    <div class="khung">
                        <div class="sp-noi-bat" style="text-align:center;margin-bottom:12px;" >
                            <b><h5>SẢN PHẨM NỔI BẬT</h5></b>
                        </div>
                        <div class="list-sp" style="margin-left:13px;">
                            <div class="list-sp-ct">
                                <a href="{{url('product/categories/1')}}">Rings (Nhẫn)</a><br>
                            </div>
                            <div class="list-sp-ct">
                                <a href="{{url('product/categories/3')}}">Bracelets (Vòng tay)</a><br>
                            </div>
                            <div class="list-sp-ct">
                            <a href="{{url('product/categories/2')}}">Earrings (Bông tai)</a><br>
                            </div>
                            <div class="list-sp-ct">
                            <a href="{{url('product/categories/4')}}">Necklaces (Dây chuyền)</a><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" style="margin-bottom:40px; ">
                    <div class="box-article-heading clearfix">
                        <h4 style="margin-top: 20px;"><center> {{$data->title}}</center></h4>
                        <!--
                        <div class="background-img" style="margin-top:10px;margin-bottom:10px;text-align: center;">
                            <img src="{{asset('front/image/'.$data->image_title)}}" alt="" width="300px">
                        </div>-->
                   
                        <div class="artical-pages">
                            <div class="descriptionnn">
                                <div class="content-blog" style="margin-bottom:-45px;margin-top:-45px;">
                                    {!!$data->first_part!!}
                                    <img src="{{asset('storage/front/image/'.$data->image_title)}} " width='500px' style="text-align: center;">
                                </div>
                                
                                <div class="content-blog" style="margin-bottom:-45px;margin-top:-45px;">
                                    {!!$data->second_part!!}
                                    <img src="{{asset('storage/front/image/'.$data->image_1)}}"  width='500px' style="text-align: center;">
                                </div>

                                <div class="content-blog" style="margin-bottom:-45px;margin-top:-45px;">
                                    {!!$data->end_part!!}
                                    <img src="{{asset('storage/front/image/'.$data->image_2)}}"  width='500px' style="text-align: center;">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="com" style="margin-bottom:40px;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="formm">
                        <form action="{{route('comment', $data->id_blog)}}" method="POST">
                            @csrf
                            
                            <div class="form-group" style="width:1000px;">
                                <lable><h4><b>Bình luận</b></h4></lable><br>
                                <input type="hidden" value="{{$data->id_blog}}" name="id_blog">
                                <textarea class="form-control" rows="2" placeholder="Chia sẻ cảm nhận của bạn..." name="comment"></textarea>
                            </div>

                            <button type="submit"  class="btn btn-danger">Gửi Bình luận</button>
                        </form>
                    </div>
                    <br>
                    
                    <div class="comment">
                        @foreach($comments as $comm)
                            <ul>
                                <li><img src="{{asset('front/image/avatar.jpg')}}" width="40px" alt="" style="margin-right:10px;">     <b>{{$comm->user->name}}</b></li>
                                <li><div style="text-align:center;"><i class="fa fa-calendar-o"></i> {{$comm->created_at->format('H:i d/m/Y')}}</div></li>
                                <!-- <li><a href=""><i class="fa fa-trash-o"></i></a></li> -->
                            </ul>
                            <p style="margin-left:50px;font-size:18px;">{{$comm->comment}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        
</x-shop-layout>