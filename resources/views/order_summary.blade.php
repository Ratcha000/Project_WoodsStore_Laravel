<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปรายการสั่งซื้อ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #343a40;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        select, button, input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background: #28a745;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background: #218838;
        }

        .summary {
            margin-top: 20px;
            padding: 15px;
            background: #e9ecef;
            border-radius: 5px;
        }

        .total {
            font-size: 20px;
            color: #d63384;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('home') }}">Woodlet store</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('stock.create') }}">เพิ่มข้อมูลลงสต็อก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('stock.view') }}">แสดงสต็อก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('custom_orders.create') }}">เพิ่มรายการสั่งทำ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('custom_orders.index') }}">แสดงรายการสั่งทำ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">สั่งซื้อสินค้า</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('products.showAddFromStock') }}">เพิ่มรายการไม้ดิบสั่งซื้อสินค้า</a>
              </li>
              
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  เพิ่มข้อมูล
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('woods.create') }}">เพิ่มข้อมูลไม้</a></li>
                  <li><a class="dropdown-item" href="{{ route('customers.create') }}">เพิ่มข้อมูลลูกค้า</a></li>
                  <li><a class="dropdown-item" href="{{ route('salaries.create') }}">เพิ่มข้อมูลเงินเดือน</a></li>
                  <li><a class="dropdown-item" href="{{ route('carpenters.create') }}">เพิ่มข้อมูลช่างไม้</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <h1>📝 สรุปรายการสั่งซื้อ</h1>

    <div class="container">
        @if(session('error'))
            <div style="color: red; text-align: center;">❌ {{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ชื่อสินค้า</th>
                    <th>ขนาด</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>ราคารวม</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPrice = 0; @endphp
                @foreach($cartData as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['size'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>฿{{ number_format($item['price'], 2) }}</td>
                    <td>฿{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
                @php $totalPrice += ($item['price'] * $item['quantity']); @endphp
                @endforeach
            </tbody>
        </table>

        <h3>💰 ราคาสินค้ารวม: <span id="productTotal">฿{{ number_format($totalPrice, 2) }}</span></h3>

        <form id="order-form" action="{{ route('order.confirm') }}" method="POST">
            @csrf
            <input type="hidden" name="cart_data" id="cart-data" value="{{ json_encode($cartData) }}">

            <label for="customer">👤 ลูกค้า:</label>
            <select name="customer_id" id="customer_id" required>
                <option value="">-- กรุณาเลือกลูกค้า --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->Customer_id }}">{{ $customer->Customer_name }}</option>
                @endforeach
            </select>

            <label for="delivery">🚚 เลือกรูปแบบขนส่ง:</label>
            <select name="delivery_type" id="delivery_type" required>
                <option value="">-- กรุณาเลือกประเภทขนส่ง --</option>
                <option value="ขนส่งทางร้าน">ขนส่งทางร้าน</option>
                <option value="ไม่รับบริการขนส่ง">ไม่รับบริการขนส่ง</option>
                <option value="กำหนดค่าขนส่งเอง">กำหนดค่าขนส่งเอง</option>
            </select>

            <label for="delivery_cost">💰 ค่าขนส่ง (฿):</label>
            <input type="number" id="delivery_cost" name="delivery_cost" min="0" step="0.1" value="0" oninput="updateTotal()">

            <label for="distance">📍 ระยะทางไปส่ง (km):</label>
            <input type="number" id="distance_km" name="distance_km" min="0" step="0.1" oninput="updateTotal()" placeholder="ระยะทาง (km)">

            <table>
                <tr>
                    <td>VAT (7%)</td>
                    <td><span id="vatTotal">฿{{ number_format($totalPrice * 0.07, 2) }}</span></td>
                </tr>
                <tr>
                    <td>ค่าขนส่ง</td>
                    <td><span id="deliveryTotal">฿0.00</span></td>
                </tr>
                <tr>
                    <td><strong>ยอดรวมทั้งหมด</strong></td>
                    <td><strong id="grandTotal">฿{{ number_format($totalPrice + ($totalPrice * 0.07), 2) }}</strong></td>
                </tr>
            </table>

            <button type="submit" onclick="return confirmOrder(event)">✅ ยืนยันคำสั่งซื้อ</button>
        </form>
    </div>

    <script>
        function updateTotal() {
            let productTotal = parseFloat(document.getElementById("productTotal").innerText.replace('฿', '').replace(',', '')) || 0;
            let vat = productTotal * 0.07;
            let deliveryCost = parseFloat(document.getElementById("delivery_cost").value) || 0;
            let distanceKm = parseFloat(document.getElementById("distance_km").value) || 0;
            let extraDistanceCost = (distanceKm > 10) ? (distanceKm - 10) * 10 : 0;
            let grandTotal = productTotal + vat + deliveryCost + extraDistanceCost;

            document.getElementById("vatTotal").innerText = `฿${vat.toFixed(2)}`;
            document.getElementById("deliveryTotal").innerText = `฿${(deliveryCost + extraDistanceCost).toFixed(2)}`;
            document.getElementById("grandTotal").innerText = `฿${grandTotal.toFixed(2)}`;
        }

        function confirmOrder(event) {
            event.preventDefault();
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการยืนยันคำสั่งซื้อ?")) {
                document.getElementById("order-form").submit();
            }
        }
    </script>

</body>
</html>
