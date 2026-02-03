<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดบิล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">รายละเอียดบิล</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>หมายเลขคำสั่งซื้อ</th>
                <th>ลูกค้า</th>
                <th>ราคาทั้งหมด (บาท)</th>
                <th>VAT (บาท)</th>
                <th>ยอดรวม (บาท)</th>
                <th>สถานะการชำระเงิน</th>
                <th>อัปเดตสถานะ</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($bills) && count($bills) > 0)
                @foreach ($bills as $bill)
                    <tr>
                        <td>{{ $bill->Bill_ID }}</td>
                        <td>{{ $bill->order->Order_ID ?? 'ไม่ระบุ' }}</td>
                        <td>{{ $bill->customer->Cus_name ?? 'ไม่ระบุ' }}</td>
                        <td>{{ number_format($bill->Total_price, 2) }}</td>
                        <td>{{ number_format($bill->VAT, 2) }}</td>
                        <td>{{ number_format($bill->Grand_total, 2) }}</td>
                        <td>
                            <span class="badge 
                                @if($bill->Payment_status == 'pending') bg-warning text-dark 
                                @elseif($bill->Payment_status == 'paid') bg-success 
                                @else bg-danger @endif">
                                {{ ucfirst($bill->Payment_status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('bills.update', $bill->Bill_ID) }}" method="POST">
                                @csrf
                                <select name="Payment_status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $bill->Payment_status == 'pending' ? 'selected' : '' }}>รอชำระ</option>
                                    <option value="paid" {{ $bill->Payment_status == 'paid' ? 'selected' : '' }}>ชำระแล้ว</option>
                                    <option value="cancelled" {{ $bill->Payment_status == 'cancelled' ? 'selected' : '' }}>ยกเลิก</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">ไม่มีข้อมูลบิล</td>
                </tr>
            @endif
        </tbody>
    </table>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
