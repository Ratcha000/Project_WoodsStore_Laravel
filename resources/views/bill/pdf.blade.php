<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ใบเสร็จรับเงิน</title>
    <style>
        @font-face {
            font-family: "THSarabunNew";
            src: url("{{ storage_path('fonts/THSarabunNew.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: "THSarabunNew", sans-serif;
            font-size: 14px;
            color: #000;
            width: 250px; /* กำหนดความกว้างให้เหมือนใบเสร็จจริง */
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .header p {
            margin: 2px 0;
            font-size: 14px;
        }
        .bold {
            font-weight: bold;
        }
        .invoice-info p {
            margin: 2px 0;
            font-size: 14px;
            text-align: left;
        }
        .item-list {
            width: 100%;
            border-top: 1px dashed #000;
            margin-top: 10px;
            padding-top: 5px;
        }
        .item-line {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            padding: 2px 0;
        }
        .total-section {
            margin-top: 10px;
            border-top: 1px dashed #000;
            padding-top: 5px;
            text-align: right;
            font-size: 14px;
        }
        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px dashed #000;
            padding-top: 5px;
        }
    </style>
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
    

    <div class="header">
        <p >ร้านจักรกฤษณ์ค้าไม้</p>
        <p>287 หมู่ 3 ตำบลพระกางทุ่ง</p>
        <p>อำเภอธาตุพนม จังหวัดนครพนม</p>
        <p>โทร: 081-234-5678</p>
    </div>

    <div class="invoice-info">
        <p >บิลเลขที่: #{{ $bill->Bill_ID }}</p>
        <p>ลูกค้า: {{ $bill->customer->Customer_name }}</p>
        <p>วันที่ออกบิล: {{ $downloadTime }}</p>
    </div>

    <div class="item-list">
        @foreach($bill->details as $item)
        <div class="item-line">
            <span>{{ $item->product->P_Name }}</span>
            <span>{{ $item->Quantity }}</span>
            <span>฿{{ number_format($item->Total_price, 2) }}</span>
        </div>
        @endforeach
    </div>

    <div class="total-section">
        <p>VAT (7%): ฿{{ number_format($bill->VAT, 2) }}</p>
        <p>ยอดรวมทั้งหมด: ฿{{ number_format($bill->Grand_total, 2) }}</p>
    </div>

    <div class="footer">
        <p>ขอบคุณที่ใช้บริการ!</p>
        <p>***************</p>
    </div>
</body>
</html>
