<?php

namespace App\Http\Controllers;

use App\Mail\PortabilityRequest;
use App\Models\Configuration;
use App\Models\Portability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PortabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $portabilities = Portability::sortable()->paginate(25);

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
            $portability = Portability::create($attributes);

            self::portabilityNotification($portability);

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

    /**
     * Notification for a new portability request
     *
     * @param Portability $portability
     * @return void
     */
    private function portabilityNotification(Portability $portability)
    {
        $configuration = Configuration::wherein('code', [
            'notifications_email'
        ])->get();

        $to = $configuration[0]->value;

        Mail::to($to)->send(new PortabilityRequest($portability));
    }
}
