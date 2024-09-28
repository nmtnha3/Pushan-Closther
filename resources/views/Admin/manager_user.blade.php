<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('admin.header')


    <section class="w-full flex pt-[120px]">
        @include('Admin.tool')

        <main class="ml-[380px] grid justify-center items-center gap-[20px]">
            <div class="grid gap-[20px] items-center pb-[50px]">
                <div>
                    <h1 class="text-center text-[22px] font-semibold text-blue-400">Danh sách tài khoản</h1>
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

                <table class="border-[2px] w-full">
                    <tr class="w-full border-[2px] text-center">
                        <td class="w-max border-[2px] p-[10px]">Tên người dùng</td>
                        <td class="w-max border-[2px] p-[10px]">Email</td>
                        <td class="w-max border-[2px] p-[10px]">Số điện thoại</td>
                        <td class="w-max border-[2px] p-[10px]">Giới tính</td>
                        <td class="w-max border-[2px] p-[10px]">Sinh nhật</td>
                        <td class="w-max border-[2px] p-[10px]">Địa chỉ</td>
                        <td class="w-max border-[2px] p-[10px]">Xóa</td>
                    </tr>

                    @foreach ($users as $user)
                        @if ($user->role !== 'admin')
                            <tr class="border-[2px]">
                                <td class="border-[2px] p-[10px]">
                                    {{ $user->name }}
                                </td>

                                <td class="border-[2px] p-[10px]">
                                    {{ $user->email }}
                                </td>

                                <td class="border-[2px] p-[10px]">
                                    {{ $user->telephone ? $user->telephone : 'Chưa có thông tin' }}
                                </td>

                                <td class="border-[2px] p-[10px]">
                                    {{ $user->gender }}
                                </td>

                                <td class="border-[2px] p-[10px]">
                                    {{ $user->birth }}
                                </td>

                                <td class="border-[2px] p-[10px]">
                                    {{ $user->address ? $user->address : 'Chưa có thông tin' }}
                                </td>

                                <td class="border-[2px] p-[10px]">
                                    <form action="{{ route('deleteUser') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="idUser" value="{{ $user->id }}">
                                        <button type="submit"
                                            class="w-[40px] h-[40px] rounded-full bg-red-300 flex items-center justify-center mx-auto">
                                            <i class='bx bx-trash text-[22px]'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </main>
    </section>

    <script src="/script/admin.js"></script>
</body>

</html>
