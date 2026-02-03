<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกค่าใช้จ่าย</title>
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
    <h2>บันทึกค่าใช้จ่าย</h2>
    <form action="{{ route('costs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Cost_Type">ประเภทค่าใช้จ่าย</label>
            <select name="Cost_Type" class="form-control">
                <option value="wood">ค่าซื้อไม้</option>
                <option value="carpenter_salary">ค่าแรงช่างไม้</option>
                <option value="electricity">ค่าไฟฟ้า</option>
                <option value="water">ค่าน้ำ</option>
                <option value="fuel">ค่าน้ำมัน</option>
                <option value="other">ค่าใช้จ่ายอื่นๆ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Expense_Date">วันที่เกิดค่าใช้จ่าย</label>
            <input type="date" name="Expense_Date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Description">รายละเอียดเพิ่มเติม</label>
            <input type="text" name="Description" class="form-control">
        </div>

        <div class="mb-3">
            <label for="Carpenter_ID">ช่างไม้ (ถ้ามี)</label>
            <select name="Carpenter_ID" class="form-control">
                <option value="">-- เลือกช่างไม้ --</option>
                @foreach($carpenters as $carpenter)
                    <option value="{{ $carpenter->SSN_Passport }}">{{ $carpenter->Fname }} {{ $carpenter->Lname }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Wood_ID">ไม้ที่ใช้ (ถ้ามี)</label>
            <select name="Wood_ID" class="form-control">
                <option value="">-- เลือกไม้ --</option>
                @foreach($woods as $wood)
                    <option value="{{ $wood->WID }}">{{ $wood->WType }} - {{ $wood->WPattern }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Quantity">จำนวน</label>
            <input type="number" name="Quantity" class="form-control">
        </div>

        <div class="mb-3">
            <label for="Unit_Cost">ราคาต่อหน่วย</label>
            <input type="number" name="Unit_Cost" class="form-control" step="0.01">
        </div>

        <div class="mb-3">
            <label for="Total_Cost">ยอดรวม</label>
            <input type="number" name="Total_Cost" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="Reference_No">หมายเลขอ้างอิง (Invoice)</label>
            <input type="text" name="Reference_No" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">บันทึกค่าใช้จ่าย</button>
    </form>
</div>
</body>
</html>
