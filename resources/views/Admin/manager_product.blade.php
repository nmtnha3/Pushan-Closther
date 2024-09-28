<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('admin.header')

    <section class="w-full flex pt-[120px]">
        @include('Admin.tool')

        <main class="ml-[380px] grid justify-center items-center gap-[20px] mr-[50px]">
            <div class="grid gap-[10px] w-[20%] bg-blue-100 p-[20px] rounded-[10px] font-medium">
                <a href="add_product">Thêm sản phẩm</a>
            </div>

            <div class="grid gap-[20px] items-center pb-[50px]">
                <div>
                    <h1 class="text-center text-[22px] font-semibold text-blue-400">Danh sách sản phẩm</h1>
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
                        <td class="w-[15%] border-[2px] p-[10px]">Mục sản phẩm</td>
                        <td class="w-[35%] border-[2px] p-[10px]">Tên sản phẩm</td>
                        <td class="w-[15%] border-[2px] p-[10px]">Ảnh sản phẩm</td>
                        <td class="w-[15%] border-[2px] p-[10px]">Giá sản phẩm</td>
                        <td class="w-[10%] border-[2px] p-[10px]">Chỉnh sửa</td>
                        <td class="w-[10%] border-[2px] p-[10px]">Xóa</td>
                    </tr>

                    @foreach ($products as $product)
                        <tr class="border-[2px]">
                            <td class="border-[2px] p-[10px]">
                                @if ($product->category == '')
                                    <p>Không tồn tại danh mục</p>
                                @else
                                    {{ $categories[$product->category] }}
                                @endif
                            </td>

                            <td class="border-[2px] p-[10px]">
                                {{ $product->name }}
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <img src="{{ $product->image }}" alt="">
                            </td>

                            <td class="border-[2px] p-[10px]">
                                {{ $product->price }}
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <form action="{{ route('nextEditProduct') }}" method="GET">
                                    <input type="hidden" name="idProduct" value="{{ $product->id }}">
                                    @csrf
                                    <button type="submit" class="w-[40px] h-[40px] rounded-full bg-blue-300 flex items-center justify-center mx-auto">
                                        <i class='bx bx-edit text-[22px]' ></i></button>
                                </form>
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <form action="{{ route('deleteProduct') }}" method="POST">
                                    <input type="hidden" name="idProduct" value="{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-[40px] h-[40px] rounded-full bg-red-300 flex items-center justify-center mx-auto"><i class='bx bx-trash text-[22px]' ></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </main>
    </section>
</body>

</html>
