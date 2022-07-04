<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\Movements;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::getAccountsByUserBrand();

        return view('adminhtml.accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $users = Account::getUsersByBrand();
        $brands = Account::getBrandsByUserBrand();

        return view('adminhtml.accounts.create', [
            'brands' => $brands,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_id' => ['required', Rule::exists('accounts', 'id')],
            'amount' => 'required'
        ]);
        $date = date('Y-m-d H:i:s');
        $account_id = $request->user_id;
        DB::table('movements')->insert([
            'account_id' => $request->account_id,
            'amount' => $request->amount,
            'description' => 'Corte de caja',
            'operation' => 'Abono',
            'created_at' => $date,
            'updated_at' => $date
        ]);
        return redirect()
            ->route('accounts.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $movements = DB::table('movements')
            ->where('account_id', '=', $account->id)
            ->get();
        return view('adminhtml.accounts.show', ['movements' => $movements]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
    }

    private function checkPermissions()
    {
        if (
            !auth()
                ->user()
                ->can('super')
        ) {
            abort(403);
        }

        return Response::allow();
    }
}
