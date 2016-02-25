<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Crypt;
use Hash;
use Mail;
use Session;
use Flash;
use Image;
use Curl;
use JavaScript;

use Illuminate\Support\Facades\Input;
use App\Users;
use App\Categories;

class userPagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkUserSession');
    }

    public function home()
    {
            return view("pages.user.userHome");
    }

    public function uploads()
    {
            $users = Users::where('id', Session::get('id'))
                ->first();
            $categories = Categories::where('added_by', $users->added_by)
                ->where('is_enabled', "yes")
                ->get();
            return view("pages.user.uploads", ["categories" => $categories]);
    }

    public function types(Request $request)
    {
            $users = Users::where('id', Session::get('id'))
                ->first();
            $category = Categories::where('id', base64_decode($request->category))
                ->where('added_by', $users->added_by)
                ->where('is_enabled', "yes")
                ->first();
            return view("pages.user.types", ["category" => $category]);
    }

    public function typesPost(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,png,jpeg',
            'bill_type'   => 'required',
        ]);
        $users = Users::where('id', Session::get('id'))
            ->first();
        if (Input::hasFile('image')) {
            $file            = Input::file('image');
            $destinationPath = public_path().'/images/uploads/'.$users->added_by.'/'.$users->id;
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
        }
        if($uploadSuccess)
        {
            if($request->bill_type == "thermal")
            {
                $json = file_get_contents('http://1000lookz.com:40001/bills/thermal?url=http://www.1000lookz.com/demo/sample/bills/thermal/2.jpg&isProcess=True&Range=10&Diff=10');
                $obj = json_decode($json);
            }
            else if($request->bill_type == "invoice")
            {

                $json = file_get_contents('http://1000lookz.com:40001/bills/invoices?url=http://www.1000lookz.com/demo/sample/bills/invoices/3invoice.png&isProcess=True&Range=10&Diff=10');
                $obj = json_decode($json);
            }
            else if($request->bill_type == "texture")
            {
                $json = file_get_contents('http://1000lookz.com:40001/bills/coloured?url=http://www.1000lookz.com/demo/sample/bills/color/1color.jpg&isProcess=True&Range=5&Diff=5');
                $obj = json_decode($json);
            }
            else if($request->bill_type == "cheque")
            {
                $data = (string) Image::make($destinationPath.'/'.$filename)->fit(600, 600)->encode('data-url');
                $ripped_data = preg_replace('#^data:image/[^;]+;base64,#', '', $data);
                $response = Curl::to('http://192.168.0.117:5000/test')
                    ->withData( array('data' => $ripped_data) )
                    ->asJson()
                    ->post();

                if(!empty($response->out))
                {
                    JavaScript::put([
                        'img_data' => $response->out,
                    ]);
                }
                /*$json = file_get_contents('http://192.168.0.117:5000/test?url=https://s3-ap-southeast-1.amazonaws.com/try1000looks.com/user_uploaded_pics/rotated.jpg');
                $obj = json_decode($json);*/
                return view("pages.user.chequeProcess", ["json_res" => $response]);
            }
            return view("pages.user.displayResult", ["json_res" => $obj]);
        }
        else
        {
            return "Upload Failed";
        }
    }

    public function croppedCheque(Request $request)
    {
        $response = Curl::to('http://192.168.0.117:5000/receive')
            ->withData( array('data' => $request->response) )
            ->asJson()
            ->post();
        dd($response);
    }
}
