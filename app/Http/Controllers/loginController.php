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

use App\Users;
use App\Companies;

class loginController extends Controller
{

    public function home()
    {
        return redirect('/login');
    }

    public function logIn(Request $request)
    {
        if(isset($_COOKIE["admin"]))
        {
            if(base64_decode($_COOKIE["admin"])=="yes"){return redirect('/admin/dashboard');}
            else {return redirect('/user/dashboard');}
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
        return redirect('/login');
    }

    public function registerPage(Request $request)
    {

        if($request->source=='verify')
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
        if(isset($_COOKIE["admin"]))
        {
            if(base64_decode($_COOKIE["admin"])=="yes"){return redirect('/admin/dashboard');}
            else {return redirect('/user/dashboard');}
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

    public function verifyLogIn(Request $request)
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

            setcookie("id", base64_encode($users->id), time() + (28800), "/");
            setcookie("name", base64_encode($users->name), time() + (28800), "/");
            if($users->is_admin == 'yes')
            {
                setcookie("admin", base64_encode("yes"), time() + (28800), "/");
                return redirect('/admin/dashboard');
            }
            else
            {
                setcookie("admin", base64_encode("no"), time() + (28800), "/");
                return redirect('/user/dashboard');
            }

        }
        else
        {
            return back()->withInput()->with('error', 'The Username or Password is incorrect');
        }
    }

    public function verifyRegisterPage(Request $request)
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
            $url = "localhost:8888/verifyMail?id=".base64_encode($users->id);
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

    public function verifyVerifyPage(Request $request)
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
            return redirect('/register?source=verify');
        }
        else
        {
            return back()->withInput()->with('error', 'The Password is incorrect');
        }
    }

    public function verifyMail(Request $request)
    {
        if($request->id)
        {
            $user = Users::where('id', base64_decode($request->id))
                ->first();
            if($user)
            {
                if($user->is_admin=="yes")
                {
                    $users = New Users;
                    $users->time_verified = date("Y-m-d h:i:s");
                    $users->is_confirmed = "yes";
                    $users->save()->where('id', base64_decode($request->id));
                    $path = public_path().'/images/uploads/'.$user->id;
                    File::makeDirectory($path, 0775, true);
                    return redirect('/login');
                }
                else if($user->is_admin=="no")
                {
                    return view('addPassword');
                }
            }
            else
            {
                return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Verification Failed :(']);
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
        if($users)
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
            return view("pages.emails.verifyMsg", ['title'=>'failed', 'msg'=>'Failed  :(']);
        }
    }

    public function forgotPassword(Request $request)
    {
        if(isset($_COOKIE['admin'])) {setcookie("admin", "", time() - 3600);}
        if(isset($_COOKIE['id'])) {setcookie("admin", "", time() - 3600);}
        if(isset($_COOKIE['name'])) {setcookie("admin", "", time() - 3600);}
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
            $url = "localhost:8888/forgotPasswordMail?id=".base64_encode($users->id);
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

    public function forgotPasswordMail()
    {
        return view('addPassword');
    }

    public function forgotPasswordMailPost(Request $request)
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
        if($users)
        {
            $users->password = Hash::make($request->password);
            $users->time_verified = date("Y-m-d h:i:s");
            $users->is_confirmed = "yes";

            if($users->save())
            {
                /*$path = public_path().'/images/uploads/'.$users->added_by.'/'.$users->id;
                File::makeDirectory($path, 0775, true);*/
                return redirect("/login");
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
