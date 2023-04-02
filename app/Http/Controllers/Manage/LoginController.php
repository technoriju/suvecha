<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\AdminCred;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        //$this->checkUrl();

        // if($request->session()->has('shuvecha'))
        //     return redirect(url()->previous());
        // else
            return view('manage.login');
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

        $data = AdminCred::select('user_name','name','id')
                ->where(['user_name'=>$request->username,'password'=>md5($request->password)])
                ->first();
        if($data == true)
        {
            Session::put('manage',"riju");
            // if(session('back_url')!=""):
            //     $url = session('back_url');
            //     Session::pull('back_url');
            //     return redirect($url);
            // endif;

            return redirect('/manage/dashboard');
        }
        else
        {
            $data['error'] = "Username or Password wrong";
            $request->session()->flash('error', $data['error']);
            return redirect()->back();
        }

    }

    // public function checkUrl()
    // {
    //     $url = url()->previous();
    //     if($url == url('/manage/register') || $url == url('/manage/lostpassword') || $url == url('/manage')):
    //        Session::forget('back_url');
    //     else:
    //        Session::put('back_url', $url);
    //     endif;
    // }

    public function logout(Request $req)
    {
        $req->session()->flush();
        $req->session()->flash('error', "You are successfully Logout");
        return redirect('/manage');
    }
}
