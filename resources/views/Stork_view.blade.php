<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stock</title>
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

    <div class="container mt-4">
        <h1>แสดงข้อมูลในสต๊อก</h1>

        <!-- แสดงข้อความเมื่อบันทึกข้อมูลสำเร็จ -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- ตารางแสดงข้อมูลสต๊อก -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Wood Type</th>
                    <th>Stock Name</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Thickness</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->wood->WType }} - {{ $stock->wood->WPattern }}</td>
                        <td>{{ $stock->S_Name }}</td>
                        <td>{{ $stock->S_Width }}</td>
                        <td>{{ $stock->S_Height }}</td>
                        <td>{{ $stock->S_Thickness }}</td>
                        <td>{{ $stock->Stock_quantity }}</td>
                        <td>{{ $stock->S_Status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ปุ่มกลับไปที่หน้าเพิ่มข้อมูล -->
        <a href="{{ route('stock.create') }}">
            <button class="btn btn-secondary">Back to Add Stock</button>
        </a>
    </div>

</body>
</html>
