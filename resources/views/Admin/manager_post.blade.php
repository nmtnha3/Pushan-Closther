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
                <form action="{{ route('addPost') }}" method="POST"
                    class="w-[400px] grid gap-[20px] border-[2px] border-blue-500 p-[20px] rounded-[10px]"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="flex items-center justify-between">
                        <img id="AvatarPost" src="" alt="" class="h-[100px] rounded-[10px]">

                        <input type="file" id="imagePost" name="imagePost" accept="image/*" class="hidden"
                            onchange="previewAvatarPost(event)">
                        <label for="imagePost"
                            class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center cursor-pointer">Upload
                            image</label>
                    </div>

                    <div class="grid items-center gap-[20px]">
                        <span class="w-[200px] font-medium">Nội dung bài viết</span>

                        <div class="w-[360px] h-[200px]">
                            <textarea name="content" id="content"
                                class="p-[10px] rounded-[5px] border-[2px] w-full h-full resize-none overflow-y-auto scroll-container"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="bg-gray-200 font-medium rounded-[10px] p-[10px] w-[50%] mx-auto">Lưu
                        bài viết</button>
                </form>

                <div class="grid gap-[20px]">
                    <div>
                        <h1 class="text-center text-[22px] font-semibold text-blue-400">Danh sách bài viết</h1>
                    </div>

                    <table class="border-[2px] w-full">
                        <tr class="w-full border-[2px] text-center">
                            <td class="w-max border-[2px] p-[10px]">Hình ảnh</td>
                            <td class="w-max border-[2px] p-[10px]">Nội dung</td>
                            <td class="w-max border-[2px] p-[10px]">Chỉnh sửa</td>
                            <td class="w-max border-[2px] p-[10px]">Xóa</td>
                        </tr>

                        @foreach ($posts as $post)
                            <tr class="border-[2px]">
                                <form action="{{ route('updatePost') }}" method="POST"
                                    class="flex justify-center items-center" enctype="multipart/form-data" data-post-id="{{ $post->id }}">
                                    @csrf
                                    <td class="p-[10px] grid gap-[20px] w-[200px]">
                                        <img id="AvatarPostEdit-{{ $post->id }}" src="{{ $post->image }}" alt=""
                                            class="h-[150px] rounded-[10px] mx-auto" data-post-id="{{ $post->id }}">

                                        <input type="file" id="imagePostEdit-{{ $post->id }}" name="imagePostEdit" accept="image/*"
                                            value="{{ $post->image }}" class="hidden">
                                        <label for="imagePostEdit-{{ $post->id }}"
                                            class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center cursor-pointer">Upload
                                            image</label>
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        <div class="grid items-center gap-[20px]">
                                            <div class="w-[320px] h-[200px]">
                                                <textarea name="contentEdit" id="contentEdit"
                                                    class="p-[10px] rounded-[5px] border-[2px] w-full h-full resize-none overflow-y-auto scroll-container">{{ $post->content }}</textarea>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="border-[2px] p-[10px]">
                                        @csrf
                                        <input type="hidden" value="{{ $post->id }}" name="idPost">
                                        <button
                                            class="w-[40px] h-[40px] bg-blue-200 rounded-full mx-auto font-medium flex items-center justify-center"
                                            type="submit"><i class='bx bx-save text-[20px]'></i></button>
                                    </td>
                                </form>

                                <td class="border-[2px] p-[10px]">
                                    <form action="{{ route('deletePost') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{ $post->id }}" name="idPost">
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
