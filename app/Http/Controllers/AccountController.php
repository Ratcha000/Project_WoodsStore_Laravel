<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Bill;
use App\Models\Cost;

class AccountController extends Controller
{
    public function index()
    {
        // ตรวจสอบว่ามีข้อมูลบัญชีหรือยัง
        if (Account::count() == 0) {
            // ดึงข้อมูลจาก `bills` แล้วบันทึกลง `accounts`
            $bills = Bill::all();
            foreach ($bills as $bill) {
                Account::updateOrCreate(
                    ['Bill_ID' => $bill->Bill_ID],
                    [
                        'income' => $bill->Total_price,
                        'expense' => null,
                        'Ac_date' => $bill->created_at,
                    ]
                );
            }

            // ดึงข้อมูลจาก `costs` แล้วบันทึกลง `accounts`
            $costs = Cost::all();
            foreach ($costs as $cost) {
                Account::updateOrCreate(
                    ['Cost_ID' => $cost->Cost_ID],
                    [
                        'income' => null,
                        'expense' => $cost->Total_Cost,
                        'Ac_date' => $cost->Expense_Date,
                    ]
                );
            }
        }

        // ดึงข้อมูลจาก accounts
        $accounts = Account::orderBy('Ac_date', 'asc')->get();

        // คำนวณยอดรวมรายรับ และรายจ่าย
        $totalIncome = Account::whereNotNull('income')->sum('income');
        $totalExpense = Account::whereNotNull('expense')->sum('expense');

        // ดึงข้อมูลรายเดือนสำหรับแสดงผลเป็นกราฟ
        $monthlyData = Account::selectRaw("DATE_FORMAT(Ac_date, '%Y-%m') as month, SUM(income) as total_income, SUM(expense) as total_expense")
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return view('account.index', compact('accounts', 'totalIncome', 'totalExpense', 'monthlyData'));
    }

    public function show()
    {
        // ดึงข้อมูลบัญชีทั้งหมด
        $accounts = Account::with(['bill.order.customer', 'cost', 'bill'])
            ->orderBy('Ac_date', 'asc')
            ->get();

        return view('account.show', compact('accounts'));
    }
}
