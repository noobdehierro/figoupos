<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Movement;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $attributes = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'brand_id' => ['required', Rule::exists('brands', 'id')],
            'name' => 'nullable',
            'amount' => 'nullable'
        ]);

        try {
            $attributes['is_active'] = $request->is_active == 'on';
            Account::create($attributes);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Se creo la cuenta correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('adminhtml.accounts.show', ['account' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Account $account)
    {

        return view('adminhtml.accounts.edit', [
            'account' => $account,
            'users' => Account::getUsersByBrand(),
            'brands' => Account::getBrandsByUserBrand(),
            'movements' => Movement::where('account_id', $account->id)->sortable()->get()

        ]);

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
        $attributes = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'brand_id' => ['required', Rule::exists('brands', 'id')],
            'name' => 'nullable',
            'amount' => 'nullable'
        ]);

        try {
            $attributes['is_active'] = $request->is_active == 'on';
            $account->update($attributes);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Se actualizo la cuenta correctamente.');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        try {
            $account->delete();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Se elimino la cuenta correctamente.');
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
