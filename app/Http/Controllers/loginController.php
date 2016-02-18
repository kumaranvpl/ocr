<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Crypt;
use Hash;
use Mail;
use File;
use Session;

use App\Users;
use App\Companies;
use App\Password_resets;
use App\CustomClasses\UUID;


class loginController extends Controller
{

    public function home()
    {
        return redirect('/login');
        //return view('welcome');
    }

    public function logIn(Request $request)
    {
        /*if(isset($_COOKIE["admin"]))
        {
            if(base64_decode($_COOKIE["admin"])=="yes"){return redirect('/admin/dashboard');}
            else {return redirect('/user/dashboard');}
        }
        else
        {
            return view('login');
        }*/
        if(Session::has('admin'))
        {
            if(Session::get('admin')=='yes') {return redirect('/admin/dashboard');}
            else{return redirect('/user/dashboard');}
        }
        else
        {
            return view('login');
        }
    }

    public function logOut(Request $request)
    {
        if(isset($_COOKIE['admin'])) {setcookie("admin", "", time() - 3600);}
        if(isset($_COOKIE['id'])) {setcookie("admin", "", time() - 3600);}
        if(isset($_COOKIE['name'])) {setcookie("admin", "", time() - 3600);}
        Session::flush();
        return redirect('/login');
    }

    public function registerPage(Request $request)
    {

        if(base64_decode($request->source)=='verify')
        {
            return view('register');
        }
        else
        {
            return redirect('/login');
        }
    }

    public function verifyPage(Request $request)
    {
        /*if(isset($_COOKIE["admin"]))
        {
            if(base64_decode($_COOKIE["admin"])=="yes"){return redirect('/admin/dashboard');}
            else {return redirect('/user/dashboard');}
        }*/
        if(Session::has('admin'))
        {
            if(Session::get('admin')=='yes') {return redirect('/admin/dashboard');}
            else{return redirect('/user/dashboard');}
        }
        else
        {
            if($request->company)
            {
                return view('verify');
            }
            else
            {
                return redirect('/login');
            }
        }
    }

