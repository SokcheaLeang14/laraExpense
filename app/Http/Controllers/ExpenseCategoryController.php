<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expenses;

class ExpenseCategoryController extends Controller
{
    public function Index()
    {
        $expense_cats = ExpenseCategory::all();
        return view('admin.expense_category.index', compact('expense_cats'));
    }

    public function Transaction(Request $request)
    {
        $expense_cats = ExpenseCategory::all();
        if($_GET['type'] && $_GET['type'] == 'ed'){
            $page_type = $_GET['type'];
            $action_url = url('expense_category/update?code='.$_GET['code']);
            $code = base64_decode($_GET['code']);
            $record = ExpenseCategory::where('id', $code)->first();

        }elseif($_GET['type'] && $_GET['type'] == 'cr'){
            $action_url = url('expense_category/store');
            $page_type = $_GET['type'];
            $record = null;
        }
        
        return view('admin.expense_category.expense_cat_form', compact('record', 'expense_cats', 'page_type', 'action_url'));
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:expense_categories|max:255',
            'image' => 'mimes:jpg,png,jpeg,pfg'
        ]);

        if(isset($request->image) && $request->image !== 'undefined'){
            $file_path = "upload/expense_category/";
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

        ExpenseCategory::insert($data);
        
        return redirect('/expense_categories')->with('status', 'Expense Category Created!');
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
                $file_path = "upload/expense_category/";
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

            ExpenseCategory::where('id', $code)->update($data);

            return redirect('/expense_categories')->with('status', 'Expense Category Updated!');
        }
    }

    public function Destroy(Request $request)
    {
        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);
            $cat_on_expense = Expenses::whereCategoryId($code)->first();

            if($cat_on_income !== null){
                Expenses::whereCategoryId($code)->update(['category_id' => null]);
            }
            $record = ExpenseCategory::where('id', $code)->delete();

            return redirect()->back()->with('status', 'Expense Category Deleted!');
        }
    }
}
