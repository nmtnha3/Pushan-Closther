<header
    class="w-full h-max flex items-center justify-between px-[100px] cursor-pointer bg-gray-100 fixed top-0 left-0 z-[9999]">
    <div class="flex items-center gap-[10px] cursor-pointer pr-[100px]">
        <i class='bx bxl-blender text-[50px] text-orange-400'></i>
        <h1 class="font-semibold text-[22px]">Pushan Clothes</h1>
    </div>

    <ul class="flex items-center justify-center gap-[50px] font-semibold">
        @foreach ($menus as $menu)
            @if ($menu->parent_id === null)
                <li class="relative group py-[40px]">
                    <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                    @if ($menu->children && count($menu->children) > 0)
                        <ul
                            class="gap-[20px] w-max absolute top-[100%] bg-white p-[30px] hidden group-hover:grid grid-cols-4 shadow-lg">
                            @foreach ($menu->children as $child)
                                <li class="">
                                    <form action="{{ route('show-category') }}" method="GET">
                                        <input type="hidden" value="{{ $child->id }}"
                                            name="categoryID">
                                        <button type="submit">{{ $child->name }}</button>
                                    </form>
                                    @if ($child->children && count($child->children) > 0)
                                        <ul
                                            class="grid gap-[10x] text-gray-500 font-normal top-full w-max text-[16px] mt-[10px]">
                                            @foreach ($child->children as $grandchild)
                                                <li>
                                                    <form action="{{ route('show-category_product') }}" method="GET">
                                                        <input type="hidden" value="{{ $grandchild->id }}"
                                                            name="categoryID">
                                                        <button type="submit">{{ $grandchild->name }}</button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>

    <div class="flex items-center gap-[10px] cursor-pointer pl-[100px]">
        @auth
            <a href="{{ route('show-user') }}"
                class="bg-blue-100 w-[40px] h-[40px] rounded-full flex items-center justify-center">
                <i class='bx bx-user text-[25px]'></i>
            </a>
        @else
            <a href="{{ route('show-login') }}"
                class="bg-blue-100 w-[40px] h-[40px] rounded-full flex items-center justify-center">
                <i class='bx bx-user text-[25px]'></i>
            </a>
        @endauth

        <a href="cart_product" class="bg-blue-100 w-[40px] h-[40px] rounded-full flex items-center justify-center"><i
                class='bx bx-cart text-[25px]'></i></a>
    </div>
</header>
