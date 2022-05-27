<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Brand;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (
            auth()
                ->user()
                ->can('super')
        ) {
            $balances = Balance::orderBy('id', 'desc')->paginate(10);
            $last = 0;
        } else {
            $balances = Balance::where(
                'brand_id',
                '=',
                auth()->user()->brand->id
            )
                ->orderBy('id', 'desc')
                ->paginate(10);
            $last = Balance::where('brand_id', '=', auth()->user()->brand->id)
                ->latest()
                ->first();
        }

        $current = $last ? $last->balance : 0;

        return view('adminhtml.balances.index', [
            'balances' => $balances,
            'current' => $current
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('adminhtml.balances.create', ['brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable',
            'operation' => 'required'
        ]);

        try {
            $lastBalance = Balance::latest()->first();

            if ($lastBalance) {
                $prevAmount = (float) $lastBalance->balance;
            } else {
                $prevAmount = 0;
            }

            $balance = new Balance();
            $balance->brand_id = $request->brand_id;
            $balance->amount = (float) $request->amount;
            $balance->balance = $prevAmount + (float) $request->amount;
            $balance->operation = $request->operation;
            $balance->description = $request->description;
            $balance->user_id = $request->user_id;
            $balance->user_name = $request->user_name;
            $balance->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('balances.index')
            ->with('success', 'Ha realizado un abono.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {
        //
    }
}
