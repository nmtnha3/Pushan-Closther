<!DOCTYPE html>
<html lang="en">
    @include('head')
<body>
    @include('pages.header')

    <main class="flex px-[100px] items-start py-[120px]">
        @include('Pages.tool_user')

        <div class="bg-gray-100 p-[20px] ml-[370px] rounded-[10px] border-[2px] border-blue-200 w-full grid gap-[20px]">
            <div class="flex items-center justify-between">
                <h1 class="font-medium uppercase">Thông tin cá nhân</h1>

                <a href="change_user" class="text-blue-500">Chỉnh sửa thông tin</a>
            </div>

            <div class="grid gap-[10px]">
                <span class="font-medium">Họ và tên</span>

                <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->name }}</p>
            </div>

            <div class="grid gap-[10px]">
                <span class="font-medium">Email</span>

                <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->email }}</p>
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

                <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->telephone ? $user->telephone : 'Chưa có thông tin' }}</p>
            </div>

            <div class="grid gap-[10px]">
                <span class="font-medium">Địa chỉ</span>

                <p class="border-b-[2px] border-gray-200 pb-[5px]">{{ $user->address ? $user->address : 'Chưa có thông tin' }}</p>
            </div>
        </div>
    </main>
</body>
</html>
