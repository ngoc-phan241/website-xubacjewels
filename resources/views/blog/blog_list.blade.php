<x-shop-layout>
    <div class="blog-layout">
        <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$namecate->cate_name}}</li>
            </ol>
        </nav>
            <div class="row">
                <div class="list-blog">
                    @foreach($data as $row)
                        <div class="blog">
                            <a class="item" href="{{url('blog/detail/'.$row->id_blog)}}">
                                <div class="image-blog">
                                    <img src="{{asset('storage/front/image/'.$row->image_title)}}" >
                                </div>
                                <div class="title-blog" style="width:350px;height:80px;">
                                    <div class="title"><b>{{$row->title}}</b></div>
                                    <div class="date">{{$row->created_at}}</div>
                                    
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-shop-layout>