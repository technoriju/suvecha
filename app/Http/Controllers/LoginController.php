<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Employee;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->checkUrl();

        if($request->session()->has('shuvecha'))
            return redirect(url()->previous());
        else
            return view('login');
    }
    public function loginValidate(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'username'=>'required',
            'password'=>'required'
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $data = Employee::select('id','employee_name','phone','role_id','headquarter_id')
                ->where(['phone'=>$request->username,'password'=>$request->password])
                ->first();
        if($data == true)
        {
            Session::put('shuvecha',$data);
            if(session('back_url')!=""):
                $url = session('back_url');
                Session::pull('back_url');
                return redirect($url);
            endif;

            return redirect('/home');
        }
        else
        {
            $data['error'] = "Username or Password wrong";
            $request->session()->flash('error', $data['error']);
            return redirect()->back();
        }

    }

    public function checkUrl()
    {
        $url = url()->previous();
        if($url == url('/register') || $url == url('/lostpassword') || $url == url('/') || $url == url('/logout') || $url == url('/manage') || $url == url('/manage/logout')):
           Session::forget('back_url');
        else:
           Session::put('back_url', $url);
        endif;
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        $req->session()->flash('error', "You are successfully Logout");
        return redirect('/');
    }
}
