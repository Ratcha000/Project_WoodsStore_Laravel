<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar vh-100 p-3">
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
    

    <div class="container mt-4">
        <h2>แสดงรายการสั่งทำ</h2>
        <a href="{{ route('custom_orders.create') }}" class="btn btn-primary mb-3">+ Create New Order</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Product Name</th>
                    <th>Stock Used</th>
                    <th>Stock Deducted</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Thickness</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customOrders as $order)
                <tr>
                    <td>{{ $order->Cusor_ID }}</td>
                    <td>{{ $order->customer ? $order->customer->Customer_name : 'No Customer' }}</td>
                    <td>{{ $order->Product_Name }}</td>
                    <td>{{ $order->stock->S_Name }}</td>
                    <td>{{ $order->Used_Stock_Quantity }}</td>
                    <td>{{ $order->Cus_Width }}</td>
                    <td>{{ $order->Cus_Height }}</td>
                    <td>{{ $order->Cus_Thickness }}</td>
                    <td>{{ $order->Cus_Quantity }}</td>
                    <td>{{ number_format($order->Cus_Price, 2) }}</td>
                    <td>
                        <span class="badge 
                            @if($order->Cus_Status == 'Pending') bg-warning
                            @elseif($order->Cus_Status == 'In Progress') bg-info
                            @elseif($order->Cus_Status == 'Completed') bg-success
                            @else bg-danger
                            @endif">
                            {{ $order->Cus_Status }}
                        </span>
                    </td>
                    <td>
                        @if($order->Cus_Status === 'Completed')
                            <form action="{{ route('custom_orders.addToProduct', $order->Cusor_ID) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Add to Product</button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Waiting</button>
                        @endif
                        <a href="{{ route('custom_orders.edit', $order->Cusor_ID) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
