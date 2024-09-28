<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Discount;
use App\Models\Message;
use App\Models\Order;
use App\Models\Post;
use App\Models\Rate;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function showDetailsProduct(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();

        $productId = $request->input('idProduct');
        $products = Product::find($productId);
        $rates = Rate::where('product_id', $productId)->get();

        $randomProducts = Product::inRandomOrder()->take(4)->get();

        $orderDetails = OrderDetail::where('product_id', $productId)->get();

        $userHasOrdered = false;

        foreach ($orderDetails as $orderDetail) {
            $order = Order::find($orderDetail->order_id);

            if ($order && $order->user_id == Auth::id() && $order->order_status == 'Đã xác nhận') {
                $userHasOrdered = true;
                break;
            }
        }

        return view('pages.details_product', compact('menus', 'randomProducts', 'products', 'rates', 'userHasOrdered'));
    }

    public function blog()
    {
        $menus = Menu::orderBy('parent_id')->get();
        $blogs = Post::all();

        return view('Pages.blog', compact('blogs', 'menus'));
    }

    public function contact()
    {
        $menus = Menu::orderBy('parent_id')->get();

        return view('Pages.contact', compact('menus'));
    }

    public function chat(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();

        $receiver_id = $request->receiver_id;
        $room_id = $request->room_id;

        $user = User::find($receiver_id);

        $messages = Message::get();

        return view('Pages.chat', compact('menus', 'messages', 'receiver_id', 'room_id', 'user'));
    }

    public function product(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();
        $products = Product::orderBy('id', 'desc')->get();

        return view('Pages.product', compact('menus', 'products'));
    }

    public function showCategoryProduct(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();

        $categoryId = $request->input('categoryID');
        $category = Menu::find($categoryId);

        $productCategory = Product::where('category', $categoryId)->get();

        return view('pages.category_product', compact('menus', 'productCategory', 'category'));
    }

    public function showCategory(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();

        $categoryId = $request->input('categoryID');
        $category = Menu::find($categoryId);

        $childCategoryIds = $category->children->pluck('id');
        $productCategory = Product::whereIn('category', $childCategoryIds)->get();

        return view('pages.category_product', compact('menus', 'productCategory', 'category'));
    }

    public function showUser()
    {
        if (Auth::check()) {
            $menus = Menu::orderBy('parent_id')->get();
            $user = User::find(Auth::id());
            return view('pages.user', compact('menus', 'user'));
        }
        return redirect()->route('show-form-login');
    }

    public function showUserOrder()
    {
        if (Auth::check()) {
            $menus = Menu::orderBy('parent_id')->get();
            $user = User::find(Auth::id());
            $orders = Order::where('user_id', Auth::id())->get();

            return view('Pages.user_order', compact('menus', 'user', 'orders'));
        }
        return redirect()->route('show-form-login');
    }

    public function showChangeUser()
    {
        if (Auth::check()) {
            $menus = Menu::orderBy('parent_id')->get();
            $user = User::find(Auth::id());
            return view('pages.change_user', compact('menus', 'user'));
        }
        return redirect()->route('show-form-login');
    }

    public function calculateAge($birthdate)
    {
        $birthday = new DateTime($birthdate);
        $minAge = new DateTime('-14 years');
        return ($birthday <= $minAge);
    }

    public function changeInfo(Request $request)
    {
        $err = [];

        $user = User::find(Auth::id());
        $user->name = $request->username;
        $user->telephone = $request->telephone;
        $user->birth = $request->birthdate;
        $user->gender = $request->gender;
        $user->address = $request->address;

        if (empty($request->username) || empty($request->gender)) {
            $err[] = 'Tên người dùng không được trống.';
        }

        if (!$this->calculateAge($request->birthdate)) {
            $err['birth'] = 'Sinh nhật chưa đủ 14 tuổi.';
        }

        if (empty($err)) {
            $user->save();
            return redirect()->route('show-change-user')->with('success', 'Chỉnh sửa thông tin thành công.');
        } else {
            return redirect()->route('show-change-user')->withErrors($err)->withInput();
        }
    }

    public function showCartProduct(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();
        $isEmptyCart = false;
        $totalPrice = 0;

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();
            $productIds = $cartItems->pluck('product_id')->toArray();
            $quantityByProductId = $cartItems->pluck('quantity', 'product_id')->toArray();
            $sizeByProductId = $cartItems->pluck('size', 'product_id')->toArray();

            if ($cartItems->isEmpty()) {
                $isEmptyCart = true;
            }
        } else {
            $cartItems = session('cart', []);
            $productIds = array_column($cartItems, 'product_id');
            $quantityByProductId = array_column($cartItems, 'quantity', 'product_id');
            $sizeByProductId = array_column($cartItems, 'size', 'product_id');

            if (empty($cartItems)) {
                $isEmptyCart = true;
            }
        }

        $products = Product::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $productId = $product->id;
            $quantity = $quantityByProductId[$productId];
            $price = $product->price;
            $totalPrice += $quantity * $price;
        }

        return view('pages.cart_product', compact('menus', 'sizeByProductId', 'products', 'quantityByProductId', 'isEmptyCart', 'totalPrice'));
    }


    public function addCart(Request $request)
    {
        $productId = $request->idProduct;
        $quantity = $request->quantityProduct;
        $size = $request->sizeProduct;

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $productId)
                ->first();

            if ($cart) {
                $cart->quantity += $quantity;
                $cart->save();
            } else {
                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $productId;
                $cart->quantity = $quantity;
                $cart->size = $size;
                $cart->save();
            }

            return redirect()->route('show-cart_product');
        } else {
            $cartItems = session('cart', []);

            $existingCartItemKey = null;
            foreach ($cartItems as $key => $cartItem) {
                if ($cartItem['product_id'] == $productId) {
                    $existingCartItemKey = $key;
                    break;
                }
            }

            if ($existingCartItemKey !== null) {
                $cartItems[$existingCartItemKey]['quantity'] += $quantity;
            } else {
                $cartItem = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'size' => $size
                ];
                $cartItems[] = $cartItem;
            }

            session(['cart' => $cartItems]);

            return redirect()->route('show-cart_product');
        }
    }

    public function deleteCart(Request $request)
    {
        $productId = $request->idProduct;

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $productId)
                ->first();

            if ($cart) {
                $cart->delete();
            }
        } else {
            $cartItems = session('cart', []);

            $existingCartItemKey = null;
            foreach ($cartItems as $key => $cartItem) {
                if ($cartItem['product_id'] == $productId) {
                    $existingCartItemKey = $key;
                    break;
                }
            }

            if ($existingCartItemKey !== null) {
                unset($cartItems[$existingCartItemKey]);
                session(['cart' => $cartItems]);
            }
        }

        return redirect()->route('show-cart_product');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $results = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $output = [];

            foreach ($results as $result) {
                $output[] = [
                    'id' => $result->id,
                    'name' => $result->name,
                    'image' => $result->image,
                    'price' => $result->price
                ];
            }

            return response()->json(['success' => true, 'results' => $output]);
        }
    }

    public function updateCart(Request $request)
    {
        $productId = $request->idProduct;
        $quantity = $request->quantityCart;

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $productId)
                ->first();

            if ($cart) {
                $cart->quantity = $quantity;
                $cart->save();
            }
        } else {
            $cartItems = session('cart', []);

            $existingCartItemKey = null;
            foreach ($cartItems as $key => &$cartItem) {
                if ($cartItem['product_id'] == $productId) {
                    $cartItem['quantity'] = $quantity;
                    break;
                }
            }

            session(['cart' => $cartItems]);
        }

        return redirect()->route('show-cart_product');
    }

    public function pay(Request $request)
    {
        $menus = Menu::orderBy('parent_id')->get();

        if (Auth::check()) {
            $user = User::find(Auth::id());
            $isEmptyCart = false;
            $totalPrice = 0;

            $cartItems = Cart::where('user_id', Auth::user()->id)->get();
            $productIds = $cartItems->pluck('product_id')->toArray();
            $quantityByProductId = $cartItems->pluck('quantity', 'product_id')->toArray();
            $sizeByProductId = $cartItems->pluck('size', 'product_id')->toArray();

            if ($cartItems->isEmpty()) {
                $isEmptyCart = true;
            }

            $discounts = Discount::get();

            $products = Product::whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                $productId = $product->id;
                $quantity = $quantityByProductId[$productId];
                $price = $product->price;
                $totalPrice += $quantity * $price;
            }

            return view('Pages.pay', compact('menus', 'sizeByProductId', 'products', 'quantityByProductId', 'isEmptyCart', 'totalPrice', 'user', 'discounts'));
        }
    }

    public function order(Request $request)
    {
        $user = Auth::user();
        if (empty($user->telephone) || empty($user->address)) {
            return redirect()->back()->with('error', 'Vui lòng cập nhật số điện thoại, và đỉa chỉ.');
        } else {
            $order = new Order();

            $order->user_id = Auth::id();
            $order->order_date = now();
            $order->order_status = 'Chờ xác nhận';
            $order->total_order_value = $request->totalPrice;
            $order->payment_method = $request->chose_pay;

            $order->save();

            foreach ($request->products as $productId => $productDetails) {
                $orderDetail = new OrderDetail();

                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $productDetails['product_id'];
                $orderDetail->quantity = $productDetails['quantity'];

                $orderDetail->save();
            }

            $cart  = Cart::where('user_id', Auth::id());
            $cart->delete();

            return redirect()->route('show-userOrder')->with('success', 'Đặt hàng thành công.');
        }
    }

    public function cancelOrder(Request $request)
    {
        $order_id = $request->order_id;

        $order = Order::find($order_id);

        if ($order) {
            $order->order_status = 'Yêu cầu hủy';
            $order->save();

            return redirect()->back()->with('success', 'Hủy đơn hàng thành công.');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }
    }

    public function createRate(Request $request)
    {
        $idProduct = $request->idProduct;

        $rate = new Rate();

        $rate->product_id = $idProduct;
        $rate->user_id = Auth::id();
        $rate->comment = $request->content;

        $rate->save();

        return redirect()->back()->with('success', 'Đánh giá sản phẩm hàng thành công.');
    }

    public function sendMessage(Request $request)
    {
        $receiver_id = $request->receiver_id;
        $room_id = $request->room_id;

        $message = new Message();

        $message->sender_id = Auth::id();
        $message->receiver_id = $receiver_id;
        $message->room_id = $room_id;
        $message->content = $request->content;

        $message->save();

        return redirect()->back();
    }
}
