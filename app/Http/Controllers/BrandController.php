<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::getBrandsByUserBrand();

        return view('adminhtml.brands.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $currentUser = auth()->user();
        $brands = Brand::getBrandsByUserBrand(false);
        return view('adminhtml.brands.create', ['brands' => $brands]);
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
            'name' => 'required',
            'parent_id' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->parent_id = $request->parent_id;
            $brand->description = $request->description;
            if ($request->logo) {
                $path = $request->file('logo')->store('brands');
                $brand->logo = $path;
            }
            $brand->is_primary = $request->is_primary == 'on';
            $brand->is_active = $request->is_active == 'on';
            $brand->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('brands.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return $this->edit($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $res= self::checkPermissions($brand);

        if (!$res->allowed()){

            return back()->with('error', 'No tiene permisos para editar esta marca.');

        }

        $currentUser = auth()->user();
        $parents = Brand::getBrandsByUserBrand(false);

        return view('adminhtml.brands.edit', [
            'brand' => $brand,
            'parents' => $parents
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $brand->name = $request->name;
            $brand->parent_id = $request->parent_id ?: $brand->parent_id;
            $brand->description = $request->description;
            if ($request->logo) {
                $path = $request->file('logo')->store('brands');
                $brand->logo = $path;
            }
            $brand->is_primary = $request->is_primary == 'on';
            $brand->is_active = $request->is_active == 'on';
            $brand->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('brands.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()
            ->route('brands.index')
            ->with('success', 'El recuso se elimino con exito.');
    }

    private function checkPermissions($brand)
    {
        $current = auth()->user();

        if (
            $brand->id != $current->brand_id &&
            $brand->parent_id != $current->brand_id
        ) {
            return Response::deny();
        }

        return Response::allow();
    }
}
