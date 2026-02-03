<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📦 เลือกไม้ดิบเพื่อนำไปขาย</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f8f9fa;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        input {
            width: 80px;
            padding: 5px;
            text-align: center;
        }
        button {
            padding: 8px 12px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: darkgreen;
        }
        .no-stock {
            text-align: center;
            font-size: 18px;
            color: red;
            margin-top: 20px;
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

      

    <h2>📦 เลือกไม้ดิบเพื่อนำไปขาย</h2>

    @if($stocks->isEmpty())
        <p class="no-stock">ไม่มีไม้ดิบในคลัง</p>
    @else
        <table>
            <tr>
                <th>ชื่อไม้</th>
                <th>ขนาด (กว้าง x สูง x หนา)</th>
                <th>จำนวนคงเหลือ</th>
                <th>เพิ่มไปขาย</th>
            </tr>
            @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->S_Name }}</td>
                    <td>{{ $stock->S_Width }} x {{ $stock->S_Height }} x {{ $stock->S_Thickness }} cm</td>
                    <td>{{ $stock->Stock_quantity }}</td>
                    <td>
                        <form action="{{ route('products.addFromStock', $stock->SID) }}" method="POST">
                            @csrf
                            <input type="number" name="P_Quantity" placeholder="จำนวน" min="1" required>
                            <input type="number" name="Price" placeholder="ราคาขาย" min="1" required>
                            <button type="submit">เพิ่มไปขาย</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</body>
</html>
