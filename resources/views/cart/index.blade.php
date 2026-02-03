

<h1>🛒 ตะกร้าสินค้า</h1>

@if(empty($cart))
    <p>ไม่มีสินค้าในตะกร้า</p>
@else
    <table border="1">
        <tr>
            <th>สินค้า</th>
            <th>ขนาด</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รวม</th>
            <th>จัดการ</th>
        </tr>

        @php $total = 0; @endphp
        @foreach($cart as $id => $item)
            @php 
                $subtotal = $item['quantity'] * $item['price'];
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['size'] }}</td>
                <td>฿{{ number_format($item['price'], 2) }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>฿{{ number_format($subtotal, 2) }}</td>
                <td>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="PID" value="{{ $id }}">
                        <button type="submit">ลบ</button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" align="right"><strong>รวมทั้งหมด:</strong></td>
            <td><strong>฿{{ number_format($total, 2) }}</strong></td>
            <td></td>
        </tr>
    </table>
    <a href="{{ route('checkout.show') }}">🛒 ดำเนินการต่อ</a>
@endif
