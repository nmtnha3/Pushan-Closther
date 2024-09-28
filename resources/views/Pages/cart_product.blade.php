<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('pages.header');

    <main class="mx-[100px] mt-[80px] py-[50px] flex justify-between">
        <div class="w-full">
            <div class="grid gap-[20px] items-center pb-[50px]">
                <div>
                    <h1 class="text-left font-semibold"><a href="home"
                            class="text-gray-500 hover:text-black transition-all">Trang chủ /</a> Giỏ hàng của bạn</h1>
                </div>

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

                @if ($isEmptyCart === false)
                    <div class="flex justify-between gap-[50px]">
                        <table class="border-[2px] text-center w-[70%]">
                            <tr class="w-full border-[2px]">
                                <td class="w-[25%] border-[2px] p-[10px]">Tên sản phẩm</td>
                                <td class="w-[20%] border-[2px] p-[10px]">Ảnh sản phẩm</td>
                                <td class="w-[15%] border-[2px] p-[10px]">Giá sản phẩm</td>
                                <td class="w-[10%] border-[2px] p-[10px]">Size</td>
                                <td class="w-[20%] border-[2px] p-[10px]">Số lượng</td>
                                <td class="w-[10%] border-[2px] p-[10px]">Xóa</td>
                            </tr>

                            @foreach ($products as $product)
                                <tr class="border-[2px]">
                                    <td class="border-[2px] p-[10px]">
                                        {{ \Illuminate\Support\Str::limit($product->name, 50) }}
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        <img src="{{ $product->image }}" alt="" class="h-[100px] mx-auto">
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        {{ $product->price }}₫
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        {{ $sizeByProductId[$product->id] }}
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        <form action="{{ route('updateCart') }}" method="POST"
                                            class="flex justify-between items-center">
                                            @csrf
                                            <input type="number" value="{{ $quantityByProductId[$product->id] }}"
                                                name="quantityCart" id="quantityCart" min="1" max="100"
                                                class="quantityCart w-[80px] bg-gray-200 p-[5px] rounded-[5px] outline-none text-center">
                                            <input type="hidden" value="{{ $product->id }}" name="idProduct">
                                            <button
                                                class="w-[40px] h-[40px] bg-blue-200 rounded-full font-medium flex items-center justify-center"
                                                type="submit"><i class='bx bx-save text-[20px]'></i></button>
                                        </form>
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        <form action="{{ route('deleteCart') }}" method="POST"
                                            class="flex justify-center">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $product->id }}" name="idProduct">
                                            <button
                                                class="w-[40px] h-[40px] bg-red-200 rounded-full font-medium flex items-center justify-center"
                                                type="submit"><i class='bx bx-trash text-[20px]'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="w-[30%] bg-gray-100 border-[2px] rounded-[10px] h-max p-[20px] grid gap-[20px]">
                            <div class="flex items-center justify-between border-b-[2px] pb-[10px]">
                                <span class="font-medium">Tổng tiền</span>
                                <p class="text-gray-500 font-medium">{{ $totalPrice }}₫</p>
                            </div>

                            <form action="{{ route('show-pay') }}" method="GET" class="w-full flex justify-center">
                                <button type="submit" class="font-medium bg-blue-200 rounded-[20px] p-[10px] w-[50%]">Thanh toán</button>
                            </form>

                            <a href="product" class="text-blue-500">Tiếp tục mua hàng?</a>
                        </div>
                    </div>
                @else
                    <div class="grid items-center justify-center text-center">
                        <h1>Không có sản phẩm nào trong giỏ hàng. <a href="product" class="text-blue-500">Tiếp tục mua
                                hàng?</a></h1>
                        <img src="/image/empty-cart.png" class="h-[400px] cursor-pointer" alt="">
                    </div>
                @endif
            </div>
        </div>
    </main>

    @include('Pages.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/script/ajax.js"></script>
</body>

</html>
