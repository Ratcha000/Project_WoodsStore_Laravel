<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Custom Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        <h2>เพิ่มรายการสั่งทำ</h2>
        <form action="{{ route('custom_orders.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>What do you want to produce?:</label>
                <input type="text" name="Product_Name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Customer:</label>
                <select name="Customer_id" class="form-control" required>
                    <option value="" disabled selected>-- Select Customer --</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->Customer_id }}">{{ $customer->Customer_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Width (cm):</label>
                <input type="number" name="Cus_Width" class="form-control" step="0.1" required>
            </div>

            <div class="form-group">
                <label>Height (cm):</label>
                <input type="number" name="Cus_Height" class="form-control" step="0.1" required>
            </div>

            <div class="form-group">
                <label>Thickness (cm):</label>
                <input type="number" name="Cus_Thickness" class="form-control" step="0.1" required>
            </div>

            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" name="Cus_Quantity" class="form-control" min="1" required>
            </div>

            <div class="form-group">
                <label>Select Stock:</label>
                <select name="Stock_ID" class="form-control" required>
                    <option value="" disabled selected>-- Select Stock --</option>
                    @foreach ($stocks as $stock)
                    <option value="{{ $stock->SID }}" data-quantity="{{ $stock->Stock_quantity }}">
                        {{ $stock->S_Name }} - ({{ $stock->S_Width }}x{{ $stock->S_Height }}x{{ $stock->S_Thickness }}) 
                        - Available: {{ $stock->Stock_quantity }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- กรอกจำนวนไม้ที่นำไปใช้ -->
            <div class="form-group">
                <label>Amount of Wood to Deduct from Stock:</label>
                <input type="number" name="Used_Stock_Quantity" class="form-control" min="1" required>
            </div>

            <div class="form-group">
                <label>Carpenter:</label>
                <select name="SSN_Passport" class="form-control" required>
                    <option value="" disabled selected>-- Select Carpenter --</option>
                    @foreach ($carpenters as $carpenter)
                    <option value="{{ $carpenter->SSN_Passport }}">{{ $carpenter->Fname }} {{ $carpenter->Lname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Price:</label>
                <input type="number" name="Cus_Price" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label>Status:</label>
                <select name="Cus_Status" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>
</body>
</html>
