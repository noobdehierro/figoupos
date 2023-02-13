<?php

namespace App\Http\Controllers;

use App\Models\Equivalency;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;

class EquivalencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminhtml.equivalencies.index', ['equivalencies'=>Equivalency::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentUser = auth()->user();
        return view('adminhtml.equivalencies.create', ['equivalencies'=>Equivalency::all()]);
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
            'altan_offering_id' => 'required',
        ]);

        try {
            $equivalency = new Equivalency();
            $equivalency->qv_offering_id = $request->qv_offering_id;
            $equivalency->altan_offering_id = $request->altan_offering_id;
            $equivalency->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('equivalencies.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equivalency  $equivalency
     * @return \Illuminate\Http\Response
     */
    public function show(Equivalency $equivalency)
    {
        return $this->edit($equivalency);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equivalency  $equivalency
     * @return \Illuminate\Http\Response
     */
    public function edit(Equivalency $equivalency)
    {
        self::checkPermissions();

        return view('adminhtml.equivalencies.edit', [
            'equivalency' => $equivalency,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equivalency  $equivalency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equivalency $equivalency)
    {
        $request->validate([
            'qv_offering_id' => 'required',
            'altan_offering_id' => 'required'
        ]);

        try {
            $equivalency->qv_offering_id = $request->qv_offering_id;
            $equivalency->altan_offering_id = $request->altan_offering_id;
            $equivalency->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('equivalencies.index')
            ->with('success', 'Ha guardado los cambios.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equivalency  $equivalency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equivalency $equivalency)
    {
        $equivalency->delete();

        return redirect()
            ->route('equivalencies.index')
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
