<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Configuration;
use App\Models\Offering;
use App\Models\Order;
use App\Models\Portability;
use App\Models\User;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $offerings = Offering::all();

        try {
            $order = Order::where([
                ['status', '=', 'Pending'],
                ['sales_type', '=', 'Contratación'],
                ['user_id', '=', auth()->user()->id]
            ])->first();

            return view('adminhtml.purchase.index', [
                'offerings' => $offerings,
                'order' => $order
            ]);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Offering $offering)
    {
        return view('adminhtml.purchase.create', ['offering' => $offering]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request);

        $attributes = $request->validate([
            'status' => 'required',
            'sales_type' => 'required',
            'user_id' => 'nullable',
            'user_name' => 'required',
            'qv_offering_id' => 'required',
            'brand_name' => 'required',
            'total' => 'required',
            'channel' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'birday' => 'nullable',
            'iccid' => 'nullable',
            'imei' => 'nullable',
            'street' => 'required',
            'outdoor' => 'required',
            'indoor' => 'nullable',
            'references' => 'required',
            'postcode' => 'required',
            'suburb' => 'required',
            'city' => 'required',
            'region' => 'required'
        ]);

        if ($request->portabilidad === 'on') {
            $portability_attributes = $request->validate([
                'fullname' => 'nullable',
                'email' => 'nullable',
                'nip' => 'required|numeric',
                'msisdn' => 'required',
                'msisdn_temp' => 'required',
                'iccid' => 'nullable'
            ]);

            $portability_attributes['fullname'] =
                $request->name . ' ' . $request->lastname;
            $portability_attributes['email'] = $request->email;
            $portability_attributes['iccid'] = $request->iccid;
        }

        try {
            $attributes['user_id'] = auth()->user()->id;
            $order = Order::create($attributes);
            if ($request->portabilidad === 'on') {
                Portability::create($portability_attributes);
            }
            return redirect()
                ->route('purchase.payment', $order)
                ->with(
                    'warning',
                    'Se ha registrado la información correctamente.'
                );
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function update(Order $order)
    {
        try {
            $order->status = 'Canceled';
            $order->update();

            return redirect()
                ->route('purchase.index')
                ->with(
                    'success',
                    'Ha cancelado la orden exitosamente, ahora puede continuar con la creación de una nueva.'
                );
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function payment(Order $order)
    {
        $balance = Balance::latest()->first();

        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'conekta_public_api_key_sandbox',
            'conekta_public_api_key'
        ])->get();

        $is_sandbox = $configuration[0]->value;

        if ($is_sandbox === 'true') {
            $conekta_public_key = $configuration[1]->value;
        } else {
            $conekta_public_key = $configuration[2]->value;
        }

        return view('adminhtml.purchase.payment', [
            'order' => $order,
            'balance' => $balance,
            'conekta_public_key' => $conekta_public_key
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);

        try {
            $lastBalance = Balance::latest()->first();
            $newBalance = new Balance();

            $order->payment_method = $request->payment_method;

            if ($order->payment_method == 'Efectivo') {
                $newBalance->amount = -abs($order->total);
                $newBalance->balance =
                    $lastBalance->balance + $newBalance->amount;
                $newBalance->operation = 'Retiro';
                $newBalance->user_id = $request->user_id;
                $newBalance->user_name = $request->user_name;
                $newBalance->description = 'Contratación';
                $order->status = 'Completado';
            }

            $user = User::find($request->user_id);
            $user->sales_limit = $user->sales_limit - $order->total;

            $order->save();
            $newBalance->save();
            $user->save();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('orders.index')
            ->with('success', 'Se realizo el pago con exito.');
    }
}
