<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Menu;
use App\Models\Slide;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Post;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function showCollection()
    {
        $menus = Menu::orderBy('parent_id')->get();

        return view('pages.collection', compact('menus'));
    }

    public function showAdmin()
    {
        $menus = Menu::orderBy('parent_id')->get();
        return view('admin.admin', compact('menus'));
    }

    public function showHome()
    {
        $menus = Menu::orderBy('parent_id')->get();
        $products = Product::orderBy('id', 'desc')->take(4)->get();
        $randomProducts = Product::inRandomOrder()->take(8)->get();
        $slides = Slide::all();
        $posts = Post::take(2)->get();

        $admin = User::where('role', 'admin')->first();

        return view('pages.home', compact('menus', 'products', 'randomProducts', 'slides', 'posts', 'admin'));
    }

    public function showManagerUser()
    {
        $menus = Menu::orderBy('parent_id')->get();
        $users = User::get();

        return view('Admin.manager_user', compact('menus', 'users'));
    }

    public function showManagerProduct()
    {
        $products = Product::orderBy('id')->get();
        $categories = Menu::pluck('name', 'id');
        return view('admin.manager_product', compact('products', 'categories'));
    }

    public function showSale()
    {
        $discounts = Discount::get();
        return view('Admin.manager_sale', compact('discounts'));
    }

    public function showSlide()
    {
        $slides = Slide::get();
        return view('Admin.manager_slide', compact('slides'));
    }

    public function showContact()
    {
        $users = User::get();
        return view('Admin.manager_contact', compact('users'));
    }

    public function showPost()
    {
        $posts = Post::get();
        return view('Admin.manager_post', compact('posts'));
    }

    public function showOrder()
    {
        $orders = Order::get();
        return view('Admin.manager_order', compact('orders'));
    }

    public function showRate()
    {
        $rates = Rate::get();

        return view('Admin.manager_rate', compact('rates'));
    }

    public function showAddProduct()
    {
        $menus = Menu::orderBy('parent_id')->get();

        return view('admin.add_product', compact('menus'));
    }

    public function createMenu(Request $request)
    {
        $menu = new Menu();

        $menu->name = $request->nameMenu;
        $menu->parent_id = $request->parent_id;
        $menu->url = $request->urlMenu;

        $err = [];

        if (empty($menu->name)) {
            $err[] = 'Tên Menu không được rỗng.';
        }

        if (empty($err)) {
            $menu->save();
            return redirect()->route('show-admin')->with('success', 'Lưu thông tin Menu thành công.');
        }

        return redirect()->route('show-admin')->withErrors($err)->withInput();
    }

    public function editMenu(Request $request)
    {
        $menuId = $request->input('menu_id');

        $err = [];

        if (empty($menuId)) {
            $err[] = 'Hãy chọn menu cần sửa.';
        }

        $menu = Menu::find($menuId);

        $menu->name = $request->input('nameMenu');
        $menu->url = $request->input('urlMenu');

        if (empty($menu->name)) {
            $err[] = 'Tên Menu không được rỗng.';
        }

        if (empty($err)) {
            $menu->save();
            return redirect()->route('show-admin')->with('success', 'Chỉnh sửa thông tin Menu thành công.');
        }

        return redirect()->route('show-admin')->withErrors($err)->withInput();
    }

    public function deleteMenu(Request $request)
    {
        $menuId = $request->input('menu_id');

        $menu = Menu::find($menuId);

        Menu::where('parent_id', $menuId)->delete();

        Product::where('category', $menuId)->update(['category' => null]);

        $menu->delete();

        return redirect()->route('show-admin')->with('success', 'Xóa thông tin Menu thành công.');
    }
    public function addProduct(Request $request)
    {
        $product = new Product;
        $product->category = $request->input('nameCategory');
        $product->name = $request->input('nameProduct');
        $product->price = $request->input('priceProduct');
        $product->description = $request->input('descriptionProduct');

        $imageProduct = $request->file('imageProduct');

        if ($imageProduct) {
            $imageProduct_name = $imageProduct->getClientOriginalName();
            $imageProduct_path = 'imageProduct/' . $imageProduct_name;

            $product->image = $imageProduct_path;
            $imageProduct->storeAs('imageProduct', $imageProduct_name, 'imageProduct');
        }

        $product->save();

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    public function editProduct(Request $request)
    {
        $idProduct = $request->input('idProduct');
        $product = Product::find($idProduct);

        $product->category = $request->input('nameCategory');
        $product->name = $request->input('nameProduct');
        $product->price = $request->input('priceProduct');
        $product->description = $request->input('descriptionProduct');

        $imageProduct = $request->file('imageProduct');

        if ($imageProduct) {
            $imageProduct_name = $imageProduct->getClientOriginalName();
            $imageProduct_path = 'imageProduct/' . $imageProduct_name;

            $product->image = $imageProduct_path;
            $imageProduct->storeAs('imageProduct', $imageProduct_name, 'imageProduct');
        }

        $product->update();

        return redirect()->back()->with('success', 'Sản phẩm đã được chỉnh sửa thành công.');
    }

    public function nextEditProduct(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();

        $idProduct = $request->idProduct;

        $nextProduct = Product::find($idProduct);

        if (!$nextProduct) {

            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
        }

        return view('admin.edit_product', compact('nextProduct', 'menus'));
    }
    public function deleteProduct(Request $request)
    {
        $idProduct = $request->idProduct;
        $product = Product::find($idProduct);

        if (!$product) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
        }

        $product->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    public function deleteUser(Request $request)
    {
        $idUser = $request->idUser;
        $user = User::find($idUser);

        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy tài khoản.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Tài khoản đã được xóa thành công.');
    }

    public function addSale(Request $request)
    {
        $discount = new Discount();

        $discount->code = $request->code_sale;
        $discount->percentage = $request->percentage_sale;

        $discount->save();

        return redirect()->back()->with('success', 'Mã giảm giá đã được thêm thành công.');
    }

    public function addSlide(Request $request)
    {

        $slide = new Slide();

        if ($request->hasFile('imageSlide')) {
            $imageSlide = $request->file('imageSlide');
            $imageSlide_name = $imageSlide->getClientOriginalName();
            $imageSlide_path = 'imageSlide/' . $imageSlide_name;

            $imageSlide->storeAs('imageSlide', $imageSlide_name, 'imageSlide');

            $slide->image = $imageSlide_path;

            $slide->save();

            return redirect()->back()->with('success', 'Slide đã được thêm thành công.');
        }
    }

    public function addPost(Request $request)
    {

        $post = new Post();

        if ($request->hasFile('imagePost')) {
            $imagePost = $request->file('imagePost');
            $imagePost_name = $imagePost->getClientOriginalName();
            $imagePost_path = 'imagePost/' . $imagePost_name;

            $imagePost->storeAs('imagePost', $imagePost_name, 'imagePost');

            $post->image = $imagePost_path;
            $post->content = $request->content;

            $post->save();

            return redirect()->back()->with('success', 'Bài viết đã được thêm thành công.');
        }
    }
    public function updateSale(Request $request)
    {
        $idDiscount = $request->idDiscount;

        $disCount = Discount::find($idDiscount);

        $disCount->code =  $request->code_sale;
        $disCount->percentage = $request->percentage_sale;

        $disCount->save();

        return redirect()->back()->with('success', 'Mã giảm giá đã sửa thành công.');
    }

    public function updateSlide(Request $request)
    {
        $idSlide = $request->idSlide;

        $slide = Slide::find($idSlide);

        $current_image = $slide->image;

        if ($request->hasFile('imageSlideEdit')) {
            $imageSlide = $request->file('imageSlideEdit');
            $imageSlide_name = $imageSlide->getClientOriginalName();
            $imageSlide_path = 'imageSlide/' . $imageSlide_name;

            $imageSlide->storeAs('imageSlide', $imageSlide_name, 'imageSlide');

            $slide->image = $imageSlide_path;
            Storage::disk('imageSlide')->delete($current_image);
        } else {
            $slide->image = $current_image;
        }

        $slide->save();

        return redirect()->back()->with('success', 'Slide đã được sửa thành công.');
    }

    public function updatePost(Request $request)
    {
        $idPost = $request->idPost;

        $post = Post::find($idPost);

        $current_image = $post->image;

        if ($request->hasFile('imagePostEdit')) {
            $imagePostEdit = $request->file('imagePostEdit');
            $imagePostEdit_name = $imagePostEdit->getClientOriginalName();
            $imagePostEdit_path = 'imagePost/' . $imagePostEdit_name;

            $imagePostEdit->storeAs('imagePost', $imagePostEdit_name, 'imagePost');

            $post->image = $imagePostEdit_path;
            Storage::disk('imagePost')->delete($current_image);
        } else {
            $post->image = $current_image;
        }

        $post->content = $request->contentEdit;

        $post->save();

        return redirect()->back()->with('success', 'Bài đã được sửa thành công.');
    }

    public function deleteSale(Request $request)
    {
        $idDiscount = $request->idDiscount;
        $disCount = Discount::find($idDiscount);

        if (!$disCount) {
            return redirect()->back()->with('error', 'Không tìm thấy mã giảm giá.');
        }

        $disCount->delete();

        return redirect()->back()->with('success', 'Mã giảm giá đã được xóa thành công.');
    }

    public function deleteSlide(Request $request)
    {
        $idSlide = $request->idSlide;
        $slide = Slide::find($idSlide);

        if (!$slide) {
            return redirect()->back()->with('error', 'Không tìm thấy slide.');
        }

        Storage::disk('imageSlide')->delete($slide->image);

        $slide->delete();
        return redirect()->back()->with('success', 'Slide đã được xóa thành công.');
    }

    public function deletePost(Request $request)
    {
        $idPost = $request->idPost;
        $post = Post::find($idPost);

        if (!$post) {
            return redirect()->back()->with('error', 'Không tìm thấy bài viết.');
        }

        Storage::disk('imagePost')->delete($post->image);

        $post->delete();
        return redirect()->back()->with('success', 'Slide đã được xóa thành công.');
    }

    public function acpOrder(Request $request)
    {
        $order_id = $request->order_id;

        $order = Order::find($order_id);

        if ($order) {
            $order->order_status = 'Đã xác nhận';
            $order->save();

            return redirect()->back()->with('success', 'Duyệt đơn hàng thành công.');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }
    }

    public function deleteOrder(Request $request)
    {
        $order_id = $request->order_id;

        $order = Order::find($order_id);

        if ($order) {

            $order->delete();

            return redirect()->back()->with('success', 'Xóa đơn hàng thành công.');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }
    }
}
