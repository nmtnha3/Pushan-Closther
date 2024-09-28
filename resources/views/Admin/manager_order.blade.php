<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="overflow-x-hidden">
    @include('admin.header')


    <section class="w-full flex pt-[120px]">
        @include('Admin.tool')

        <main class="ml-[380px] grid justify-center pb-[50px] items-center gap-[20px]">

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

            <div>
                <h1 class="text-center text-[22px] font-semibold text-blue-400">Danh sách đơn hàng</h1>
            </div>

            <table class="border-[2px] w-full">
                <tr class="w-full border-[2px] text-center">
                    <td class="border-[2px] p-[10px]">Tên khách hàng</td>
                    <td class="border-[2px] p-[10px]">Ngày đặt</td>
                    <td class="border-[2px] p-[10px]">Trạng thái</td>
                    <td class="w-[35%] border-[2px] p-[10px]">Sản phẩm</td>
                    <td class="border-[2px] p-[10px]">Hình thức</td>
                    <td class="border-[2px] p-[10px]">Tổng tiền</td>
                    <td class="border-[2px] p-[10px]">Duyệt</td>
                    <td class="border-[2px] p-[10px]">Xóa</td>
                </tr>

                @foreach ($orders as $order)
                    <tr class="border-[2px]">
                        <form action="" method="POST" class="flex justify-center items-center">
                            @csrf
                            <td class="border-[2px] p-[10px]">
                                <span class="font-medium">{{ $order->user->name }}</span>
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <span>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</span>
                            </td>

                            <td class="border-[2px] p-[10px]">
                                @if ($order->order_status === 'Chờ xác nhận' || $order->order_status === 'Yêu cầu hủy')
                                    <span class="text-red-500">{{ $order->order_status }}</span>
                                @else
                                    <span class="text-blue-500">{{ $order->order_status }}</span>
                                @endif
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <div class="h-[110px] overflow-y-scroll scroll-container pr-[10px] grid gap-[10px]">
                                    @foreach ($order->orderDetails as $orderDetail)
                                        <div class="flex items-center gap-[10px]">
                                            <img src="{{ $orderDetail->product->image }}" alt=""
                                                class="h-[100px] rounded-[10px]">
                                            <input type="hidden"
                                                name="products[{{ $orderDetail->product->id }}][product_id]"
                                                value="{{ $orderDetail->product->id }}">

                                            <div class="flex justify-between items-end">
                                                <div class="grid gap-[10px]">
                                                    <div class="grid">
                                                        <span>{{ \Illuminate\Support\Str::limit($orderDetail->product->name, 30) }}</span>
                                                    </div>


                                                    <input type="text"
                                                        name="products[{{ $orderDetail->product->id }}][quantity]"
                                                        value="{{ $orderDetail->quantity }}"
                                                        class="h-[35px] w-[35px] rounded-full font-medium bg-blue-200 flex items-center justify-center text-center outline-none"
                                                        readonly>
                                                </div>

                                                <span class="text-gray-500 font-medium"
                                                    id="productPrice_{{ $orderDetail->product->id }}">
                                                    {{ $orderDetail->product->price * $orderDetail->quantity }}₫
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <td class="border-[2px] p-[10px]">
                                @if ($order->payment_method === 'bank')
                                    <span>Banking</span>
                                @else
                                    <span>COD</span>
                                @endif

                            </td>

                            <td class="border-[2px] p-[10px]">
                                <span class="font-medium">{{ $order->total_order_value }}₫</span>
                            </td>
                        </form>

                        <td class="border-[2px] p-[10px] text-center">
                            @if ($order->order_status === 'Chờ xác nhận')
                                <form action="{{ route('acpOrder') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button type="submit"
                                        class="w-[40px] h-[40px] rounded-full bg-blue-300 flex items-center justify-center mx-auto">
                                        <i class='bx bx-check-double text-[25px]'></i>
                                    </button>
                                </form>
                            @elseif ($order->order_status === 'Yêu cầu hủy')
                                <span class="text-red-500 text-[25px]"><i class='bx bx-x'></i></span>
                            @else
                                <span>Đã duyệt</span>
                            @endif
                        </td>

                        <td class="border-[2px] p-[10px]">
                            <form action="{{ route('deleteOrder') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <button type="submit"
                                    class="w-[40px] h-[40px] rounded-full bg-red-300 flex items-center justify-center mx-auto">
                                    <i class='bx bx-trash text-[25px]'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </main>
    </section>

    <script src="/script/admin.js"></script>
</body>

</html>
