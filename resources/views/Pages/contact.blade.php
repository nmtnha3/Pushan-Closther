<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('pages.header')

    <main class="grid px-[100px] items-start py-[120px] gap-[30px]">
        <h1 class="font-semibold text-left flex items-center gap-[5px]"><a href="home"
                class="text-gray-500 hover:text-black">Trang chủ /</a> Liên hệ</h1>

        <div class="grid grid-cols-2 items-start">
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15335.9726502007!2d108.2108775549618!3d16.0658446038083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219d6daa0bdf7%3A0xe68c7fcafc48512c!2zQ8O0bmcgVHkgVG5oaCBHaeG6o2kgUGjDoXAgVsOgIEvhu7kgVGh14bqtdCBT4buRIDkgQnJvcw!5e0!3m2!1svi!2s!4v1727451484545!5m2!1svi!2s" width="600" class="h-[950px]" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="grid gap-[20px]">
                <h1 class="font-medium">THÔNG TIN LIÊN HỆ!</h1>

                <div class="grid gap-[20px] items-start">
                    <div class="flex items-center">
                        <p class="w-[350px]">Hotline: <span class="font-medium">0394774775</span></p>

                        <button class="bg-slate-800 text-white p-[10px] rounded-[10px] w-[150px] font-medium">Gọi
                            ngay</button>
                    </div>

                    <div class="flex items-center">
                        <p class="w-[350px]">Email: <span class="font-medium">pushanclothes@gmail.com</span></p>

                        <button class="bg-slate-800 text-white p-[10px] rounded-[10px] w-[150px] font-medium">Gửi
                            ngay</button>
                    </div>

                    <div class="flex items-center">
                        <p class="w-[350px]">Liên hệ: <span class="font-medium">Message tư vấn</span></p>

                        <button class="bg-slate-800 text-white p-[10px] rounded-[10px] w-[150px] font-medium">Liên
                            hệ</button>
                    </div>

                    <div>
                        <p class="text-blue-500">Mở cửa:
                            Thứ 2 - Chủ nhật | 09:30 ~ 21:30</p>
                    </div>

                    <div class="flex items-start gap-[20px]">
                        <img src="/image/ch1.jpeg" alt="">

                        <div class="grid gap-[20px]">
                            <h1 class="font-medium">PUSHAN GOOD - HỒ CHÍ MINH</h1>

                            <p class="text-gray-500">39E Nguyễn Trãi, Quận 1, HCM</p>

                            <p class="text-blue-500">Mở cửa:
                                Thứ 2 - Chủ nhật | 09:30 ~ 21:30</p>

                            <button class="bg-slate-800 text-white p-[10px] rounded-[10px] w-[150px] font-medium">Xem cửa hàng</button>
                        </div>
                    </div>

                    <div class="flex items-start gap-[20px]">
                        <img src="/image/ch1.jpeg" alt="">

                        <div class="grid gap-[20px]">
                            <h1 class="font-medium">PUSHAN GOOD - HÀ NỘI</h1>

                            <p class="text-gray-500">59C - Hai Bà Trưng - Hà Nội</p>

                            <p class="text-blue-500">Mở cửa:
                                Thứ 2 - Chủ nhật | 09:30 ~ 21:30</p>

                            <button class="bg-slate-800 text-white p-[10px] rounded-[10px] w-[150px] font-medium">Xem cửa hàng</button>
                        </div>
                    </div>

                    <div class="flex items-start gap-[20px]">
                        <img src="/image/ch1.jpeg" alt="">

                        <div class="grid gap-[20px]">
                            <h1 class="font-medium">PUSHAN GOOD - ĐÀ NẴNG</h1>

                            <p class="text-gray-500">470 Đ. Trần Đại Nghĩa, Khu đô thị, Ngũ Hành Sơn, Đà Nẵng</p>

                            <p class="text-blue-500">Mở cửa:
                                Thứ 2 - Chủ nhật | 09:30 ~ 21:30</p>

                            <button class="bg-slate-800 text-white p-[10px] rounded-[10px] w-[150px] font-medium">Xem cửa hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('Pages.footer')
</body>

</html>
