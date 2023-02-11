<?php

namespace App\Http\Controllers;

use App\Models\Offering;
use App\Models\Brand;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class OfferingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $offerings = Offering::getOfferingsByUserBrand();

        return view('adminhtml.offerings.index', ['offerings' => $offerings]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function offerings()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::checkPermissions();
        $brands = Brand::all();

        return view('adminhtml.offerings.create', ['brands' => $brands]);
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
            'qv_offering_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'promotion' => 'nullable',
            'price' => 'required|numeric',
            'seller_price' => 'required|numeric',
            'brand_id' => 'required'
        ]);

        try {
            $offering = new Offering();
            $offering->qv_offering_id = $request->qv_offering_id;
            $offering->name = $request->name;
            $offering->description = $request->description;
            $offering->promotion = $request->promotion;
            $offering->price = $request->price;
            $offering->seller_price = $request->seller_price;
            $offering->brand_id = $request->brand_id;
            $offering->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('offerings.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function show(Offering $offering)
    {
        return $this->edit($offering);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function edit(Offering $offering)
    {
        self::checkPermissions();

        $brands = Brand::all();

        return view('adminhtml.offerings.edit', [
            'offering' => $offering,
            'brands' => $brands
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offering $offering)
    {
        $request->validate([
            'qv_offering_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'promotion' => 'nullable',
            'price' => 'required|numeric',
            'seller_price' => 'required|numeric',
            'brand_id' => 'required'
        ]);

        try {
            $offering->qv_offering_id = $request->qv_offering_id;
            $offering->name = $request->name;
            $offering->description = $request->description;
            $offering->promotion = $request->promotion;
            $offering->price = $request->price;
            $offering->seller_price = $request->seller_price;
            $offering->brand_id = $request->brand_id;
            $offering->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('offerings.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offering $offering)
    {
        $offering->delete();

        return redirect()
            ->route('offerings.index')
            ->with('success', 'El recuso se elimino con exito.');
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
