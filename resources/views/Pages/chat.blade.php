<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('pages.header')

    <main class="grid px-[100px] items-start py-[120px] gap-[30px]">
        @if ($user->role === 'admin')
            <h1 class="font-semibold text-left flex items-center gap-[5px]"><a href="home"
                    class="text-gray-500 hover:text-black">Trang chủ /</a> Chat</h1>
        @else
            <h1 class="font-semibold text-left flex items-center gap-[5px]"><a href="manager_contact"
                    class="text-gray-500 hover:text-black">Trang chủ /</a> Chat</h1>
        @endif

        <div class="border-[2px] rounded-[10px] p-[20px] w-[50%] mx-auto">
            <div class="flex items-center gap-[20px] border-b-[2px] pb-[10px]">
                <i class="bx bxl-blender text-[30px] text-orange-400 bg-blue-50 border-[2px] rounded-full p-[10px]"></i>

                <h1 class="font-medium">{{ $user->name }}</h1>
            </div>

            <div id="message_all" class="overflow-y-auto scroll-container h-[350px] border-b-[2px] py-[10px]">
                @foreach ($messages as $message)
                    @if ($message->room_id == $room_id)
                        <div class="flex items-end gap-[10px] py-[5px]">
                            <img src="/image/user.png" class="rounded-full w-[40px] h-[40px]" alt="">

                            <div class="bg-blue-400 text-white p-[10px] rounded-[10px]">
                                <p class="font-medium">{{ $message->sender->name }}</p>

                                <p>{{ $message->content }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="pt-[20px]">
                <form action="{{ route('sendMessage') }}" method="POST" class="flex items-center gap-[20px]">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
                    <input type="hidden" name="room_id" value="{{ $room_id }}">
                    <div class="border-[2px] rounded-[10px] p-[10px] w-[95%]">
                        <textarea name="content" id="content" class="w-full outline-none resize-none overflow-y-auto scroll-container"></textarea>
                    </div>

                    <button class="w-[5%]"><i class='bx bx-send text-[30px] text-blue-500'></i></button>
                </form>
            </div>
        </div>
    </main>

    @include('Pages.footer')

    <script src="/script/chat.js"></script>
</body>

</html>
