<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('pages.header');

    <main class="grid mt-[120px] w-full h-max gap-[50px] px-[100px] pb-[50px]">
        <form action="{{ route('addCart') }}" method="POST" class="items-center flex gap-[50px]">
            @csrf
            <input type="hidden" value="{{ $products->id }}" name="idProduct">
            <div class="border-[2px] rounded-[10px] bg-gray-100">
                <img src="{{ $products->image }}" alt="" class="h-[450px]">
            </div>

            <div class="grid items-center gap-[30px]">
                <div>
                    <h1 class="font-semibold text-[20px]">{{ $products->name }}</h1>

                    <span class="text-gray-500 text-[18px] font-semibold">{{ $products->price }}₫</span>
                </div>

                <div class="flex items-center gap-[20px]">
                    <span class="font-semibold w-[70px]">Size</span>

                    <select name="sizeProduct" id="sizeProduct"
                        class="w-[100px] outline-none border-[2px] p-[5px] rounded-[5px] border-blue-200">
                        <option value="M" selected>M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>

                <div class="flex items-center gap-[20px]">
                    <span class="font-semibold w-[70px]">Số lượng</span>

                    <div class="w-[100px] p-[5px] border-[2px] rounded-[5px] border-blue-200">
                        <input type="number" name="quantityProduct" class="outline-none w-full text-center"
                            min="1" max="100" value="1">
                    </div>
                </div>

                <div class="flex items-center gap-[50px]">
                    <button
                        class="text-blue-500 flex items-center gap-[5px] border-[2px] border-gray-300 p-[15px] bg-gray-200 rounded-[10px] font-medium"
                        type="submit"><i class='bx bxs-cart-add bx-tada bx-flip-horizontal text-[25px]'></i>Thêm vào
                        giỏ</button>
                </div>
            </div>
        </form>

        <div class="grid gap-[20px]">
            <div class="grid items-center gap-[20px]">
                <h1 class="text-left font-semibold text-[20px] border-b-[3px] pb-[5px] w-max border-yellow-500">MÔ TẢ
                    SẢN
                    PHẨM</h1>

                <div>{!! $products->description !!}</div>
            </div>

            <div class="grid grid-cols-2 gap-[20px]">
                <div class="grid gap-[10px]">
                    <h1 class="text-left font-semibold text-[20px]">DANH SÁCH ĐÁNH GIÁ SẢN PHẨM</h1>

                    <div class="h-max max-h-[200px] overflow-y-auto scroll-container grid gap-[10px]">
                        @foreach ($rates as $rate)
                            <div class="border-[2px] rounded-[10px] p-[10px] flex items-center gap-[20px]">
                                <div class="grid">
                                    <span class="w-[150px] font-medium text-blue-500">{{ $rate->user->name }}</span>
                                    <p class="text-gray-500 text-[14px]">{{ $rate->created_at }}</p>
                                </div>

                                <p>{{ $rate->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($userHasOrdered)
                    <form action="{{ route('createRate') }}" method="POST">
                        @csrf
                        <div class="grid gap-[10px]">
                            <h1
                                class="text-left font-semibold text-[20px] border-b-[3px] pb-[5px] w-max border-yellow-500">
                                ĐÁNH GIÁ SẢN PHẨM</h1>

                            <input type="hidden" name="idProduct" value="{{ $products->id }}">

                            <div class="border-[2px] rounded-[10px] border-blue-200 grid gap-[10px] p-[20px]">
                                <textarea name="content" id="content"
                                    class="outline-none resize-none w-full overflow-y-auto scroll-container h-[80px]"></textarea>

                                <div class="flex justify-end">
                                    <button class="bg-gray-200 p-[10px] rounded-[5px] font-medium">Đánh giá</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <div class="w-full grid gap-[50px]">
            <h1 class="font-semibold text-center text-[20px] uppercase">Những dòng sản phẩm khác</h1>

            <div class="grid grid-cols-4 gap-[20px] cursor-pointer">
                @foreach ($randomProducts as $product)
                    <div class="grid bg-gray-100 rounded-[10px] border-[1px]">
                        <form action="{{ route('show-details_product') }}" method="GET">
                            <input type="hidden" name="idProduct" value="{{ $product->id }}">
                            <div class="flex items-center justify-center pt-[20px]">
                                <img src="{{ $product->image }}" alt="" class="h-[250px] rounded-[10px]">
                            </div>

                            <div class="px-[30px] pb-[30px] flex items-center justify-between py-[20px]">
                                <button type="submit"
                                    class="text-left font-medium w-[150px]">{{ Str::limit($product->name, 40) }}</button>

                                <div class="grid items-center gap-[10px]">
                                    <p class="text-gray-500 text-right font-semibold">{{ $product->price }}₫</p>

                                    <button type="submit"
                                        class="font-medium text-blue-500 bg-blue-100 p-[10px] rounded-[5px]">Xem
                                        thêm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('Pages.footer')
</body>

</html>
