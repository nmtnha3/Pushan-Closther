<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('pages.header');

    <form action="{{ route('order') }}" method="POST">
        @csrf
        <main class="mt-[80px] w-full gap-[50px] px-[100px] py-[50px] grid">
            <div class="flex items-center justify-between">
                <h1 class="text-left font-semibold"><a href="home"
                        class="text-gray-500 hover:text-black transition-all">Trang chủ /</a> Đặt hàng</h1>

                <div>
                    @if (session('success'))
                        <div class="alert alert-success text-blue-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger text-red-500">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>


            <div class="w-full flex gap-[20px] h-max">
                <div
                    class="bg-gray-100 p-[20px] h-max rounded-[10px] border-[2px] border-blue-200 w-[32%] grid gap-[20px]">
                    <div class="flex items-center justify-between">
                        <h1 class="font-medium uppercase">Thông tin nhận hàng</h1>

                        <a href="change_user" class="text-blue-500">Chỉnh sửa thông tin</a>
                    </div>

                    <div class="grid gap-[10px]">
                        <span class="font-medium">Họ và tên</span>

                        <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->name }}</p>
                    </div>

                    <div class="grid gap-[10px]">
                        <span class="font-medium">Email</span>

                        <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->name }}</p>
                    </div>

                    <div class="grid gap-[10px]">
                        <span class="font-medium">Giới tính</span>

                        <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->gender }}</p>
                    </div>

                    <div class="grid gap-[10px]">
                        <span class="font-medium">Sinh nhật</span>

                        <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->birth }}</p>
                    </div>

                    <div class="grid gap-[10px]">
                        <span class="font-medium">Số điện thoại</span>

                        <p class="border-b-[2px] border-gray-200 pb-[5px]">
                            {{ $user->telephone ? $user->telephone : 'Chưa có thông tin' }}</p>
                    </div>

                    <div class="grid gap-[10px]">
                        <span class="font-medium">Địa chỉ</span>

                        <p class="border-b-[2px] border-gray-200 pb-[5px]">
                            {{ $user->address ? $user->address : 'Chưa có thông tin' }}</p>
                    </div>
                </div>

                <div
                    class="bg-gray-100 p-[20px] rounded-[10px] border-[2px] border-blue-200 h-max w-[30%] grid gap-[20px]">
                    <h1 class="font-medium uppercase">Thanh toán</h1>

                    <div class="border-[2px] border-blue-200 rounded-[10px] flex items-center justify-between p-[20px]">
                        <div class="flex items-center gap-[10px]">
                            <input type="radio" class="w-[20px] h-[20px]" value="bank" name="chose_pay">
                            <p class="text-gray-600">Thanh toán bằng chuyển khoản</p>
                        </div>

                        <i class='bx bx-credit-card text-[22px] text-blue-500'></i>
                    </div>

                    <div class="border-[2px] border-blue-200 rounded-[10px] flex items-center justify-between p-[20px]">
                        <div class="flex items-center gap-[10px]">
                            <input type="radio" class="w-[20px] h-[20px]" value="cod" name="chose_pay">
                            <p class="text-gray-600">Thanh toán khi nhận hàng (COD)</p>
                        </div>

                        <i class='bx bx-money text-[22px] text-blue-500'></i>
                    </div>
                </div>

                <div
                    class="w-[38%] bg-gray-100 p-[20px] rounded-[10px] border-[2px] border-blue-200 h-max grid gap-[20px]">
                    <h1 class="font-medium uppercase">Đơn hàng</h1>

                    <div
                        class="grid items-start border-t-[2px] pt-[20px] gap-[10px] h-[340px] overflow-y-scroll scroll-container">
                        @foreach ($products as $product)
                            <div class="flex items-center gap-[10px]">
                                <img src="{{ $product->image }}" alt="" class="h-[100px] rounded-[10px]">
                                <input type="hidden" name="products[{{ $product->id }}][product_id]"
                                    value="{{ $product->id }}">

                                <div class="flex justify-between items-end">
                                    <div class="grid gap-[10px]">
                                        <div class="grid">
                                            <span>{{ \Illuminate\Support\Str::limit($product->name, 30) }}</span>
                                            <p class="text-gray-500 text-[14px]">Size
                                                {{ $sizeByProductId[$product->id] }}</p>
                                        </div>

                                        <input type="text" name="products[{{ $product->id }}][quantity]"
                                            value="{{ $quantityByProductId[$product->id] }}"
                                            class="h-[30px] w-[30px] rounded-full bg-blue-200 flex items-center justify-center text-center outline-none"
                                            readonly>
                                    </div>

                                    <span class="text-gray-500 font-medium" id="productPrice_{{ $product->id }}">
                                        {{ $product->price * $quantityByProductId[$product->id] }}₫
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t-[2px] pt-[20px] grid gap-[20px]">
                        <h1 class="text-blue-500 font-medium">Mã giảm giá</h1>
                        <div class="flex items-center gap-[10px]">
                            <ul class="grid w-full gap-6 md:grid-cols-2 h-[130px] overflow-y-scroll scroll-container">
                                @foreach ($discounts as $discount)
                                    <li>
                                        <input type="radio" id="{{ $discount->id }}" name="discount"
                                            value="{{ $discount->percentage }}" class="hidden peer" required>
                                        <label for="{{ $discount->id }}"
                                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">{{ $discount->code }}</div>
                                                <div class="w-full">Tổng giá trị đơn hàng của bạn.</div>
                                            </div>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="border-t-[2px] pt-[20px] grid gap-[10px]">
                        <div class="flex items-center justify-between">
                            <h1 class="font-medium">Tạm tính</h1>

                            <input type="text" readonly class="text-gray-500 text-right bg-gray-100 outline-none"
                                value="{{ $totalPrice }}₫" id="tempTotalPrice">
                        </div>

                        <div class="flex items-center justify-between">
                            <h1 class="font-medium">Phí vận chuyển</h1>

                            <span class="text-gray-500">0₫</span>
                        </div>
                    </div>


                    <div class="border-t-[2px] pt-[20px] grid gap-[10px]">
                        <div class="flex items-center justify-between">
                            <h1 class="font-medium">Giảm giá</h1>

                            <span class="text-red-500" id="tempDiscount">0₫</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <h1 class="font-medium">Tổng tiền</h1>

                            <div class="flex items-center">
                                <input type="text" name="totalPrice" readonly
                                    class="text-blue-500 text-right font-medium bg-gray-100 outline-none"
                                    value="{{ $totalPrice }}" id="totalPrice"><span
                                    class="text-blue-500 font-medium">₫</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="cart_product" class="text-blue-500">Quay lại giỏ hàng?</a>

                        <button class="bg-blue-200 p-[10px] h-[50px] w-[30%] rounded-[10px]">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </main>
    </form>

    @include('Pages.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/script/pay.js"></script>
</body>

</html>
