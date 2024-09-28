<footer class="pt-[50px] w-full bg-gray-100">
    <div class="grid grid-cols-2 gap-[50px] items-center px-[100px] pb-[50px]">
        <div class="grid gap-[20px]">
            <h1 class="font-semibold text-[20px] uppercase">Về chúng tôi</h1>

            <span>Fushan® – Share your color with the world</span>

            <div class="grid gap-[10px]">
                <p>
                    <span class="font-semibold">Hotline: </span>
                    0394774775
                </p>

                <p>
                    <span class="font-semibold">Email: </span>
                    pushanclothes@gmail.com
                </p>

                <p>
                    <span class="font-semibold">Thứ 2 - Chủ nhật: </span>
                    09:30 ~ 21:30
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 items-start">
            <div class="grid gap-[30px]">
                <span class="font-semibold uppercase">danh mục sản phẩm</span>

                <div class="grid gap-[10px]">
                    @foreach ($menus as $menu)
                        @if ($menu->parent_id === null)
                            @if ($menu->children)
                                @foreach ($menu->children as $child)
                                    <form action="{{ route('show-category') }}" method="GET">
                                        <input type="hidden" value="{{ $child->id }}" name="categoryID">
                                        <button type="submit">{{ $child->name }}</button>
                                    </form>
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="grid gap-[30px]">
                <span class="font-semibold uppercase">Hỗ trợ</span>

                <div class="grid gap-[10px]">
                    <a href="">Tài khoản</a>
                    <a href="">Chính sách vận chuyển</a>
                    <a href="">Thanh toán trực tuyến</a>
                    <a href="">Chính sách bảo hành</a>
                    <a href="">Chính sách khiếu nại</a>
                </div>
            </div>
        </div>
    </div>

    <div class="h-[50px] w-full flex items-center justify-between bg-gray-200 px-[100px]">
        <span>Fushan® - Share your color with the world</span>

        <div class="flex items-center gap-[10px]">
            <i class='bx bxl-facebook-circle'></i>
            <i class='bx bxl-instagram'></i>
            <i class='bx bxl-tiktok'></i>
        </div>
    </div>
</footer>
