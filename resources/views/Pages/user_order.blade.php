<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('pages.header')

    <main class="flex px-[100px] items-start py-[120px]">
        @include('Pages.tool_user')
        <div class="bg-gray-100 ml-[370px] p-[20px] rounded-[10px] border-[2px] border-blue-200 w-full grid gap-[20px]">
            <div class="flex items-center justify-between">
                <h1 class="font-medium uppercase">Đơn hàng của tôi</h1>
            </div>

            <table class="border-[2px] w-full">
                <tr class="w-full border-[2px] text-center">
                    <td class="w-[15%] border-[2px] p-[10px]">Ngày đặt</td>
                    <td class="w-[15%] border-[2px] p-[10px]">Trạng thái</td>
                    <td class="w-[35%] border-[2px] p-[10px]">Sản phẩm</td>
                    <td class="w-[10%] border-[2px] p-[10px]">Hình thức</td>
                    <td class="w-[10%] border-[2px] p-[10px]">Tổng tiền</td>
                    <td class="w-[15%] border-[2px] p-[10px]">Hủy đơn</td>
                </tr>

                @foreach ($orders as $order)
                    <tr class="border-[2px]">
                        <form action="" method="POST" class="flex justify-center items-center">
                            @csrf
                            <td class="border-[2px] p-[10px]">
                                <span>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</span>
                            </td>

                            <td class="border-[2px] p-[10px]">
                                @if ($order->order_status === 'Chờ xác nhận')
                                    <span class="text-red-500">{{ $order->order_status }}</span>
                                @else
                                    <span class="text-blue-500">{{ $order->order_status }}</span>
                                @endif
                            </td>

                            <td class="border-[2px] p-[10px]">
                                <div class="h-[120px] overflow-y-scroll scroll-container pr-[10px] grid gap-[10px]">
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

                        <td class="border-[2px] p-[10px] w-max">
                            @if ($order->order_status === 'Chờ xác nhận')
                                <form action="{{ route('cancelOrder') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button type="submit"
                                        class="w-[40px] h-[40px] rounded-full bg-red-300 flex items-center justify-center mx-auto">
                                        <i class='bx bx-x-circle text-[25px]'></i>
                                    </button>
                                </form>
                            @elseif ($order->order_status === 'Yêu cầu hủy')
                            <span class="text-blue-500">Đã yêu cầu hủy</span>
                            @else
                            <a href="" class="text-red-500">CSKH</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
</body>

</html>
