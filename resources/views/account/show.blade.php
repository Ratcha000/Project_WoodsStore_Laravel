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
    <h1 class="text-center">บัญชีรายรับ - รายจ่าย</h1>

    <!-- รายรับ -->
    <div class="my-4">
        <h2 class="text-success">รายรับ</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>วันที่</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>ชำระเงิน</th>
                    <th>ประเภทสินค้า</th>
                    <th>จำนวนเงิน</th>
                    <th>ต้นทุน</th>
                    <th>กำไรสุทธิ</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($accounts) && count($accounts) > 0)
                    @foreach ($accounts as $account)
                        @if($account->income) <!-- แสดงเฉพาะรายการที่เป็นรายรับ -->
                            <tr>
                                <td>{{ $account->Ac_id }}</td>
                                <td>{{ $account->bill->order->O_date ?? 'ไม่ระบุ' }}</td>
                                <td>{{ $account->bill->order->customer->Cus_name ?? 'ไม่ระบุ' }}</td>
                                <td>{{ $account->bill->Payment_status ?? 'ยังไม่ชำระ' }}</td>
                                <td>{{ $account->bill->order->type ?? 'ไม่ระบุ' }}</td>
                                <td>{{ number_format($account->income, 2) }}</td>
                                <td>{{ number_format($account->cost->Total_Cost ?? 0, 2) }}</td>
                                <td>{{ number_format(($account->income - ($account->cost->Total_Cost ?? 0)), 2) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">ไม่มีข้อมูลรายรับ</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- รายจ่าย -->
    <div class="my-4">
        <h2 class="text-danger">รายจ่าย</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>รายการ</th>
                    <th>จำนวนเงิน</th>
                    <th>ชื่อผู้รับ</th>
                    <th>วันที่</th>
                    <th>ช่องทางการชำระ</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($accounts) && count($accounts) > 0)
                    @foreach ($accounts as $account)
                        @if($account->expense) <!-- แสดงเฉพาะรายการที่เป็นรายจ่าย -->
                            <tr>
                                <td>{{ $account->Ac_id }}</td>
                                <td>{{ $account->cost->Cost_Type ?? 'ไม่ระบุ' }}</td>
                                <td>{{ number_format($account->expense, 2) }}</td>
                                <td>{{ $account->cost->Description ?? 'ไม่ระบุ' }}</td>
                                <td>{{ $account->cost->Expense_Date ?? 'ไม่ระบุ' }}</td>
                                <td>{{ $account->cost->bank->bank_name ?? 'ไม่ระบุ' }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">ไม่มีข้อมูลรายจ่าย</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="container mt-3">
    <a href="{{ route('account.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
</div>

</body>
</html>
