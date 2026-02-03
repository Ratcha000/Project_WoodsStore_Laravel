<h1>🛒 ตรวจสอบคำสั่งซื้อ</h1>

@if(empty($cart))
    <p>ไม่มีสินค้าในตะกร้า</p>
@else
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <table border="1">
            <tr>
                <th>สินค้า</th>
                <th>ขนาด</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>รวม</th>
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
                </tr>
            @endforeach
        </table>

        <label for="Customer_id">เลือกลูกค้า:</label>
        <select name="Customer_id" required>
            @foreach($customers as $customer)
                <option value="{{ $customer->Customer_id }}">{{ $customer->Customer_name }}</option>
            @endforeach
        </select>

        <label for="Delivery_id">เลือกการจัดส่ง:</label>
        <select name="Delivery_id" required>
            @foreach($deliveries as $delivery)
                <option value="{{ $delivery->Delivery_id }}">{{ $delivery->method }} - ฿{{ number_format($delivery->fee, 2) }}</option>
            @endforeach
        </select>

        <p>รวม: ฿<span id="total">{{ number_format($total, 2) }}</span></p>
        <p>VAT (7%): ฿<span id="vat">{{ number_format($total * 0.07, 2) }}</span></p>
        <p>ค่าขนส่ง: ฿<span id="delivery">0</span></p>
        <p><strong>ยอดรวมสุทธิ: ฿<span id="grand_total">{{ number_format($total * 1.07, 2) }}</span></strong></p>

        <button type="submit">💳 ชำระเงิน</button>
    </form>
@endif
