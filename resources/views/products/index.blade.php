<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/buy.css') }}">
    <title>รายการสินค้า</title>
    <style>
        .container {
            display: flex;
        }
        .products {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: 20px;
        }
        .product-category {
            width: 100%;
        }
        .product-category h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            width: 250px;
            background: white;
            border-radius: 10px;
        }
        .img1 {
            width: 200px;
            height: 200px;
            border-radius: 10px;
        }
        .icon {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .btn {
            padding: 8px 15px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .add {
            background-color: green;
            color: white;
        }
        .minus {
            background-color: red;
            color: white;
        }
        .checkout {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            background: blue;
            color: white;
            font-size: 18px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Woodlet store</a>
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

      <div class="container-fluid">
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark sidebar vh-100 p-3" style="width: 250px;">
            <h4 class="text-white">เมนู</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('account.index') }}">สรุปรายรับรายจ่าย</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('deliveries.show') }}">แสดงสถานะการขนส่ง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('bills.show') }}">แสดงรายการบิล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('customers.show') }}">แสดงรายชื่อลูกค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('orders.show') }}">แสดงรายออเดอร์</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger mt-4">ออกจากระบบ</button>
                    </form>
                </li>
            </ul>
        </nav> 
   
    
    <h1>เมนูสินค้า</h1>
    <div class="container">
        <div class="products">

            <!-- 🪵 หมวดหมู่: ไม้ดิบ -->
            <div class="product-category">
                <h2>🪵 ไม้ดิบ</h2>
                <div class="product-list">
                    @foreach($rawWood as $wood)
                        <div class="product">
                            <img class="img1" src="https://png.pngtree.com/thumb_back/fh260/background/20220916/pngtree-logging-pile-lumber-wooden-photo-image_14537256.jpg" alt="wood">
                            <h2>{{ $wood->P_Name }}</h2>
                            <p>ขนาด: {{ $wood->P_Width }} x {{ $wood->P_Height }} x {{ $wood->P_Thickness }} cm</p>
                            <p>ราคา: ฿{{ number_format($wood->Price, 2) }}</p>
                            <p>จำนวนคงเหลือ: <span id="stock-{{ $wood->PID }}">{{ $wood->P_Quantity }}</span> ชิ้น</p>
                            <div class="icon">
                                <button class="minus btn" onclick="updateCart({{ $wood->PID }}, '{{ $wood->P_Name }}', '{{ $wood->P_Width }}x{{ $wood->P_Height }}x{{ $wood->P_Thickness }}', {{ $wood->Price }}, 'decrease')">-</button>
                                <span id="qty-{{ $wood->PID }}">0</span>
                                <button class="add btn" onclick="updateCart({{ $wood->PID }}, '{{ $wood->P_Name }}', '{{ $wood->P_Width }}x{{ $wood->P_Height }}x{{ $wood->P_Thickness }}', {{ $wood->Price }}, 'increase')">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 🛒 หมวดหมู่: สินค้าในร้าน -->
            <div class="product-category">
                <h2>🛒 สินค้าในร้าน</h2>
                <div class="product-list">
                    @foreach($storeProducts as $product)
                        <div class="product">
                            <img class="img1" src="https://th.bing.com/th/id/OIP.lRL0ma5VkAx7JSc7fl3bCgHaNd?w=528&h=960&rs=1&pid=ImgDetMain" alt="wood">
                            <h2>{{ $product->P_Name }}</h2>
                            <p>ขนาด: {{ $product->P_Width }} x {{ $product->P_Height }} x {{ $product->P_Thickness }} cm</p>
                            <p>ราคา: ฿{{ number_format($product->Price, 2) }}</p>
                            <p>จำนวนคงเหลือ: <span id="stock-{{ $product->PID }}">{{ $product->P_Quantity }}</span> ชิ้น</p>
                            <div class="icon">
                                <button class="minus btn" onclick="updateCart({{ $product->PID }}, '{{ $product->P_Name }}', '{{ $product->P_Width }}x{{ $product->P_Height }}x{{ $product->P_Thickness }}', {{ $product->Price }}, 'decrease')">-</button>
                                <span id="qty-{{ $product->PID }}">0</span>
                                <button class="add btn" onclick="updateCart({{ $product->PID }}, '{{ $product->P_Name }}', '{{ $product->P_Width }}x{{ $product->P_Height }}x{{ $product->P_Thickness }}', {{ $product->Price }}, 'increase')">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 📦 หมวดหมู่: สินค้าที่ลูกค้าสั่งทำ -->
            <div class="product-category">
                <h2>📦 สินค้าที่ลูกค้าสั่งทำ (รอลูกค้ามารับ)</h2>
                <div class="product-list">
                    @foreach($customOrders as $order)
                        <div class="product">
                            <img class="img1" src="https://th.bing.com/th?id=OIF.c3FtNhSt%2fZvTzdBW%2brWElg&rs=1&pid=ImgDetMain" alt="wood">
                            <h2>{{ $order->P_Name }}</h2>
                            <p>ขนาด: {{ $order->P_Width }} x {{ $order->P_Height }} x {{ $order->P_Thickness }} cm</p>
                            <p>ราคา: ฿{{ number_format($order->Price, 2) }}</p>
                            <p>จำนวนที่สั่ง: <span id="stock-{{ $order->PID }}">{{ $order->P_Quantity }}</span> ชิ้น</p>
                            <div class="icon">
                                <button class="minus btn" onclick="updateCart({{ $order->PID }}, '{{ $order->P_Name }}', '{{ $order->P_Width }}x{{ $order->P_Height }}x{{ $order->P_Thickness }}', {{ $order->Price }}, 'decrease')">-</button>
                                <span id="qty-{{ $order->PID }}">0</span>
                                <button class="add btn" onclick="updateCart({{ $order->PID }}, '{{ $order->P_Name }}', '{{ $order->P_Width }}x{{ $order->P_Height }}x{{ $order->P_Thickness }}', {{ $order->Price }}, 'increase')">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="cart">
            <h2>🛒 ตะกร้าสินค้า</h2>
            <ul id="cart-list">
                <li>ไม่มีสินค้าในตะกร้า</li>
            </ul>
            <form id="checkout-form" action="{{ route('order.summary') }}" method="GET">
                <input type="hidden" name="cart_data" id="cart-data">
                <button type="submit" class="checkout">ถัดไป</button>
            </form>
        </form>
        <!-- 🔹 ปุ่มล้างตะกร้า -->
        <button class="clear-cart btn" onclick="clearCart()">🗑️ ล้างตะกร้า</button>
        </div>
        
        <script>
            let cart = JSON.parse(localStorage.getItem("cart")) || {};

            function updateCart(id, name, size, price, action) {
let stockElement = document.getElementById(`stock-${id}`);
let qtyElement = document.getElementById(`qty-${id}`);

if (!stockElement || !qtyElement) return;

let stock = parseInt(stockElement.innerText);
let qty = parseInt(qtyElement.innerText);

if (action === "increase" && stock > 0) {
qty++;
stock--;
} else if (action === "decrease" && qty > 0) {
qty--;
stock++;
}

stockElement.innerText = stock;
qtyElement.innerText = qty;

if (qty > 0) {
cart[id] = { id: id, name: name, size: size, quantity: qty, price: parseFloat(price) };
} else {
delete cart[id];
}

localStorage.setItem("cart", JSON.stringify(cart));
renderCart();
}

            function renderCart() {
                let cartList = document.getElementById("cart-list");
                if (!cartList) return;

                cartList.innerHTML = Object.keys(cart).length > 0 
                    ? Object.values(cart)
                        .map(item => `<li>${item.name} (${item.size}) - ${item.quantity} ชิ้น - ฿${(item.price * item.quantity).toFixed(2)}</li>`)
                        .join("")
                    : "<li>ไม่มีสินค้าในตะกร้า</li>";

                let cartDataInput = document.getElementById("cart-data");
                if (cartDataInput) {
                    cartDataInput.value = JSON.stringify(cart);
                }
            }

            window.onload = function() {
                renderCart();
            };
            function clearCart() {
if (confirm("คุณแน่ใจหรือไม่ว่าต้องการล้างสินค้าทั้งหมดในตะกร้า?")) {
    localStorage.removeItem("cart"); // ลบข้อมูลตะกร้า
    cart = {}; // รีเซ็ตตัวแปร cart
    renderCart(); // อัปเดต UI
}
}

        </script>
</body>
</html>
