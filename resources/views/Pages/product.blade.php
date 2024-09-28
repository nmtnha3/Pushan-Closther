<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('pages.header');
    <main class="grid mt-[80px] w-full gap-[50px] px-[100px] py-[50px]">
        <div class="flex justify-between items-center">
            <h1 class="font-semibold text-left flex items-center gap-[5px]"><a href="home"
                    class="text-gray-500 hover:text-black">Trang chủ /</a> Tất cả sản phẩm</h1>

            <div class="bg-gray-100 border-[2px] border-blue-200 p-[10px] rounded-[10px] w-[350px] flex items-center">
                <input type="text" id="search-input" name="search-input" placeholder="Nhập tên sản phẩm bạn muốn..." class="outline-none bg-gray-100 w-full">

                <i class='bx bx-search-alt text-[22px]' ></i>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-[20px]" id="search-results">
            @foreach ($products as $product)
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

        <div id="no-results" class="text-center">

        </div>
    </main>

    @include('Pages.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/script/pages.js"></script>
    <script src="/script/ajax.js"></script>
</body>

</html>
