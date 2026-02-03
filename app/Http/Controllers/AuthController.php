<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //แสดงหน้า Login
    public function loginForm(){
        return view('auth.login');
    }

    //จัดการการ Login
    public function login(Request $request){
        // Validate ข้อมูลที่กรอก
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // ค้นหาผู้ใช้จากอีเมล
        $user = Login::where('email', $request->email)->first();

        // ตรวจสอบว่า user มีข้อมูลและรหัสผ่านที่กรอกตรงกับที่เก็บไว้หรือไม่
        if ($user && Hash::check($request->password, $user->password)) {
            // บันทึกเวลาการเข้าสู่ระบบล่าสุด
            $user->last_login_at = now();
            $user->save();

            // ล็อกอินผู้ใช้
            Auth::login($user);

            // ส่งไปยังหน้า Home
            return redirect()->route('home');
        }

        // หากข้อมูลไม่ถูกต้อง
        return back()->withErrors(['email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'])->withInput();
    }

    //แสดงหน้า Register
    public function registerForm(){
        return view('auth.register');
    }

    //จัดการการ Register
    public function register(Request $request){
        // Validate ข้อมูลที่กรอก
        $request->validate([
            'email' => 'required|email|unique:logins',
            'password' => 'required|min:6|confirmed',
        ]);

        // สร้างผู้ใช้งานใหม่
        $user = Login::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // เข้ารหัสรหัสผ่าน
        ]);

        // ล็อกอินผู้ใช้งาน
        Auth::login($user);

        // ส่งไปยังหน้า Home
        return redirect()->route('home');
    }

    //Logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
