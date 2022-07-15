<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Models\Incomes;

class IncomeCategoryController extends Controller
{
    public function Index()
    {
        $income_cats = IncomeCategory::all();
        return view('admin.income_category.index', compact('income_cats'));
    }

    public function Transaction(Request $request)
    {
        $income_cats = IncomeCategory::all();
        if($_GET['type'] && $_GET['type'] == 'ed'){
            $page_type = $_GET['type'];
            $action_url = url('income_category/update?code='.$_GET['code']);
            $code = base64_decode($_GET['code']);
            $record = IncomeCategory::where('id', $code)->first();

        }elseif($_GET['type'] && $_GET['type'] == 'cr'){
            $action_url = url('income_category/store');
            $page_type = $_GET['type'];
            $record = null;
        }
        
        return view('admin.income_category.income_cat_form', compact('record', 'income_cats', 'page_type', 'action_url'));
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:income_categories|max:255',
            'image' => 'mimes:jpg,png,jpeg,pfg'
        ]);

        if(isset($request->image) && $request->image !== 'undefined'){
            $file_path = "upload/income_category/";
            if(!file_exists($file_path)) mkdir($file_path, 0777, true);
            $file = $request->file('image');
            $fileName = $file->hashName();
            $extension = $file->extension();
            $upload = $file->move($file_path, $fileName);
        }
        else{
            $fileName = '';
        }

        $data = [
            'name' => $request->name,
            'category_parent' => $request->category_parent,
            'image' => $fileName,
            'created_at' => date('Y-m-d h:m:s'),
        ];

        IncomeCategory::insert($data);
        
        return redirect('/income_categories')->with('status', 'Income Category Created!');
    }

    public function Update(Request $request)
    {
        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);

            $request->validate([
                'name' => 'required|max:255',
                'image' => 'mimes:jpg,png,jpeg,pfg'
            ]);

            if(isset($request->image) && $request->image !== 'undefined'){
                $file_path = "upload/income_category/";
                if(!file_exists($file_path)) mkdir($file_path, 0777, true);
                $file = $request->file('image');
                $fileName = $file->hashName();
                $extension = $file->extension();
                $upload = $file->move($file_path, $fileName);
            }
            else{
                $fileName = $request->current_image;
            }

            $data = [
                'name' => $request->name,
                'category_parent' => $request->category_parent,
                'image' => $fileName,
                'updated_at' => date('Y-m-d h:m:s'),
            ];

            IncomeCategory::where('id', $code)->update($data);

            return redirect('/income_categories')->with('status', 'income Category Updated!');
        }
    }

    public function Destroy(Request $request)
    {
        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);
            $cat_on_income = Incomes::whereCategoryId($code)->first();

            if($cat_on_income !== null){
                Incomes::whereCategoryId($code)->update(['category_id' => null]);
            }
            $record = IncomeCategory::where('id', $code)->delete();

            return redirect()->back()->with('status', 'Income Category Deleted!');
        }
    }
}
