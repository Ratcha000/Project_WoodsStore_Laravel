<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดลูกค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">รายละเอียดลูกค้า</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th>อีเมล</th>
                <th>เบอร์โทร</th>
                <th>ที่อยู่</th>
                <th>ประเภทลูกค้า</th>
                <th>สถานะ</th>
                <th>อัปเดตข้อมูล</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($customers) && count($customers) > 0)
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->Customer_id }}</td>
                        <td>{{ $customer->Customer_name }}</td>
                        <td>{{ $customer->Customer_email }}</td>
                        <td>{{ $customer->Customer_phone ?? 'ไม่ระบุ' }}</td>
                        <td>{{ $customer->Customer_address ?? 'ไม่ระบุ' }}</td>
                        <td>
                            <span class="badge 
                                @if($customer->Customer_type == 'regular') bg-secondary 
                                @elseif($customer->Customer_type == 'wholesale') bg-primary 
                                @else bg-warning text-dark @endif">
                                {{ ucfirst($customer->Customer_type) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge 
                                @if($customer->Status == 'active') bg-success 
                                @elseif($customer->Status == 'inactive') bg-warning text-dark 
                                @else bg-danger @endif">
                                {{ ucfirst($customer->Status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('customers.update', $customer->Customer_id) }}" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <!-- อัปเดตประเภทลูกค้า -->
                                    <select name="Customer_type" class="form-select me-2" onchange="this.form.submit()">
                                        <option value="regular" {{ $customer->Customer_type == 'regular' ? 'selected' : '' }}>ปกติ</option>
                                        <option value="wholesale" {{ $customer->Customer_type == 'wholesale' ? 'selected' : '' }}>ขายส่ง</option>
                                        <option value="vip" {{ $customer->Customer_type == 'vip' ? 'selected' : '' }}>VIP</option>
                                    </select>
                            
                                    <!-- อัปเดตสถานะ -->
                                    <select name="Status" class="form-select" onchange="this.form.submit()">
                                        <option value="active" {{ $customer->Status == 'active' ? 'selected' : '' }}>เปิดใช้งาน</option>
                                        <option value="inactive" {{ $customer->Status == 'inactive' ? 'selected' : '' }}>ปิดใช้งาน</option>
                                        <option value="banned" {{ $customer->Status == 'banned' ? 'selected' : '' }}>แบน</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">ไม่มีข้อมูลลูกค้า</td>
                </tr>
            @endif
        </tbody>
    </table>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
