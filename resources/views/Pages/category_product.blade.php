<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('pages.header');

    <main class="grid mt-[80px] items-center mx-[100px] justify-center gap-[50px] py-[50px]">
        <div class="grid justify-start items-center gap-[20px]">
            <h1 class="font-semibold text-left flex items-center gap-[5px]"><a href=""
                    class="text-gray-500 hover:text-black">Sản phẩm /</a> {{ $category->name }}</h1>
        </div>

        <div>
            <div class="w-full">
                <div id="search-results" class="grid grid-cols-4 gap-[20px] cursor-pointer">
                    @foreach ($productCategory as $product)
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
        </div>
    </main>

    @include('Pages.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</body>

</html>
