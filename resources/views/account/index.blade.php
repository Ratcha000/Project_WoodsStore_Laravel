<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บัญชีรายรับ - รายจ่าย</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    

<div class="container mt-5">
    <h2 class="text-center">บัญชีรายรับ - รายจ่าย</h2>

    <div class="row my-4">
        <div class="col-md-6">
            <div class="card p-3 bg-success text-white">
                <h4>รายรับทั้งหมด</h4>
                <h3>{{ number_format($totalIncome, 2) }} บาท</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 bg-danger text-white">
                <h4>รายจ่ายทั้งหมด</h4>
                <h3>{{ number_format($totalExpense, 2) }} บาท</h3>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <canvas id="accountChart"></canvas>
    </div>

    <div class="mt-4">
        <h4>รายละเอียดบัญชี</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>วันที่</th>
                    <th>รายรับ</th>
                    <th>รายจ่าย</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->Ac_date }}</td>
                    <td>{{ number_format($account->income, 2) }}</td>
                    <td>{{ number_format($account->expense, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container mt-3">
    <a href="{{ route('account.show') }}" class="btn btn-primary">ดูรายละเอียดบัญชี</a>
</div>

<script>
    var ctx = document.getElementById('accountChart').getContext('2d');
    var accountChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($monthlyData->pluck('month')),
            datasets: [
                {
                    label: 'รายรับ',
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    data: @json($monthlyData->pluck('total_income')),
                },
                {
                    label: 'รายจ่าย',
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    data: @json($monthlyData->pluck('total_expense')),
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

</body>
</html>
