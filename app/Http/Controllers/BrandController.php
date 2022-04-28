<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
        $brands = Brand::paginate(10);

        return view('adminhtml.brands.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminhtml.brands.create');
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->description = $request->description;
            if ($request->logo) {
                $path = $request->file('logo')->store('brands');
                $brand->logo = $path;
            }

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
        return view('adminhtml.brands.edit', ['brand' => $brand]);
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
            $brand->description = $request->description;
            if ($request->logo) {
                $path = $request->file('logo')->store('brands');
                $brand->logo = $path;
            }

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
}
