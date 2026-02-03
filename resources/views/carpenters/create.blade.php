<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลช่างไม้</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

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


    <div class="container mt-5">
        <h2>เพิ่มข้อมูลช่างไม้</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('carpenters.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Fname" class="form-label">ชื่อ</label>
                <input type="text" name="Fname" id="Fname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Lname" class="form-label">นามสกุล</label>
                <input type="text" name="Lname" id="Lname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Tel" class="form-label">เบอร์โทร</label>
                <input type="text" name="Tel" id="Tel" class="form-control">
            </div>

            <div class="mb-3">
                <label for="Age" class="form-label">อายุ</label>
                <input type="number" name="Age" id="Age" class="form-control">
            </div>

            <div class="mb-3">
                <label for="Address" class="form-label">ที่อยู่</label>
                <textarea name="Address" id="Address" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="Salary_Type" class="form-label">ประเภทเงินเดือน</label>
                <input type="text" name="Salary_Type" id="Salary_Type" class="form-control">
            </div>

            <div class="mb-3">
                <label for="Salary_Amount" class="form-label">จำนวนเงินเดือน (บาท)</label>
                <input type="number" step="0.01" name="Salary_Amount" id="Salary_Amount" class="form-control">
            </div>

            <div class="mb-3">
                <label for="Payment_Method" class="form-label">วิธีการจ่ายเงิน</label>
                <input type="text" name="Payment_Method" id="Payment_Method" class="form-control">
            </div>

            <div class="mb-3">
                <label for="Bonus" class="form-label">โบนัส (บาท)</label>
                <input type="number" step="0.01" name="Bonus" id="Bonus" class="form-control">
            </div>

            <div class="mb-3">
                <label for="Benefits" class="form-label">สวัสดิการ</label>
                <textarea name="Benefits" id="Benefits" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="SID" class="form-label">เลือกเงินเดือน (ถ้ามี)</label>
                <select name="SID" id="SID" class="form-control">
                    <option value="">-- ไม่ระบุ --</option>
                    @foreach($salaries as $salary)
                        <option value="{{ $salary->SID }}">
                            {{ $salary->S_Type }} - ฿{{ number_format($salary->S_Pay, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</body>
</html>
