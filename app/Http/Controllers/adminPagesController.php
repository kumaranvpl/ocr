<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Crypt;
use Hash;
use Mail;
use Flash;

use App\Users;

class adminPagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkAdminSession');
    }

    public function home()
    {
        return view("pages.adminHome");
    }

    public function addUser()
    {
        return view("pages.addUser");
    }

    public function addUserPost(Request $request)
    {
        $this->validate($request, [
            'eid' => 'required',
            'email' => 'required|email',
            'name' => 'required',
        ]);

        $admin = Users::where('id', base64_decode($_COOKIE['id']))
            ->first();

        $users = New Users;
        $users->email = $request->email;
        $users->name = $request->name;
        $users->employee_id = $request->eid;
        $users->company = $admin->company;
        $users->added_by = $admin->id;

        if($users->save())
        {
            $url = "localhost:8888/verifyMail?id=".base64_encode($users->id);
            Mail::send('pages.emails.verification', ['users' => $users, 'url' => $url], function ($m) use ($users) {
                $m->from('donotreply@1000lookz.com', 'PaperWork - 1000lookz');

                $m->to($users->email, $users->name)->subject('Verify your email');
            });
            Flash::success('New user added successfully. Verification mail sent to given email id.');
            return redirect('/admin/users/manage');
        }
        else
        {
            Flash::error('Failed to create new user.');
            return redirect('/admin/users/manage');
        }
    }

    public function manageUser()
    {
        $users = Users::where('added_by', base64_decode($_COOKIE['id']))
            ->where('is_confirmed', "yes")
            ->where('is_admin', "no")
            ->paginate(10);
        return view("pages.manageUser", ["users" => $users]);
    }

    public function editUser($id)
    {
        $users = Users::where('id', $id)
            ->where('added_by', base64_decode($_COOKIE['id']))
            ->first();

        return view("pages.editUser", ['users'=>$users]);
    }

    public function editUserPost(Request $request)
    {
        $this->validate($request, [
            'eid' => 'required',
            'email' => 'required|email',
            'name' => 'required',
        ]);

        $user = Users::where('id', $request->invisible_id)
            ->first();
        $user->name = $request->name;
        $user->employee_id = $request->eid;
        $user->email = $request->email;
        $user->time_created = date("Y-m-d h:i:s");

        if($user->save())
        {
            Flash::success('User details updated successfully.');
            return redirect('/admin/users/manage');
        }
        else
        {
            Flash::error('Failed to update user details.');
            return redirect('/admin/users/manage');
        }
    }

    public function deleteUser($id)
    {
        $users = Users::where('id', $id)
            ->first();
            //->where('added_by', base64_decode($_COOKIE['id']));

        $path = public_path().'/uploads/'.$users->added_by.'/'.$users->id;
        File::deleteDirectory($path);
        if($users->delete())
        {
            Flash::success('User deleted successfully.');
            return redirect('/admin/users/manage');
        }
        else
        {
            Flash::error('Failed to delete the user.');
            return redirect('/admin/users/manage');
        }
    }

}
