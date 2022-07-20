<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\ExpenseCategory;
use App\Models\Wallets;
use Auth;
class ExpensesController extends Controller
{
    public function Index()
    {
        $expenses = Expenses::with('expense_category')
            ->with('wallet')
            ->whereHas('wallet', function ($query){ return $query->where('user_id', Auth::user()->id); })
            ->orderBy('id','DESC')
            ->get();
        return view('admin.expense.index', compact('expenses'));
    }

    public function Transaction(Request $request)
    {

        $wallets = Wallets::where('user_id', Auth::user()->id)
            ->select('id', 'name')
            ->get();
        $expense_cats = ExpenseCategory::select('id','name')->get();

        if($_GET['type'] && $_GET['type'] == 'ed')
        {
            $page_type = $_GET['type'];
            $action_url = url('expense/update?code='.$_GET['code']);
            $code = base64_decode($_GET['code']);
            $record = Expenses::where('id', $code)->first();
        }elseif($_GET['type'] && $_GET['type'] == 'cr'){
            $page_type = $_GET['type'];
            $action_url = url('expense/store');
            $record = null;
        }

        return view('admin.expense.expense_form', compact('page_type', 'action_url', 'record', 'wallets', 'expense_cats'));
    }

    public function View(Request $request)
    {
        $code = base64_decode($_GET['code']);
        $expense = Expenses::where('id', $code)->first();
        return view('admin.expense.show',compact('expense'));
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'mimes:jpg,png,jpeg,pfg'
        ]);

        //Check If there image
        if(isset($request->image) && $request->image !== 'undefined'){
            $file_path = "upload/expense/";
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
            'amount' => $request->amount,
            'wallet_id' => $request->wallet_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'expense_date' => $request->expense_date,
            'image' => $fileName,
            'created_at' => date('Y-m-d h:m:s'),
        ];
        //Insert
        $expense_id = Expenses::insertGetId($data);
        if($expense_id !== 0){
            Expenses::AddExpenseToWallet($request->amount, $request->wallet_id);
        }
        return redirect('/expenses')->with('status', 'Expense Created!');
    }

    public function Update(Request $request)
    {
        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);
            $cur_expense = Expenses::find($code, ['image','image']);

            $request->validate([
                'name' => 'required|max:255',
                'image' => 'mimes:jpg,png,jpeg,pfg'
            ]);

            //Check If there image
            if(isset($request->image) && $request->image !== 'undefined'){
                $file_path = "upload/expense/";
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
                'amount' => $request->amount,
                'wallet_id' => $request->wallet_id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'expense_date' => $request->expense_date,
                'image' => $fileName,
                'updated_at' => date('Y-m-d h:m:s'),
            ];

            $update = Expenses::where('id', $code)->update($data);

            return redirect('/expenses')->with('status', 'Expense Updated');
        }
    }

    public function Destroy(Request $request)
    {
        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);
            $expense = Expenses::select('amount', 'wallet_id')->where('id', $code)->first();
            
            if(Expeses::RemoveExpenseFromWallet($expense->amount, $expense->wallet_id)){
                $record = Expenses::where('id', $code)->delete();
            }

            return redirect()->back()->with('status', 'Expense Deleted!');
        }
    }
}