    public function logInPost(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password'   => '
                required|
                min:8|
                alpha_num
                ',
        ]);

       $users = Users::where('email', $request->email)
            ->where('is_confirmed', 'yes')
            ->first();

        //var_dump($users);die();

        if ( $users && Hash::check($request->password, $users->password)) {

            //setcookie("id", base64_encode($users->id), time() + (28800), "/");
            //setcookie("name", base64_encode($users->name), time() + (28800), "/");
            Session::put('id', $users->id);
            Session::put('name', $users->name);
            if($users->is_admin == 'yes')
            {
                ///setcookie("admin", base64_encode("yes"), time() + (28800), "/");
                Session::put('admin', 'yes');
                return redirect('/admin/dashboard');
            }
            else
            {
                //setcookie("admin", base64_encode("no"), time() + (28800), "/");
                Session::put('admin', 'no');
                return redirect('/user/dashboard');
            }

        }
        else
        {
            return back()->withInput()->with('error', 'The Username or Password is incorrect');
        }
    }

    public function registerPagePost(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'password'   => '
                required|
                min:8|
                alpha_num',
            'confirm_password'   => '
                required|
                same:password',
            'eid' => 'required',
            'company' => 'required',
        ]);

        $users = New Users;
        $users->email = $request->email;
        $users->name = $request->name;
        $users->password = Hash::make($request->password);
        $users->employee_id = $request->eid;
        $users->company = $request->company;
        $users->is_admin = "yes";

        if($users->save())
        {
            $users->added_by = $users->id;
            $users->save();
            $url = "/verifyMail?id=".base64_encode($users->id);
            Mail::send('pages.emails.verification', ['users' => $users, 'url' => $url], function ($m) use ($users) {
                $m->from('donotreply@1000lookz.com', 'PaperWork - 1000lookz');

                $m->to($users->email, $users->name)->subject('Verify your email');
            });
            return view("pages.emails.verifyMsg", ['title'=>'Success', 'msg'=>'Registered successfully... Verify your account using the mail sent to your mail id...']);
        }
        else
        {
            return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Registration Failed :(']);
        }

    }

    public function verifyPagePost(Request $request)
    {

        $this->validate($request, [
            'password'   => 'required',
        ]);

        //var_dump($request);
        $companies = Companies::where('company_name', $request->company)
            ->first();
        //var_dump($companies);
        if ( $companies && Hash::check($request->password, $companies->verification_password))
        {
            return redirect('/register?source='.base64_encode("verify"));
        }
        else
        {
            return back()->withInput()->with('error', 'The Password is incorrect');
        }
    }

    public function verifyMail(Request $request)
    {
        Session::forget('id');
        Session::forget('admin');
        Session::forget('name');
        if($request->id)
        {
            $user = Users::where('id', base64_decode($request->id))
                ->first();
            if($user)
            {
                if($user->is_admin=="yes")
                {
                    if($user->is_confirmed=="no")
                    {
                    $user->time_verified = date("Y-m-d h:i:s");
                    $user->is_confirmed = "yes";
                    $user->save();
                    $path = public_path().'/images/uploads/'.$user->id;
                    File::makeDirectory($path, 0775, true);
                    return redirect('/login');
                    }
                    else {return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Link expired.']);}
                }
                else if($user->is_admin=="no")
                {
                    if( $user->password=="" ) {return view('addPassword');}
                    else {return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Link expired.']);}
                }

            }
            else
            {
                return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Link expired.']);
            }
        }
        else
        {
            return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Verification Failed :(']);
        }
    }

    public function verifyMailPost(Request $request)
    {
        $this->validate($request, [
            'password'   => '
                required|
                min:8|
                alpha_num',
            'confirm_password'   => '
                required|
                same:password',
        ]);

        $users = Users::where('id', base64_decode($request->id))
            ->first();
        if( $users && $users->password=="")
        {
            $users->password = Hash::make($request->password);
            $users->time_verified = date("Y-m-d h:i:s");
            $users->is_confirmed = "yes";

            if($users->save())
            {
                $path = public_path().'/images/uploads/'.$users->added_by.'/'.$users->id;
                File::makeDirectory($path, 0775, true);
                return redirect("/login");
            }
            else
            {
                return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Failed  :(']);
            }
        }
        else
        {
            return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Link expired. Password was already added.']);
        }
    }

    public function forgotPassword(Request $request)
    {
        Session::forget('id');
        Session::forget('admin');
        Session::forget('name');
        return view('forgotPassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $users = Users::where('email', $request->email)
            ->first();
        if($users)
        {
            $token = new UUID;
            $p_reset = new Password_resets;
            $p_reset->email = $users->email;
            $p_reset->token = $token;
            $p_reset->save();
            //$url = "/forgotPasswordMail?id=".base64_encode($users->id);
            $url = url('/forgotPasswordMail', $token);
            Mail::send('pages.emails.forgotPassword', ['users' => $users, 'url' => $url], function ($m) use ($users) {
                $m->from('donotreply@1000lookz.com', 'PaperWork - 1000lookz');

                $m->to($users->email, $users->name)->subject('Reset Password');
            });
            return view("pages.emails.verifyMsg", ['title'=>'Success', 'msg'=>'Password reset link sent to mail.']);
        }
        else
        {
            return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Email does not exist']);
        }

    }

    public function forgotPasswordMail($token)
    {
        $p_reset = Password_resets::where('token', $token)
            ->first();
        if($p_reset)
        {
            return view('resetPassword')->with('email', $p_reset->email);
        }
        else
        {
            return view("pages.emails.verifyMsg", ['title'=>'Failed', 'msg'=>'Invalid password reset request. Please try again']);
        }
    }

    public function forgotPasswordMailPost($token, Request $request)
    {
        $this->validate($request, [
            'password'   => '
                required|
                min:8|
                alpha_num',
            'confirm_password'   => '
                required|
                same:password',
        ]);

        $p_reset = Password_resets::where('token', $token)
            ->first();

        if(!$p_reset)
        {
            return view("pages.emails.verifyMsg", ['title'=>'Failed', 'msg'=>'Invalid password reset request. Please try again']);
        }
        $users = Users::where('email', $p_reset->email)
            ->first();
        if($users)
        {
            $users->password = Hash::make($request->password);
            $users->time_verified = date("Y-m-d h:i:s");
            $users->is_confirmed = "yes";

            if($users->save())
            {
                /*$path = public_path().'/images/uploads/'.$users->added_by.'/'.$users->id;
                File::makeDirectory($path, 0775, true);*/
                $p_reset->delete();
                return view("pages.emails.verifyMsg", ['title'=>'Success', 'msg'=>'Password changed successfully']);
            }
            else
            {
                return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Failed  :(']);
            }
        }
        else
        {
            return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Failed  :(']);
        }
    }
}
