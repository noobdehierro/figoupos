<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('adminhtml.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $roles = Role::all();

        return view('adminhtml.users.create', [
            'brands' => $brands,
            'roles' => $roles
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
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'brand_id' => ['nullable', Rule::exists('brands', 'id')],
            'name' => ['required', 'string', 'max:225'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'sales_limit' => ['nullable', 'numeric'],
            'is_active' => ['nullable', 'in:on,off']
        ]);

        try {
            $attributes['password'] = Hash::make($request->password);
            $attributes['is_active'] = $request->is_active == 'on';

            User::create($attributes);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'Se creo el usuario correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $brands = Brand::all();
        $roles = Role::all();

        return view('adminhtml.users.edit', [
            'user' => $user,
            'brands' => $brands,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'role_id' => ['nullable', Rule::exists('roles', 'id')],
            'brand_id' => ['nullable', Rule::exists('brands', 'id')],
            'name' => ['required', 'string', 'max:225'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'sales_limit' => ['nullable', 'numeric'],
            'is_active' => ['nullable', 'in:on,off']
        ]);

        try {
            $attributes['password'] = $request->password
                ? Hash::make($request->password)
                : $user->password;
            $attributes['is_active'] = $request->is_active == 'on';

            $user->update($attributes);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if ($user->id != 1 && $user->id != auth()->user()->id) {
            try {
                $user->delete();
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }

            return redirect()
                ->route('users.index')
                ->with('success', 'El recuso se elimino con exito.');
        } else {
            return redirect()
                ->route('users.index')
                ->with(
                    'error',
                    'El usuario que intenta borrar es un usuario restringido.'
                );
        }
    }

    public function profile(User $user)
    {
        return view('adminhtml.users.profile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:225'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()]
        ]);

        try {
            $attributes['password'] = $request->password
                ? Hash::make($request->password)
                : $user->password;

            $user->update($attributes);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', 'Ha guardado los cambios.');
    }
}
