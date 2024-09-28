<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('pages.header')

    <main class="grid px-[100px] items-start py-[120px] gap-[30px]">
        <h1 class="font-semibold text-left flex items-center gap-[5px]"><a href="home"
                class="text-gray-500 hover:text-black">Trang chủ /</a> Bài viết</h1>

        <div class="grid justify-center text-center gap-[10px]">
            <h1 class="font-medium text-[18px]">PUSHAN CLOTHES - SHARE YOUR COLOR WITH THE WORLD</h1>

            <p class="text-center w-[50%] mx-auto">PUSHAN CLOTHES là lựa chọn hàng đầu dành cho các tín đồ thời trang Đường phố sành điệu. Sứ mệnh của PUSHAN CLOTHES® là
                trao quyền cho thế hệ trẻ toàn thế giới tự do thể hiện phong cách thông qua thời trang, thương hiệu vượt
                qua ranh giới của thời trang đường phố bằng cách không ngừng sáng tạo các trang phục với các bộ sưu tập
                độc đáo.</p>
        </div>

        <div class="grid grid-cols-3 gap-[20px]">
            <img src="/image/blog1.png" alt="" class="rounded-[10px]">
            <img src="/image/blog2.png" alt="" class="rounded-[10px]">
            <img src="/image/blog3.png" alt="" class="rounded-[10px]">
        </div>

        <div class="grid gap-[30px]">
            <h1 class="font-medium text-center">BÀI VIẾT</h1>

            <div class="grid grid-cols-2 gap-[20px]">
                @foreach ($blogs as $blog)
                        <div class="flex items-center shadow-lg w-full bg-blue-50 cursor-pointer">
                            <img src="{{ $blog->image }}" alt="" class="h-[300px]">

                            <p class="px-[20px]">
                                {{ $blog->content }}
                            </p>
                        </div>
                    @endforeach
            </div>
        </div>
    </main>

    @include('Pages.footer')
</body>

</html>
