<div class="w-[350px] bg-gray-100 fixed p-[20px] rounded-[10px] border-[2px] border-blue-200 grid gap-[20px]">
    <div class="flex items-center gap-[20px] border-b-[2px] pb-[20px]">
        <img src="/image/user.png" alt="" class="h-[60px] w-[60px] rounded-full">

        <div class="grid">
            <h1 class="font-semibold">{{ $user->name }}</h1>

            <p>{{ $user->email }}</p>
        </div>
    </div>

    <div class="grid">
        <div class="hover:bg-blue-100 p-[10px]">
            <a href="user">Thông tin cá nhân</a>
        </div>

        <div class="hover:bg-blue-100 p-[10px]">
            <a href="user.order">Đơn hàng của tôi</a>
        </div>

        @if($user->role === 'admin')
        <div class="hover:bg-blue-100 p-[10px]">
            <a href="admin">Trang quản lí admin</a>
        </div>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="hover:bg-blue-100 p-[10px]">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
    </div>
</div>
