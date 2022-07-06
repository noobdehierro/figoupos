<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Balance;
use App\Models\Movement;
use Illuminate\Support\Facades\DB;

class CashClosingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::getAccountsByUserBrand();

        return view('adminhtml.cashclosings.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {

        $movements = Movement::where('account_id', $id)->get();

        $account = Account::find($id);


        return view('adminhtml.cashclosings.show', ['movements' => $movements, 'account' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('adminhtml.cashclosings.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $account = Account::find($id);


        try {
            $lastBalance = Balance::latest()->first();
            if ($lastBalance) {
                $prevAmount = (float) $lastBalance->balance;
            } else {
                $prevAmount = 0;
            }

            $balance = new Balance();
            $balance->brand_id = $account->brand_id;
            $balance->amount = (float) $request->amount;
            $balance->balance = $prevAmount + (float) $request->amount;
            $balance->operation = 'Cierre de caja';
            $balance->description = 'Cierre de caja';
            $balance->user_id = $account->user_id;
            $balance->user_name = $account->user->name;

            $currentUserAmount = (float) $account->amount;
            $newUserAmount = $currentUserAmount - (float) $request->amount;
            $account->amount = $newUserAmount;

            $movement = new Movement();
            $movement->account_id = $id;
            $movement->amount = (float) $request->amount;
            $movement->description = 'Cierre de caja';
            $movement->operation = 'Cierre de caja';

            $balance->save();
            $movement->save();
            $account->update();


        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('cashClosings.index', ['id' => $id])
            ->with('success', 'Cierre de caja realizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
