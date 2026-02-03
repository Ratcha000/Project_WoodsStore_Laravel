<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการจัดส่ง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">รายละเอียดการจัดส่ง</h1>

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
                <th>ประเภทการขนส่ง</th>
                <th>ค่าขนส่ง (บาท)</th>
                <th>ระยะทาง (กม.)</th>
                <th>ค่าขนส่งเพิ่มเติม</th>
                <th>สถานะ</th>
                <th>วันที่จัดส่ง</th>
                <th>หมายเลขติดตาม</th>
                <th>อัปเดตสถานะ</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($deliveries) && count($deliveries) > 0)
                @foreach ($deliveries as $delivery)
                    <tr>
                        <td>{{ $delivery->DID }}</td>
                        <td>{{ $delivery->order->Order_ID ?? 'ไม่ระบุ' }}</td>
                        <td>{{ $delivery->customer->Cus_name ?? 'ไม่ระบุ' }}</td>
                        <td>{{ $delivery->D_type }}</td>
                        <td>{{ number_format($delivery->D_price, 2) }}</td>
                        <td>{{ number_format($delivery->distance_km, 2) }}</td>
                        <td>{{ number_format($delivery->extra_cost, 2) }}</td>
                        <td>
                            <span class="badge 
                                @if($delivery->Delivery_status == 'pending') bg-warning text-dark 
                                @elseif($delivery->Delivery_status == 'shipped') bg-primary 
                                @elseif($delivery->Delivery_status == 'delivered') bg-success 
                                @else bg-danger @endif">
                                {{ ucfirst($delivery->Delivery_status) }}
                            </span>
                        </td>
                        <td>{{ $delivery->Delivery_date ?? 'ยังไม่จัดส่ง' }}</td>
                        <td>{{ $delivery->Tracking_number ?? 'ไม่มีหมายเลขติดตาม' }}</td>
                        <td>
                            <form action="{{ route('deliveries.update', $delivery->DID) }}" method="POST">
                                @csrf
                                <select name="Delivery_status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $delivery->Delivery_status == 'pending' ? 'selected' : '' }}>รอดำเนินการ</option>
                                    <option value="shipped" {{ $delivery->Delivery_status == 'shipped' ? 'selected' : '' }}>กำลังจัดส่ง</option>
                                    <option value="delivered" {{ $delivery->Delivery_status == 'delivered' ? 'selected' : '' }}>จัดส่งสำเร็จ</option>
                                    <option value="cancelled" {{ $delivery->Delivery_status == 'cancelled' ? 'selected' : '' }}>ถูกยกเลิก</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11" class="text-center">ไม่มีข้อมูลการจัดส่ง</td>
                </tr>
            @endif
        </tbody>
    </table>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
