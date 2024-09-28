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
                <form action="{{ route('addSlide') }}" method="POST"
                    class="w-[450px] grid gap-[20px] border-[2px] border-blue-500 p-[20px] rounded-[10px]"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="flex items-center justify-between">
                        <img id="AvatarSlide" src="" alt="" class="h-[100px] rounded-[10px]">

                        <input type="file" id="imageSlide" name="imageSlide" accept="image/*" class="hidden">
                        <label for="imageSlide"
                            class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center cursor-pointer">Upload
                            Slide</label>
                    </div>

                    <button type="submit" class="bg-gray-200 font-medium rounded-[10px] p-[10px] w-[50%] mx-auto">Lưu
                        slide</button>
                </form>

                <div class="grid gap-[20px]">
                    <div>
                        <h1 class="text-center text-[22px] font-semibold text-blue-400">Danh sách Slide</h1>
                    </div>

                    <table class="border-[2px] w-full">
                        <tr class="w-full border-[2px] text-center">
                            <td class="w-max border-[2px] p-[10px]">Hình ảnh slide</td>
                            <td class="w-max border-[2px] p-[10px]">Chỉnh sửa</td>
                            <td class="w-max border-[2px] p-[10px]">Xóa</td>
                        </tr>

                        @foreach ($slides as $slide)
                            <tr class="border-[2px]">

                                <form action="{{ route('updateSlide') }}" method="POST"
                                    class="flex justify-center items-center" enctype="multipart/form-data" data-slide-id="{{ $slide->id }}">
                                    @csrf
                                    <td class="p-[10px] flex items-center gap-[10px]">
                                        <img id="AvatarSlideEdit-{{ $slide->id }}" src="{{ $slide->image }}" alt=""
                                            class="h-[150px] rounded-[10px]" data-slide-id="{{ $slide->id }}">

                                        <input type="file" id="imageSlideEdit-{{ $slide->id }}" name="imageSlideEdit" accept="image/*"
                                            class="hidden" value="{{ $slide->image }}" data-slide-id="{{ $slide->id }}">
                                        <label for="imageSlideEdit-{{ $slide->id }}"
                                            class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center cursor-pointer">Upload Slide</label>
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        <input type="hidden" value="{{ $slide->id }}" name="idSlide">
                                        <button
                                            class="w-[40px] h-[40px] bg-blue-200 rounded-full mx-auto font-medium flex items-center justify-center"
                                            type="submit"><i class='bx bx-save text-[20px]'></i></button>
                                    </td>
                                </form>

                                <td class="border-[2px] p-[10px]">
                                    <form action="{{ route('deleteSlide') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="idSlide" value="{{ $slide->id }}">
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
