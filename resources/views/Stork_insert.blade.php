<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
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
        <h1>เพิ่มข้อมูลสต๊อก</h1>

        <form action="{{ route('stock.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="WID" class="form-label">Wood Type</label>
                <select name="WID" id="WID" class="form-control" required>
                    @foreach($woods as $wood)
                        <option value="{{ $wood->WID }}">{{ $wood->WType }} - {{ $wood->WPattern }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="S_Name" class="form-label">Stock Name</label>
                <input type="text" name="S_Name" id="S_Name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="S_Width" class="form-label">Width</label>
                <input type="number" name="S_Width" id="S_Width" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="S_Height" class="form-label">Height</label>
                <input type="number" name="S_Height" id="S_Height" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="S_Thickness" class="form-label">Thickness</label>
                <input type="number" name="S_Thickness" id="S_Thickness" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Stock_quantity" class="form-label">Quantity</label>
                <input type="number" name="Stock_quantity" id="Stock_quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="S_Status" class="form-label">Status (optional)</label>
                <input type="text" name="S_Status" id="S_Status" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Stock</button>
        </form>

        <a href="{{ route('stock.view') }}" class="btn btn-secondary mt-3">
            View All Stocks
        </a>
    </div>

</body>
</html>
