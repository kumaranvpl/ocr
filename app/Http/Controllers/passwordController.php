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
use Flash;

use App\Users;
use App\Companies;
use App\Password_resets;
use App\CustomClasses\UUID;

class passwordController extends Controller
{
    //

    public function changePassword()
    {
        return view('changePassword');
    }

    public function changePasswordPost(Request $request)
    {
        $this->validate($request, [
            'old_password'   => '
                required|
                min:8|
                alpha_num',
            'new_password'   => '
                required|
                min:8|
                alpha_num',
            'confirm_new_password'   => '
                required|
                same:new_password',
        ]);

        $users = Users::where('id', Session::get('id'))
            ->first();
        if( $users && Hash::check($request->old_password, $users->password) )
        {
            $users->password = Hash::make($request->new_password);
            if($users->save())
            {
                Flash::success('Password changed successfully.');
                return redirect('/login');
            }
            else
            {
                Flash::error('Failed to change the password.');
                return redirect('/login');
            }
        }
        else
        {
            return back()->withInput()->with('error', 'The Old Password is incorrect');
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
