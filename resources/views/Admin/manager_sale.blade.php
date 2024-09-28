<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('admin.header')


    <section class="w-full flex pt-[120px]">
        @include('Admin.tool')

        <main class="ml-[380px] grid justify-center items-start gap-[20px]">

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

            <div class="flex gap-[20px] items-start pb-[50px]">
                <form action="{{ route('addSale') }}" method="POST"
                    class="w-[450px] grid gap-[20px] border-[2px] border-blue-500 p-[20px] rounded-[10px]">
                    @csrf

                    <div class="flex items-center justify-between">
                        <span>Tên mã giảm giá</span>

                        <div class="border-[2px] rounded-[10px] p-[10px] w-[250px]">
                            <input type="text" placeholder="Nhập vào tên mã giảm giá" name="code_sale"
                                class="outline-none w-full">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <span>Giá trị giảm giá</span>

                        <div class="border-[2px] rounded-[10px] p-[10px] w-[250px]">
                            <input type="text" placeholder="Nhập vào giá trị giảm giá" name="percentage_sale"
                                class="outline-none w-full">
                        </div>
                    </div>

                    <button type="submit" class="bg-gray-200 font-medium rounded-[10px] p-[10px] w-[50%] mx-auto">Lưu
                        mã giảm giá</button>
                </form>

                <div class="grid gap-[20px]">
                    <div>
                        <h1 class="text-center text-[22px] font-semibold text-blue-400">Danh sách mã giảm giá</h1>
                    </div>

                    <table class="border-[2px] w-full">
                        <tr class="w-full border-[2px] text-center">
                            <td class="w-max border-[2px] p-[10px]">Tên mã giảm giá</td>
                            <td class="w-max border-[2px] p-[10px]">Giá trị giảm giá</td>
                            <td class="w-max border-[2px] p-[10px]">Chỉnh sửa</td>
                            <td class="w-max border-[2px] p-[10px]">Xóa</td>
                        </tr>

                        @foreach ($discounts as $discount)
                            <tr class="border-[2px]">
                                <form action="{{ route('updateSale') }}" method="POST"
                                    class="flex justify-center items-center">
                                    <td class="border-[2px] p-[10px]">
                                        <input type="text" value="{{ $discount->code }}" name="code_sale"
                                            class="p-[10px] outline-blue-500 rounded-[10px]">
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        <input type="text" value="{{ $discount->percentage }}" name="percentage_sale"
                                            class="p-[10px] outline-blue-500 rounded-[10px]">
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        @csrf
                                        <input type="hidden" value="{{ $discount->id }}" name="idDiscount">
                                        <button
                                            class="w-[40px] h-[40px] bg-blue-200 rounded-full mx-auto font-medium flex items-center justify-center"
                                            type="submit"><i class='bx bx-save text-[20px]'></i></button>
                                    </td>
                                </form>

                                <td class="border-[2px] p-[10px]">
                                    <form action="{{ route('deleteSale') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="idDiscount" value="{{ $discount->id }}">
                                        <button type="submit"
                                            class="w-[40px] h-[40px] rounded-full bg-red-300 flex items-center justify-center mx-auto">
                                            <i class='bx bx-trash text-[22px]'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </main>
    </section>

    <script src="/script/admin.js"></script>
</body>

</html>
