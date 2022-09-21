<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallets;
use App\Models\Expenses;
use App\Models\Incomes;
use Auth;

class WalletsController extends Controller
{
    public function Index()
    {  
        $wallets = Wallets::where('user_id', Auth::user()->id)->get();
        return view('admin.wallets.wallets', compact('wallets'));
    }

    public function Transaction(Request $request)
    {
        
        if($_GET['type'] && $_GET['type'] == 'ed'){
            $page_type = $_GET['type'];
            $action_url = url('wallet/update?code='.$_GET['code']);
            $code = base64_decode($_GET['code']);
            $record = Wallets::where('id', $code)->first();

        }elseif($_GET['type'] && $_GET['type'] == 'cr'){
            $action_url = url('wallet/store');
            $page_type = $_GET['type'];
            $record = null;
        }
        
        return view('admin.wallets.wallet_form', compact('record', 'page_type', 'action_url'));
    }

    public function View(Request $request)
    {

        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);
            $wallet = Wallets::find($code);
        }
        return view('admin.wallets.wallet_show', compact('wallet'));
    }
    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'currency_symbol' => $request->currency_symbol,
            'created_at' => date('Y-m-d h:m:s')
        ];

        Wallets::insert($data);
        
        return redirect('/wallets')->with('status', 'Wallet Created!');
    }

    public function Update(Request $request)
    {
        if(isset($_GET['code']))
        {
            $code = base64_decode($_GET['code']);

            $data  = [
                'name' => $request->name,
                'description' => $request->description,
                'currency_symbol' => $request->currency_symbol,
                'updated_at' => date('Y-m-d h:m:s')
            ];

            $record = Wallets::where('id', $code)->update($data);

            return redirect('/wallets')->with('status', 'Wallet Updated!');
        }
    }

    public function Destroy(Request $request)
    {
        try{
            if(isset($_GET['code']))
            {
                $code = base64_decode($_GET['code']);

                Incomes::whereWalletId($code)->update(['wallet_id' => null]);
                Expenses::whereWalletId($code)->update(['wallet_id' => null]);
                $record =  Wallets::where('id', $code)->delete();

                return redirect()->back()->with('status', 'Wallets Deleted!');
            }
        }
        catch(Exception $e){
            throw $e->message;
        }
        
    }
}
