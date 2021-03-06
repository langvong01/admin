<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class AdminController extends Controller
{
    //hàm kiểm tra đăng nhập
    public function show_dashboard(){
        return view('admin.dashboard');
    }



    public function index(){
        return view('admin.admin_login');
    }
    public function loginAdmin(Request $request){
        $admin_eamil = $request->admin_email;
        $admin_password = md5($request->admin_password);


        $result = DB::table('tbl_admin')->where('admin_email', $admin_eamil)->where('admin_password',$admin_password)->first();
        if ($result){
            Session::put('admin_name',$request->admin_name);
            Session::put('admin_id',$request->admin_id);
            return redirect('/dashboard');
        }
        else{
            Session::put('messenger', 'Email Hoặc Mật Khẩu Chưa Đúng');
            return redirect('/admin');
        }
    }
    public function logout_admin(){
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
