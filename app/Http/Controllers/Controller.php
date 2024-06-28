<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\AdminController;
use Mail;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    

    public function product()
    {
        $data = DB::select("select * from product limit 0,8");
        $sale_products = DB::table('product')
                            ->whereNotNull('discount') 
                            ->orderBy('discount', 'asc')
                            ->paginate(8);
        return view("main.trangchu", compact("data","sale_products"));
    }

    public function categories($id)
    {
        $namecate = DB::select("select * from categories where id = ?",[$id])[0];
        $data = DB::table('product')
                ->where('categories', $id)
                ->paginate(8);
        return view("main.categories", compact("data","namecate"));
    }

    public function saleoff()
    {
        $data = DB::select("select * from product limit 0,8");
        $sale_products = DB::table('product')
                            ->whereNotNull('discount') 
                            ->orderBy('discount', 'asc')
                            ->paginate(8);
        return view("main.saleoff", compact("data","sale_products"));
    }

    public function detail($id)
    {
        $data = DB::select("select * from categories c, product p 
                            where c.id = p.categories
                            and p.id = ?",[$id])[0];
        $comments = Comment::where('product_id', $data->id)->orderBy('comment_id','DESC')->get();
        //$data = DB::select("select * from product where id = ?",[$id])[0];
        return view("main.cate-detail", compact("data","comments"));
    }

    function search(Request $request)
    {
        $keyword=$request->input('keyword');
        $data = DB::table('product')
            ->where('name', 'like', '%'.$keyword.'%')
            ->paginate(8);
        return view("main.search", compact("data"));
    }

    public function cart()
    {
        $cart=[];
        $data =[];
        $quantity = [];
        $sum=0;
        $list_product="";
        
        if(session()->has('cart'))
        {
            $cart = session("cart");
           
            $list_product = "";
            $sum=0;
            foreach($cart as $id=>$value)
            {
                $sum +=1;
                $quantity[$id] = $value;
                $list_product .=$id.", ";
            }
                $list_product = substr($list_product, 0,strlen($list_product)-2);
            if($list_product!="")
            {
                $data = DB::table("product")->whereRaw("id in (".$list_product.")")->get();
            }   
        }

        return view("cart.cart",compact("quantity","data","sum"));
    }


    public function store_order(Request $request)
{
    // Validate các trường thông tin của đơn hàng
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'phone' => ['required', 'string'],
        'address' => ['required', 'string'],
        'total' => ['required', 'numeric'],
        'payment_method' => ['required', 'string'],
    ]);

        $id = $request->input('id'); 
        $data["name"] = $request->input("name");
        $data["phone"] = $request->input("phone");
        $data["address"]=$request->input("address");
        $data["email"]=$request->input("email");
                

        $sucess=DB::table("users")->where("id",$id)->update($data);

    // Lấy thông tin người dùng hiện tại nếu đã đăng nhập
    $user_id = Auth::id(); // Lấy id của người dùng đăng nhập

    // Chuẩn bị dữ liệu cho đơn hàng
    $order = [
        'date' => Carbon::now()->toDateString(), // Ngày đặt hàng
        'status' => 'Người bán đang chuẩn bị hàng',
        'payments' => $request->input('payment_method'),
        'user_id' => $user_id, // Lưu id của người dùng vào đơn hàng
        'total_price' => $request->input('total'),
    ];

    // Lưu thông tin đơn hàng vào bảng orders và lấy id của đơn hàng vừa thêm vào
    $order_id = DB::table("orders")->insertGetId($order);

    // Lưu thông tin chi tiết đơn hàng (các sản phẩm đã đặt)
    $cart = session("cart");
    $quantities = []; // Khai báo mảng để lưu trữ số lượng sản phẩm
    $data = []; // Khai báo mảng để lưu trữ thông tin sản phẩm
    if (!empty($cart)) {
        foreach ($cart as $product_id => $quantity) {
            // Lấy thông tin sản phẩm từ bảng product
            $product = DB::table("product")->where("id", $product_id)->first();

            // Tạo bản ghi cho mỗi sản phẩm trong bảng order_detail
            $orderItem = [
                'id_order' => $order_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $product->price,
                // Các trường thông tin khác của sản phẩm có thể thêm vào đây
            ];

            // Thêm bản ghi vào bảng order_detail
            DB::table('order_detail')->insert($orderItem);

            // Lưu quantity vào mảng
            $quantities[$product_id] = $quantity;
            $data[$product_id] = $product; // Lưu thông tin sản phẩm vào mảng data
        }
    }

    // Gửi email xác nhận đơn hàng cho khách hàng
    $customer_email = $request->input('email');
    $customer_name = $request->input('name');
    $customer_phone = $request->input('phone');
    $customer_address = $request->input('address');

    Mail::send('email.order', [
        'c_name' => $customer_name,
        'c_phone' =>  $customer_phone,
        'c_address' =>  $customer_address,
        'order' => $order,
        'quantity' => $quantities, // Truyền mảng quantities vào view email
        'data' => $data, // Truyền mảng data vào view email
        'total_price' => $order['total_price'], // Truyền tổng tiền vào view email
        'date' => $order['date'],
        'payments' => $order['payments'], 
    ], function($mail) use($customer_email, $customer_name) {
        $mail->to($customer_email, $customer_name);
        $mail->from('ngocphh.35@gmail.com');
        $mail->subject('ĐƠN HÀNG');
    });

    // Xóa session giỏ hàng sau khi đã đặt hàng thành công
    session()->forget('cart');

    // Chuyển hướng người dùng về trang sản phẩm và hiển thị thông báo đặt hàng thành công
    return redirect()->route('product')->with('status', 'Đặt hàng thành công!');
}




    public function cartad(Request $request)
    {
        $request->validate([
            "id" => ["required", "numeric"],
            "quantity" => ["required", "numeric"]
        ]);

        $id = $request->id;
        $quantity = $request->quantity;
        $cart = [];
        if(session()->has('cart'))
        {
            $cart = session()->get("cart");
            
        }
        $cart[$id] = $quantity;
      
        session()->put("cart", $cart);
        return count($cart);
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            "id"=>["required","numeric"],
            "num"=>["required","numeric"]
        ]);
            $id = $request->id;
            $num = $request->num;
            $total = 0;
            $cart = [];
        if(session()->has('cart'))
        {
            $cart = session()->get("cart");
            if(isset($cart[$id]))
                $cart[$id] += $num;
            else
                $cart[$id] = $num ;
        }
        else
        {
            $cart[$id] = $num ;
        }

        session()->put("cart",$cart);
        return count($cart);
    }

    public function cartdelete(Request $request)
    {
        
        $request->validate([
        "id"=>["required","numeric"],
        ]);
        $id = $request->id;
        $sum= $request->sum;
        $total = 0;
        $cart = [];
        if(session()->has('cart'))
        {
        $cart = session()->get("cart");
        unset($cart[$id]);
        }
        session()->put("cart",$cart);
        return redirect()->route('cart');
        
        return $request;
    }

    public function order(Request $request)
    {
            
        $cart=[];
        $data =[];
        $quantity = [];
        $list="";
        
        if(session()->has('cart'))
        {
            $cart = session("cart");
            $list = "";
            foreach($cart as $id=>$value)
            {
                $quantity[$id] = $value;
                $list .=$id.", ";
            }
                $list = substr($list, 0,strlen($list)-2);
            if($list!="")
            {
                $data = DB::table("product")->whereRaw("id in (".$list.")")->get();
                $user = DB::table("users")->whereRaw("id=?",[Auth::user()->id])->first();
                
            }   
        }
        return view("cart.order",compact("quantity","data","user"));
        
    }

    public function baoquan()
    {
        return view("main.baoquan");
    }

    public function doitra()
    {
        return view("main.doitra");
    }

    public function chinhsachtt()
    {
        return view("main.chinhsachtt");
    }

    public function baomat()
    {
        return view("main.baomat");
    }
    
    
    public function aboutus()
    {
        return view("main.aboutus");
    }

    //admin sản phẩm
    public function adminproduct()
    {
        $data = DB::select("select * from categories c, product p 
                            where c.id = p.categories
                            ");
        //$data = DB::select("select * from product");
        return view("admin.ad-product",compact("data"));
    }

    public function productadd()
    {
        $the_loai = DB::table("categories")->get();
        $action = "add";
        return view("admin.form_product",compact("the_loai","action"));
    }

    public function productsave($action, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'categories' => ['required', 'max:5'],
            'content' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'stock' => ['nullable', 'numeric'],
            'image' => ['nullable', 'image'],
            'image_1' => ['nullable', 'image'],
            'image_2' => ['nullable', 'image'],
           
            ]);

        $data = $request->except("_token");

        if($action=="edit")
            $data = $request->except("_token", "id");

        if($request->hasFile("image"))
        {
            $fileName = Auth::user()->id . '.' . $request->file('image')->extension();
            //$fileName = $request->input("name") ."_".rand(1000000,9999999).'.' . $request->file('image')->extension();        
            $request->file('image')->storeAs('public/front/image', $fileName);
            $data['image'] = $fileName;
        }
        if($request->hasFile("image_1"))
        {
            $fileName = Auth::user()->id . '.' . $request->file('image_1')->extension();
            //$fileName = $request->input("name") ."_".rand(1000000,9999999).'.' . $request->file('image')->extension();        
            $request->file('image_1')->storeAs('public/front/image', $fileName);
            $data['image_1'] = $fileName;
        }
        if($request->hasFile("image_2"))
        {
            $fileName = Auth::user()->id . '.' . $request->file('image_2')->extension();
            //$fileName = $request->input("name") ."_".rand(1000000,9999999).'.' . $request->file('image')->extension();        
            $request->file('image_2')->storeAs('public/front/image', $fileName);
            $data['image_2'] = $fileName;
        }
        
        $message = "";
        if($action=="add")
        {
            DB::table("product")->insert($data);
            $message = "Thêm thành công";
        }
        else if($action=="edit")
        {
            $id = $request->id;
            DB::table("product")->where("id",$id)->update($data);
            $message = "Cập nhật thành công";
        }
            
        return redirect()->route('adminproduct')->with('status', $message);

    }

    public function productedit($id){
        $action = "edit";
        $the_loai = DB::table("categories")->get();
        $data = DB::table("product")->where("id",$id)->first();
        return view("admin.form_product",compact("the_loai","action","data"));
    }

    public function productdelete(Request $request)
    {
        $id = $request->id;
        DB::table("product")->where("id",$id)->delete();
        return redirect()->route('adminproduct')->with('status', "Xóa thành công");
    }

    //admin quản lý user
    public function list_user()
    {
        $data = DB::select("select * from users where roles = 0");
        return view("admin.listuser",compact("data"));
    }

    //quản lý admin
    public function list_admin()
    {
        $data = DB::select("select * from users where roles != 0");
        return view("admin.quanlyadmin",compact("data"));
    }

    //THÊM ADMIN

    public function admincreate()
    {
        $action = "add";
        return view("admin.form_admin",compact("action"));
    }

    //LƯU ADMIN
    public function adminsave($action, Request $request)
    {
        $request->validate([
        'name' => ['required', 'string', 'max:225'],
        'email' => ['required', 'string', 'max:225'],
        'phone' => ['nullable', 'string', 'max:10'],
        'address' => ['nullable', 'string', 'max:225'],
        'password' => ['nullable', 'string', 'min:8'],
        'roles' => ['nullable', 'max:2'],
        ]);
        
        
        $data = $request->except("_token");

        if($action=="edit")
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
            ];

        $message = "";

        if ($action == 'add' || !empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        if($action=="add")
        {
            DB::table("users")->insert($data);
            $message = "Thêm thành công";
        }
        else if($action=="edit")
        {
            $id = $request->id;
            DB::table("users")->where("id",$id)->update($data);
            $message = "Cập nhật thành công";
        }

        return redirect()->route('list_admin')->with('status', $message);
    }
    
    //SỬA ADMIN
    public function adminedit($id)
    {
        $action = "edit";
        $admin = DB::table("users")->where("id",$id)->first();
        return view("admin.form_admin",compact("action","admin"));
    }

    //XÓA ADMIN
    public function admindelete(Request $request)
    {
        $id = $request->id;
        DB::table("users")->where("id",$id)->delete();
        return redirect()->route('list_admin')->with('status', "Xóa thành công admin!");
    }

    //BLOG
    /*
    public function blog_list(){
        $data = DB::select("select * from blog ");
        $cata_blog = DB::table('blog')
                            ->whereNotNull('cate_id')
                            ->paginate(8);
        return view("blog.blog_list", compact("data","cata_blog"));
    }*/

    public function cate_blog($id)
    {
        $namecateResult = DB::select("select * from cate_blog where cate_id = ?", [$id]);
        $namecate = null;

        if (count($namecateResult) > 0) {
            $namecate = $namecateResult[0];
        } else {
            // Xử lý trường hợp không tìm thấy danh mục
            return redirect()->back()->withErrors('Không tìm thấy danh mục.');
        }
        //$namecate = DB::select("select * from cate_blog where cate_id = ?",[$id])[0];
        $data = DB::table('blog')
                ->where('cate_id', $id)
                ->paginate(8);
        
        return view("blog.blog_list", compact("data", "namecate"));
    }

    public function blogDetail($id)
    {
        $dataResult = DB::select("select * from cate_blog c, blog b 
                                    where c.cate_id = b.cate_id
                                    and b.id_blog = ?", [$id]);
        $data = null;

        if (count($dataResult) > 0) {
        $data = $dataResult[0];
        } else {
        // Xử lý trường hợp không tìm thấy chi tiết blog
        return redirect()->back()->withErrors('Không tìm thấy chi tiết blog.');
        }
        /*
        $data = DB::select("select * from cate_blog c, blog b 
                            where c.cate_id = b.cate_id
                            and b.id_blog = ?",[$id])[0];*/

        $comments = Comment::where('blog_id', $data->id_blog)->orderBy('comment_id','DESC')->get();
        //$data = DB::select("select * from blog where id_blog = ?",[$id])[0];
        return view("blog.blog_detail",compact("data","comments"));
    }

    //quản lý blog admin
    public function quanlyblog()
    {
        $data = DB::select("select * from cate_blog c, blog b where c.cate_id = b.cate_id");
        //$data = DB::select("select * from blog");
        return view("blog.quanlyblog",compact("data"));
    }

    //THÊM blog 
    public function blogadd()
    {
        $the_loai = DB::table("cate_blog")->get();
        $action = "add";
        return view("blog.form_blog",compact("the_loai","action"));
    }

    //LƯU blog ADMIN
    public function blogsave($action, Request $request)
{
    $request->validate([
        'title' => ['required', 'string', 'max:1000'],
        'first_part' => ['required', 'string', 'max:5000'],
        'second_part' => ['nullable', 'string', 'max:1000'],
        'end_part' => ['nullable', 'string', 'max:5000'],
        'image_title' => ['nullable', 'image'],
        'image_1' => ['nullable', 'image'],
        'image_2' => ['nullable', 'image'],
        'image_3' => ['nullable', 'image'],
        'cate_id' => ['required', 'max:2'],
    ]);

    $data = $request->except("_token");

    if ($action == "edit") {
        $data = $request->except("_token", "id");
    }
    $message = "";

    if ($request->hasFile("image_title")) {
        $fileName = time() . '_' . uniqid() . '.' . $request->file('image_title')->extension();
        $request->file('image_title')->storeAs('public/front/image', $fileName);
        $data['image_title'] = $fileName;
    }

    if ($request->hasFile("image_1")) {
        $fileName = time() . '_' . uniqid() . '.' . $request->file('image_1')->extension();
        $request->file('image_1')->storeAs('public/front/image', $fileName);
        $data['image_1'] = $fileName;
    }

    if ($request->hasFile("image_2")) {
        $fileName = time() . '_' . uniqid() . '.' . $request->file('image_2')->extension();
        $request->file('image_2')->storeAs('public/front/image', $fileName);
        $data['image_2'] = $fileName;
    }

    if ($request->hasFile("image_3")) {
        $fileName = time() . '_' . uniqid() . '.' . $request->file('image_3')->extension();
        $request->file('image_3')->storeAs('public/front/image', $fileName);
        $data['image_3'] = $fileName;
    }

    if ($action == "add") {
        DB::table("blog")->insert($data);
        $message = "Thêm blog thành công";
    } else if ($action == "edit") {
        $id = $request->id;
        DB::table("blog")->where("id_blog", $id)->update($data);
        $message = "Cập nhật blog thành công";
    }

    return redirect()->route('quanlyblog')->with('status', $message);
}

    
    
    //SỬA blog ADMIN
    public function blogedit($id)
    {
        $action = "edit";
        $the_loai = DB::table("cate_blog")->get();
        $data = DB::table("blog")->where("id_blog",$id)->first();
        return view("blog.form_blog",compact("action","the_loai","data"));
    }

    //XÓA blog ADMIN
    public function blogdelete(Request $request)
    {
        $id = $request->id;
        DB::table("blog")->where("id_blog",$id)->delete();
        return redirect()->route('quanlyblog')->with('status', "Xóa thành công Blog!");
    }


    //Liên hệ contact
    public function contact()
    {
        return view("main.contact");
    }

    function savecontact(Request $request)
    {
        $request->validate([
        'name_contact' => ['nullable', 'string', 'max:255'],
        'email_contact' => ['nullable', 'string', 'email', 'max:255'],
        'phone_contact' => ['nullable', 'string'],
        'content_contact' => ['required', 'string', 'max:255']
        ]);

        $data = $request->except("_token");

        $message = "";
        DB::table("contact")->insert($data);
        return redirect()->route('contact')->with('status', 'Gửi liên hệ thành công!');
    }

    //quản lý liên hệ

    public function quanlycontact()
    {
        $data = DB::select("select * from contact");
        return view("admin.quanlycontact",compact("data"));
    }
//comment
    function postcomment (Request $request, $id)
    {
        $data = $id;
        $comment = new Comment;
        $comment->user_id=Auth::user()->id;
        $comment->product_id=$data;
        $comment->blog_id=$data;
        $comment->comment=$request->comment;
        $comment->save();
        return redirect()->back()->with('status', "Thêm bình luận thành công");
    }
/*
    function blogcomment (Request $request, $id)
    {
        $data = $id;
        $comment = new Comment;
        $comment->user_id=Auth::user()->id;
        $comment->blog_id=$data;
        $comment->comment=$request->comment;
        $comment->save();
        return redirect()->back()->with('status', "Thêm bình luận thành công");
    }*/

    
    //  qly đơn hàng
    public function quanlyorder()
    {
         // Lấy dữ liệu đơn hàng từ cơ sở dữ liệu
         $orders = DB::table('orders')
         ->join('users', 'orders.user_id', '=', 'users.id')
         ->select(
             'orders.id_order as id_order_1',
             'users.name as customer_name',
             'users.id as user_id',
             'orders.date',
             'orders.payments',
             'orders.status',
             'orders.total_price'
         )
         ->get();

        // Lấy chi tiết các sản phẩm trong đơn hàng
        $orderDetails = DB::table('order_detail')
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->select(
                'order_detail.id_order',
                'product.name as product_name',
                'order_detail.quantity',
                'order_detail.price'
            )
            ->get();

     // Gộp các sản phẩm theo ID đơn hàng
     $groupedOrders = [];
     foreach ($orders as $order) {
         $order->products = $orderDetails->where('id_order', $order->id_order_1);
         $groupedOrders[$order->id_order_1] = $order;
     }

     // Trả dữ liệu về view
     return view('cart.quanlyorder', compact('orders'));
    }

    public function order_delete(Request $request)
    {
        $id = $request->id;
        DB::table("order_detail")->where("id_order",$id)->delete();
        DB::table("orders")->where("id_order",$id)->delete();
        return redirect()->route('quanlyorder')->with('status', "Xóa thành công");
    }

    public function order_edit(Request $request)
    {
        $id_order_1 = $request->id_order_1;
        $user_id = $request->user_id;
    
        $user = DB::table("users")->where("id", $user_id)->first();
        $order = DB::table("orders")->where("id_order", $id_order_1)->first();
        $orderDetails = DB::table('order_detail')
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->where('order_detail.id_order', $id_order_1)
            ->select(
                'product.name as product_name',
                'order_detail.quantity'
            )
            ->get();
    
        return view("cart.order_form", compact('user', 'order', 'orderDetails'));
    }
    

    public function order_save(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'id_order' => 'required|integer',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
            'payments' => 'nullable|string',
        ]);

        // Xử lý giá trị của total_price để chuyển đổi từ định dạng có dấu chấm thành số nguyên
        $totalPrice = str_replace(['.', '.'], '', $request->total_price); // Loại bỏ dấu chấm
        $totalPrice = Intval($totalPrice);// Chuyển đổi thành số nguyên

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
        ]);

        DB::table('orders')->where('id_order', $request->id_order)->update([
            'total_price' => $totalPrice,
            'status' => $request->status,
            'payments' => $request->payments,
        ]);

        return redirect()->route('quanlyorder')->with('status', 'Cập nhật thông tin thành công!');
    }

    public function manager_user(){
        $user = Auth::user();
        return view("user.manager_user", compact("user"));
    }

    public function editProfile(){
        $user = Auth::user();
        return view("user.form_user", compact("user"));
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
        ];

        DB::table('users')->where('id', $user->id)->update($data);

        return redirect()->route('manager_user')->with('status', 'Thông tin cá nhân đã được cập nhật.');
    }

}
