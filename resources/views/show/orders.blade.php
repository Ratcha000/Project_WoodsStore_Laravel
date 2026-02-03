<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดคำสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">รายละเอียดคำสั่งซื้อ</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>ลูกค้า</th>
                <th>วันที่สั่งซื้อ</th>
                <th>ราคาทั้งหมด (บาท)</th>
                <th>สถานะ</th>
                <th>อัปเดตสถานะ</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($orders) && count($orders) > 0)
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->Order_ID }}</td>
                        <td>{{ $order->customer->Customer_name ?? 'ไม่ระบุ' }}</td>
                        <td>{{ $order->Order_date }}</td>
                        <td>{{ number_format($order->Total_price, 2) }}</td>
                        <td>
                            <span class="badge 
                                @if($order->Status == 'pending') bg-warning text-dark 
                                @elseif($order->Status == 'completed') bg-success 
                                @else bg-danger @endif">
                                {{ ucfirst($order->Status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('orders.update', $order->Order_ID) }}" method="POST">
                                @csrf
                                <select name="Status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->Status == 'pending' ? 'selected' : '' }}>รอดำเนินการ</option>
                                    <option value="completed" {{ $order->Status == 'completed' ? 'selected' : '' }}>เสร็จสิ้น</option>
                                    <option value="cancelled" {{ $order->Status == 'cancelled' ? 'selected' : '' }}>ยกเลิก</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">ไม่มีข้อมูลคำสั่งซื้อ</td>
                </tr>
            @endif
        </tbody>
    </table>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
