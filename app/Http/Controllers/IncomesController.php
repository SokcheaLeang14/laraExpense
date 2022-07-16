<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incomes;
use App\Models\IncomeCategory;
use App\Models\Wallets;
use Auth;
class IncomesController extends Controller
{
    public function Index()
    {
        $incomes = Incomes::with('income_category')
        ->with('wallet')
        ->whereHas('wallet', function($query){ return $query->where('user_id', Auth::user()->id); })
        ->get();
        return view('admin.income.index',compact('incomes'));
    }
    public function Transaction(Request $request)
    {

        $wallets = Wallets::select('id', 'name')->get();
        $income_cats = IncomeCategory::select('id','name')->get();

        if($_GET['type'] && $_GET['type'] == 'ed')
        {
            $page_type = $_GET['type'];
            $action_url = url('income/update?code='.$_GET['code']);
            $code = base64_decode($_GET['code']);
            $record = Incomes::where('id', $code)->first();
        }elseif($_GET['type'] && $_GET['type'] == 'cr'){
            $page_type = $_GET['type'];
            $action_url = url('income/store');
            $record = null;
        }

        return view('admin.income.income_form', compact('page_type', 'action_url', 'record', 'wallets', 'income_cats'));
    }

    public function View(Request $request)
    {
        $code = base64_decode($_GET['code']);
        $income = Incomes::where('id', $code)->first();
        return view('admin.income.show',compact('income'));
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

            $data = [
                'name' => $request->name,
                'amount' => $request->amount,
                'wallet_id' => $request->wallet_id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'income_date' => $request->income_date,
                'created_at' => date('Y-m-d h:m:s'),
            ];

            //Get Insert ID
            $income_id = Incomes::insertGetId($data);
    
            if($income_id !== 0)
            {
                Incomes::AddIncomeToWallet($request->amount, $request->wallet_id);
            }
        return redirect('/incomes')->with('status', 'Expense Created!');
    }

    public function Update(Request $request)
    {
        if(isset($_GET['code']))
        {

            $code = base64_decode($_GET['code']);
        
            $request->validate([
                'name' => 'required|max:255',
            ]);

            $data = [
                'name' => $request->name,
                'amount' => $request->amount,
                'wallet_id' => $request->wallet_id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'income_date' => $request->income_date,
                'updated_at' => date('Y-m-d h:m:s'),
            ];

            Incomes::where('id', $code)->update($data);

            return redirect('/incomes')->with('status', 'Expense Updated');
        }
    }

    public function Destroy(Request $request)
    {
        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);
            $income = Incomes::select('amount', 'wallet_id')->where('id', $code)->first();

            if(Incomes::RemoveIncomeFromWallet($income->amount, $income->wallet_id)){
                $record = Incomes::where('id', $code)->delete();
            }

            return redirect()->back()->with('status', 'Expense Deleted!');
        }
    }
}
