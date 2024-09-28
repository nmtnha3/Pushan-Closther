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

            <div class="grid gap-[20px] mr-[50px]">
                <div>
                    <h1 class="text-center text-[22px] font-semibold text-blue-400">Danh sách các đánh giá</h1>
                </div>

                <table class="border-[2px] w-full">
                    <tr class="w-full border-[2px] text-center">
                        <td class="w-[25%] border-[2px] p-[10px]">Tên sản phẩm</td>
                        <td class="w-[15%] border-[2px] p-[10px]">Người đánh giá</td>
                        <td class="w-[60%] border-[2px] p-[10px]">Nội dung</td>
                    </tr>

                    @foreach ($rates as $rate)
                        <tr class="border-[2px]">
                            <td class="border-[2px] p-[10px]">
                                <span>{{ $rate->product->name }}</span>
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <span>{{ $rate->user->name }}</span>
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <span>{{ $rate->comment }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </main>
    </section>

    <script src="/script/admin.js"></script>
</body>

</html>
