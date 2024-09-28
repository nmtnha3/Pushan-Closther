<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('admin.header')

    <section class="w-full flex pt-[120px]">
        @include('Admin.tool')

        <main class="ml-[380px] grid justify-center items-center gap-[20px]">
            <div class="flex items-center gap-[10px]">
                <i class='bx bx-credit-card-front text-[24px]'></i>
                <h1 class="uppercase font-semibold text-blue-500">quản lí menu</h1>
            </div>

            <div class="flex justify-center">
                @if (session('success'))
                    <p class="text-blue-500">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="grid gap-[30px] border-[2px] border-blue-500 p-[20px] rounded-[10px]">
                <div>
                    <h1>Xóa thông tin menu</h1>
                </div>

                <form action="{{ route('delete-menu') }}" class="grid gap-[30px]" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-[20px] items-center">
                        <span class="w-[150px] font-semibold">Menu cần sửa</span>
                        <div class="p-[5px] border-[2px] border-blue-300 rounded-[5px] w-[250px]">
                            <select name="menu_id" class="outline-none w-full">
                                <option class="" value="">Chọn menu cần sửa</option>
                                @foreach ($menus as $menu)
                                    @if ($menu->parent_id === null)
                                        <option class="text-red-500" value="{{ $menu->id }}">{{ $menu->name }}
                                        </option>
                                    @else
                                        @php
                                            $parentMenu = $menus->where('id', $menu->parent_id)->first();
                                        @endphp
                                        @if ($parentMenu && $parentMenu->parent_id === null)
                                            <option class="text-blue-500" value="{{ $menu->id }}">-
                                                {{ $menu->name }}</option>
                                        @endif

                                        @if ($parentMenu && $parentMenu->parent_id != null)
                                            <option class="text-orange-500" value="{{ $menu->id }}">*
                                                {{ $menu->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-[150px] p-[10px] bg-blue-300 rounded-[5px] font-semibold">Xóa menu</button>
                </form>
            </div>

            <div class="flex items-center gap-[30px]">
                <div class="grid gap-[30px] border-[2px] border-blue-500 p-[20px] rounded-[10px]">
                    <div>
                        <h1>Tạo menu</h1>
                    </div>

                    <form action="{{ route('create-menu') }}" class="grid gap-[30px]" method="POST">
                        @csrf
                        <div class="flex gap-[20px] items-center">
                            <span class="w-[150px] font-semibold">Tên Menu</span>
                            <div class="p-[5px] border-[2px] border-blue-300 rounded-[5px] w-[250px]">
                                <input type="text" name="nameMenu" value="{{ old('nameMenu') }}"
                                    class="outline-none w-full" placeholder="Nhập vào tên menu">
                            </div>
                        </div>

                        <div class="flex gap-[20px] items-center">
                            <span class="w-[150px] font-semibold">Menu Cha</span>
                            <div class="p-[5px] border-[2px] border-blue-300 rounded-[5px] w-[250px]">
                                <select name="parent_id" class="outline-none w-full">
                                    <option class="" value="">Chọn menu Cha</option>
                                    @foreach ($menus as $menu)
                                        @if ($menu->parent_id === null)
                                            <option class="text-red-500" value="{{ $menu->id }}">{{ $menu->name }}
                                            </option>
                                        @else
                                            @php
                                                $parentMenu = $menus->where('id', $menu->parent_id)->first();
                                            @endphp
                                            @if ($parentMenu && $parentMenu->parent_id === null)
                                                <option class="text-blue-500" value="{{ $menu->id }}">-
                                                    {{ $menu->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-[20px] items-center">
                            <span class="w-[150px] font-semibold">Url của Menu</span>
                            <div class="p-[5px] border-[2px] border-blue-300 rounded-[5px] w-[250px]">
                                <input type="text" name="urlMenu" value="{{ old('urlMenu') }}"
                                    class="outline-none w-full" placeholder="Nhập vào url menu">
                            </div>
                        </div>

                        <button type="submit" class="w-[150px] p-[10px] bg-blue-300 rounded-[5px] font-semibold">Lưu Thông
                            Tin</button>
                    </form>
                </div>

                <div class="grid gap-[30px] border-[2px] border-blue-500 p-[20px] rounded-[10px]">
                    <div>
                        <h1>Sửa thông tin menu</h1>
                    </div>

                    <form action="{{ route('edit-menu') }}" class="grid gap-[30px]" method="POST">
                        @csrf
                        <div class="flex gap-[20px] items-center">
                            <span class="w-[150px] font-semibold">Menu cần sửa</span>
                            <div class="p-[5px] border-[2px] border-blue-300 rounded-[5px] w-[250px]">
                                <select name="menu_id" class="outline-none w-full">
                                    <option class="" value="">Chọn menu cần sửa</option>
                                    @foreach ($menus as $menu)
                                        @if ($menu->parent_id === null)
                                            <option class="text-red-500" value="{{ $menu->id }}">{{ $menu->name }}
                                            </option>
                                        @else
                                            @php
                                                $parentMenu = $menus->where('id', $menu->parent_id)->first();
                                            @endphp
                                            @if ($parentMenu && $parentMenu->parent_id === null)
                                                <option class="text-blue-500" value="{{ $menu->id }}">-
                                                    {{ $menu->name }}</option>
                                            @endif

                                            @if ($parentMenu && $parentMenu->parent_id != null)
                                                <option class="text-orange-500" value="{{ $menu->id }}">*
                                                    {{ $menu->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-[20px] items-center">
                            <span class="w-[150px] font-semibold">Tên Menu mới</span>
                            <div class="p-[5px] border-[2px] border-blue-300 rounded-[5px] w-[250px]">
                                <input type="text" name="nameMenu" value="{{ old('nameMenu') }}"
                                    class="outline-none w-full" placeholder="Nhập vào tên menu">
                            </div>
                        </div>

                        <div class="flex gap-[20px] items-center">
                            <span class="w-[150px] font-semibold">Url Menu mới</span>
                            <div class="p-[5px] border-[2px] border-blue-300 rounded-[5px] w-[250px]">
                                <input type="text" name="urlMenu" value="{{ old('urlMenu') }}"
                                    class="outline-none w-full" placeholder="Nhập vào url menu">
                            </div>
                        </div>

                        <button type="submit" class="w-[150px] p-[10px] bg-blue-300 rounded-[5px] font-semibold">Lưu Thông
                            Tin</button>
                    </form>
                </div>
            </div>
        </main>
    </section>
</body>

</html>
