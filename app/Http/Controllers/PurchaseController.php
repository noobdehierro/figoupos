<?php

namespace App\Http\Controllers;

use App\Mail\OrderPurchase;
use App\Mail\PortabilityRequest;
use App\Models\Balance;
use App\Models\Configuration;
use App\Models\Offering;
use App\Models\Order;
use App\Models\Portability;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    /**
     * Return a list of offerings to initiate the purchase process
     *
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
                $portability = Portability::create($portability_attributes);

                self::portabilityNotification($portability);
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

    /**
     * Cancel an order
     *
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
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
     * Show the payment form for a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function payment(Order $order)
    {
        $balance = Balance::latest()->first();

        $conekta_public_key = self::getConektaPublicConfiguration();

        $token = $this->getToken();
        $conekta = [
            'token' => $token->checkout->id,
            'public_key' => $conekta_public_key
        ];

        return view('adminhtml.purchase.payment', [
            'order' => $order,
            'balance' => $balance,
            'conekta' => $conekta
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Confirm cash payment
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
                $order->status = 'Complete';
            }

            $user = User::find($request->user_id);
            $user->sales_limit = $user->sales_limit - $order->total;

            $order->update();
            $newBalance->update();
            $user->update();

            self::purchaseNotification($order);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('orders.index')
            ->with('success', 'Se realizo el pago con exito.');
    }

    /**
     * Conekta credit card payment intent, create a new Conekta order.
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function conektaOrder(Request $request, Order $order)
    {
        $conekta_private_key = self::getConektaConfiguration();

        $conektaData = [
            'amount' => floatval($order->total) * 100,
            'currency' => 'MXN',
            'amount_refunded' => 0,
            'customer_info' => [
                'name' => $order->name,
                'email' => $order->email,
                'phone' => $order->telephone
            ],
            'shipping_contact' => [
                'receiver' => $order->name,
                'phone' => $order->telephone,
                'between_streets' => $order->references,
                'address' => [
                    'street1' =>
                        $order->street .
                        ' ' .
                        $order->outdor .
                        ' ' .
                        $order->indoor .
                        ' ' .
                        $order->suburb,
                    'city' => $order->city,
                    'state' => $order->region,
                    'country' => 'mx',
                    'object' => 'shipping_address',
                    'postal_code' => $order->postcode
                ]
            ],
            'metadata' => [
                'Integration' => 'API',
                'Integration_Type' => 'PHP 7.4'
            ],
            'line_items' => [
                [
                    'name' => 'Contratación Plan',
                    'unit_price' => floatval($order->total) * 100,
                    'quantity' => 1,
                    'description' => 'Plan ' . $order->brand_name,
                    'sku' => $order->qv_offering_id,
                    'brand' => $order->brand_name
                ]
            ],
            'charges' => [
                [
                    'payment_method' => [
                        'type' => 'card',
                        'token_id' => $request->token
                    ]
                ]
            ]
        ];

        try {
            $response = Http::withToken($conekta_private_key)
                ->withHeaders([
                    'Accept' => 'application/vnd.conekta-v2.0.0+json',
                    'Content-Type' => 'application/json'
                ])
                ->withBody(json_encode($conektaData), 'json')
                ->post('https://api.conekta.io/orders');

            $conektaOrder = json_decode($response);

            if (
                isset($conektaOrder->object) &&
                $conektaOrder->object === 'error'
            ) {
                return back()->with(
                    'error',
                    $conektaOrder->details[0]->message
                );
            } else {
                if (isset($conektaOrder->id)) {
                    $order->payment_method = 'Tarjeta de crédito';
                    $order->payment_id = $conektaOrder->id;
                    $order->status = 'Complete';

                    $user = auth()->user();
                    $user->sales_limit = $user->sales_limit - $order->total;

                    $order->update();
                    $user->update();

                    self::purchaseNotification($order);

                    return redirect()
                        ->route('orders.index')
                        ->with('success', 'Se realizo el pago con exito.');
                }
            }
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Get Conekta token
     *
     * @return mixed|void
     */
    public function getToken()
    {
        $conekta_private_key = self::getConektaConfiguration();

        try {
            $data = [
                'checkout' => [
                    'returns_control_on' => 'Token'
                ]
            ];

            $response = Http::withToken($conekta_private_key)
                ->withHeaders([
                    'Accept' => 'application/vnd.conekta-v2.0.0+json',
                    'Content-Type' => 'application/json'
                ])
                ->withBody(json_encode($data), 'json')
                ->post('https://api.conekta.io/tokens');

            return json_decode($response->body());
        } catch (\Exception $exception) {
        }
    }

    /**
     * Notification for a new order
     *
     * @param Order $order
     * @return void
     */
    private function purchaseNotification(Order $order)
    {
        $configuration = Configuration::wherein('code', [
            'notifications_email'
        ])->get();

        $to = $configuration[0]->value;

        Mail::to($to)->send(new OrderPurchase($order));
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

    /**
     * Returns the Conekta private key according to the sandbox configuration
     *
     * @return mixed
     */
    private function getConektaConfiguration()
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'conekta_private_api_key_sandbox',
            'conekta_private_api_key'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'conekta_private_api_key_sandbox') {
                $conekta_private_api_key_sandbox = $config->value;
            }
            if ($config->code == 'conekta_private_api_key') {
                $conekta_private_api_key = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $conekta_private_key = $conekta_private_api_key_sandbox;
        } else {
            $conekta_private_key = $conekta_private_api_key;
        }

        return $conekta_private_key;
    }

    /**
     * Returns the Conekta public key according to the sandbox configuration
     *
     * @return mixed
     */
    private function getConektaPublicConfiguration()
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'conekta_public_api_key_sandbox',
            'conekta_public_api_key'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'conekta_public_api_key_sandbox') {
                $conekta_public_api_key_sandbox = $config->value;
            }
            if ($config->code == 'conekta_public_api_key') {
                $conekta_public_api_key = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $conekta_public_key = $conekta_public_api_key_sandbox;
        } else {
            $conekta_public_key = $conekta_public_api_key;
        }

        return $conekta_public_key;
    }
}
