<?php

namespace App\Http\Controllers;

use App\Models\Portability;
use Illuminate\Http\Request;

class PortabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $portabilities = Portability::paginate(25);

        return view('adminhtml.tools.portability.index', [
            'portabilities' => $portabilities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminhtml.tools.portability.create');
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
            'fullname' => 'required',
            'email' => 'required|email',
            'nip' => 'required|numeric',
            'msisdn' => 'required',
            'msisdn_temp' => 'required',
            'iccid' => 'required'
        ]);

        try {
            Portability::create($attributes);

            return redirect()
                ->route('portability.index')
                ->with('success', 'La solicitud se creo con exito.');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portability  $portability
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Portability $portability)
    {
        return view('adminhtml.tools.portability.show', [
            'portability' => $portability
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portability  $portability
     * @return \Illuminate\Http\Response
     */
    public function edit(Portability $portability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portability  $portability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portability $portability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portability  $portability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portability $portability)
    {
        //
    }
}
