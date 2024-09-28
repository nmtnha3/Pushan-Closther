<!DOCTYPE html>
<html lang="en">
    @include('head')
<body>
    @include('pages.header');

    <main class="grid w-full justify-center items-center gap-[20px] py-[10px] mt-[100px] pb-[50px]">
        <div class="grid gap-[10px] py-[20px] bg-blue-50 rounded-[10px] px-[20px] w-full">
            <div class="border-[2px] w-full h-max px-[20px] rounded-[10px] grid gap-[10px] pt-[10px]">
                <span class="font-semibold">Infomation Profile</span>

                <form action="{{ route('changeInfo') }}" class="border-t-[2px] py-[10px] w-[550px]" method="POST">
                    @csrf
                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] pb-[10px]">
                        <span class="font-semibold text-gray-500 w-[20%]">Name User</span>
                        <div
                            class="w-[60%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="username" id=""
                                class="outline-none ip-userName bg-blue-50" readonly value="{{ $user->name }}">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-username"
                            type="button">Edit</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[20%]">Tele Phone</span>
                        <div
                            class="w-[60%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="telephone" id=""
                                class="outline-none bg-blue-50 ip-telePhone" readonly value="{{ $user->telephone }}">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-telePhone"
                            type="button">Edit</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[20%]">Birth date</span>
                        <div
                            class="w-[60%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="date" name="birthdate" id=""
                                class="outline-none bg-blue-50 ip-birthDate" readonly value="{{ $user->birth }}">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-birthDate"
                            type="button">Edit</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[20%]">Gender</span>
                        <div
                            class="w-[60%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="gender" id="selected-gender"
                                class="gender outline-none bg-blue-50 ip-Gender" value="{{ $user->gender }}" readonly>
                            <select name="gender-save" id="gender" class="outline-none bg-blue-50" disabled>
                                <option value="1" disabled selected>Gender</option>
                                <option value="2">Male</option>
                                <option value="3">Female</option>
                                <option value="4">Other</option>
                            </select>
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-Gender"
                            type="button">Edit</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[20%]">Address</span>
                        <div
                            class="w-[60%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="address" id=""
                                class="outline-none bg-blue-50 ip-address" readonly value="{{ $user->address }}">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-address"
                            type="button">Edit</button>
                    </div>

                    @if (session('success'))
                        <p class="text-blue-500 py-[10px]">{{ session('success') }}</p>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger text-red-500 py-[10px]">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex items-center gap-[20px] py-[10px]">
                        <button class="w-[40%] h-[50px] bg-blue-300 rounded-[5px] font-semibold" type="submit">Save
                            Infomation</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="/script/changeInfo.js"></script>
</body>
</html>
