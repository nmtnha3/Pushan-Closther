<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('admin.header')

    <section class="w-full flex pt-[120px] pb-[50px]">
        @include('Admin.tool')

        <main class="ml-[380px] grid justify-center items-center gap-[20px]">
            <h1 class="text-center font-semibold text-[22px]">Chỉnh sửa sản phẩm</h1>
            @if (session('success'))
                <div class="alert alert-success text-blue-500">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('editProduct') }}" method="POST" class="grid gap-[20px]" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idProduct" value="{{ $nextProduct->id }}">
                <div class="flex items-center">
                    <span class="w-[200px]">Tên sản phẩm</span>

                    <select name="nameCategory" class="outline-none border-[2px] p-[10px] rounded-[5px] w-[400px]">
                        <option value="">Chọn danh mục</option>
                        @foreach ($menus as $menu)
                            @if ($menu->parent_id != null)
                                @php
                                    $parentMenu = $menus->where('id', $menu->parent_id)->first();
                                @endphp
                                @if ($parentMenu && $parentMenu->parent_id != null)
                                    <option value="{{ $menu->id }}"
                                        {{ $nextProduct->category == $menu->id ? 'selected' : '' }}>
                                        {{ $menu->name }}
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center">
                    <span class="w-[200px]">Tên sản phẩm</span>

                    <div class="border-[2px] p-[10px] rounded-[5px] w-[400px]">
                        <input type="text" placeholder="Nhập tên sản phẩm" name="nameProduct"
                            class="outline-none w-full" value="{{ $nextProduct->name }}">
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="w-[200px]">Ảnh sản phẩm</span>


                    <div class="flex items-center gap-[50px]">
                        <img id="imageProduct-preview" src="{{ $nextProduct->image }}" alt="" class="h-[150px]">

                        <div>
                            <input type="file" id="imageProduct" name="imageProduct" accept="image/*" class="hidden"
                                onchange="previewImageProduct(event)">
                            <label for="imageProduct"
                                class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center cursor-pointer">Chọn
                                ảnh sản phẩm</label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="w-[200px]">Giá sản phẩm</span>

                    <div class="border-[2px] p-[10px] rounded-[5px] w-[400px]">
                        <input type="text" placeholder="Nhập giá sản phẩm" name="priceProduct"
                            class="outline-none w-full" value="{{ $nextProduct->price }}">
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="w-[200px]">Mô tả sản phẩm</span>

                    <div class="w-[400px] h-[200px] max-h-[300px] overflow-y-auto scroll-container">
                        <textarea name="descriptionProduct" id="descriptionProduct" class="outline-none w-full h-full resize-none">{!! $nextProduct->description !!}</textarea>
                    </div>
                </div>

                <script>
                    ClassicEditor
                        .create(document.querySelector('#descriptionProduct'), {
                            autoParagraph: false,
                            height: '300px',
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>

                <button type="submit"
                    class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center cursor-pointer">Lưu
                    thông tin sản phẩm</button>
            </form>
        </main>
    </section>

    <script src="/script/admin.js"></script>
</body>

</html>
