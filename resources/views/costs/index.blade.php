<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการค่าใช้จ่าย</title>
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
    <h2>รายการค่าใช้จ่าย</h2>
    <a href="{{ route('costs.create') }}" class="btn btn-success mb-3">เพิ่มค่าใช้จ่าย</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ประเภทค่าใช้จ่าย</th>
                <th>รายละเอียด</th>
                <th>จำนวน</th>
                <th>ราคาต่อหน่วย</th>
                <th>ยอดรวม</th>
                <th>ช่างไม้</th>
                <th>ไม้ที่ใช้</th>
                <th>หมายเลขอ้างอิง</th>
                <th>วันที่</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($costs as $cost)
                <tr>
                    <td>{{ $cost->Cost_Type }}</td>
                    <td>{{ $cost->Description }}</td>
                    <td>{{ $cost->Quantity }}</td>
                    <td>{{ $cost->Unit_Cost }}</td>
                    <td>{{ $cost->Total_Cost }}</td>
                    <td>{{ optional($cost->carpenter)->Fname }} {{ optional($cost->carpenter)->Lname }}</td>
                    <td>{{ optional($cost->wood)->WType }}</td>
                    <td>{{ $cost->Reference_No }}</td>
                    <td>{{ $cost->Expense_Date }}</td>
                    <td>
                        <a href="{{ route('costs.edit', $cost->Cost_ID) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                        <form action="{{ route('costs.destroy', $cost->Cost_ID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
