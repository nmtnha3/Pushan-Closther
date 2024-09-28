<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('pages.header');
    <main class="grid mt-[80px] w-full h-max gap-[50px]">
        <div class="swiper mySwiper h-full w-full">
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                    <div class="swiper-slide h-[750px] flex justify-center items-center"><img src="{{ $slide->image }}"
                            class="object-cover cursor-pointer" alt=""></div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <div class="w-full h-max px-[100px] grid gap-[50px]">
            <div class="w-full grid gap-[50px]">
                <h1 class="font-semibold text-left text-[20px] uppercase">Những dòng sản phẩm mới của PUshan®</h1>

                <div class="grid grid-cols-4 gap-[20px] cursor-pointer">
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

                <a href="product"
                    class="text-center border-[1px] border-black hover:bg-black hover:text-white transition-all p-[10px] w-max mx-auto">Xem
                    thêm sản phẩm</a>
            </div>

            <div class="w-full grid gap-[50px]">
                <h1 class="font-semibold text-left text-[20px] uppercase">thời trang hiện đại</h1>

                <div class="grid grid-cols-2 items-center gap-[100px]">
                    @foreach ($posts as $post)
                        <div class="flex items-center shadow-lg w-full bg-blue-50 cursor-pointer">
                            <img src="{{ $post->image }}" alt="" class="h-[300px]">

                            <p class="px-[20px]">
                                {{ $post->content }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <a href="blog"
                class="text-center border-[1px] border-black hover:bg-black hover:text-white transition-all p-[10px] w-max mx-auto">Xem
                thêm bài viết</a>

            <div class="w-full grid gap-[50px]">
                <h1 class="font-semibold text-left text-[20px] uppercase">đa dạng thể loại</h1>

                <div class="grid grid-cols-4 gap-[20px]">
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
        </div>

        @if (Auth::check())
            <form action="{{ route('chat') }}" method="GET">
                <input type="hidden" name="receiver_id" value="{{ $admin->id }}">
                <input type="hidden" name="room_id" value="{{ Auth::user()->room_id }}">
                <button
                    class="bg-sky-400 text-white fixed top-[80%] right-[50px] p-[10px] flex items-center gap-[5px] rounded-[20px] font-medium"><i
                        class='bx bx-tada bx-chat text-[25px]'></i>Help</button>
            </form>
        @endif

        @include('Pages.footer')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/script/swiper.js"></script>
    <script src="/script/pages.js"></script>
</body>

</html>
