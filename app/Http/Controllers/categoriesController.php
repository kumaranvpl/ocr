<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Crypt;
use Hash;
use Flash;
use Session;
use Illuminate\Support\Facades\Input;

use App\Users;
use App\Categories;
use App\Fields;

class categoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdminSession');
    }

    /*public function addCategory()
    {
        if(Session::has('admin') && (Session::get('admin')=="yes"))
        {
            return view("pages.addCategory");
        }
        else { return redirect('/login');}
    }

    public function addCategoryPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'fields' => 'required',
            'tags' => 'required',
        ]);

        $admin = Users::where('id', Session::get('id'))
            ->first();

        $category = New Categories();
        $category->category_name = $request->name;
        $category->fields_needed = $request->fields;
        $category->tags = $request->tags;
        $category->added_by = $admin->id;

        if($category->save())
        {
            return view("pages.msg", ['title'=>'Success', 'msg'=>'New category added successfully. View it in manage category page.']);
        }
        else
        {
            return view("pages.msg", ['title'=>'Failed', 'msg'=>'Failed to create new category']);
        }
    }*/

    public function manageCategory()
    {
        $categories = Categories::where('added_by', Session::get('id'))
            ->paginate(10);
        return view("pages.manageCategory", ["categories" => $categories]);
    }

    public function editCategory($id)
    {
        $fields = Fields::lists('name', 'id');
        $categories = Categories::where('id', $id)
            ->where('added_by', Session::get('id'))
            ->first();

        return view("pages.editCategory", ['categories'=>$categories, 'fields'=>$fields]);
    }

    public function editCategoryPost(Request $request)
    {
        $this->validate($request, [
            'fields' => 'required',
            //'tags' => 'required',
        ]);

        //dd($request->input('fields'));

        $category = Categories::where('id', $request->invisible_id)
            ->first();
        //$category->tags = $request->tags;
        $category->time_created = date("Y-m-d h:i:s");

        if($category->save())
        {
            $category->fields()->sync($request->input('fields'));
            Flash::success('Category values updated successfully.');
            return redirect('/admin/categories/manage');
        }
        else
        {
            Flash::error('Failed to update category values.');
            return redirect('/admin/categories/manage');
        }
    }

    public function updateCategoryPost()
    {
        $categories = Categories::where('added_by', Session::get('id'))->get();
        $data = Input::get('enabled');
        foreach($categories as $category)
        {
            if(in_array($category->id, $data))
            {
                $category->is_enabled = "yes";
                $category->save();
            }
            else
            {
                $category->is_enabled = "no";
                $category->save();
            }
        }

        Flash::success('Category preferences updated successfully.');
        return redirect('/admin/categories/manage');
    }

    /*public function deleteCategory($id)
    {
        if(Session::has('admin') && (Session::get('admin')=="yes"))
        {
            $categories = Categories::where('id', $id)
                ->where('added_by', Session::get('id'));
            if($categories->delete())
            {
                return view("pages.msg", ['title'=>'Success', 'msg'=>'Category deleted successfully. ']);
            }
            else
            {
                return view("pages.msg", ['title'=>'Failed', 'msg'=>'Failed to delete the category']);
            }
        }
        else { return redirect('/login');}
    }*/

}
