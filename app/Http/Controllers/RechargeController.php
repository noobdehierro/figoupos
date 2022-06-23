<?php

namespace App\Http\Controllers;

use App\Mail\OrderRecharge;
use App\Models\Balance;
use App\Models\Configuration;
use App\Models\Movement;
use App\Models\Offering;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class RechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $account = auth()->user()->account;

        if ($account) {
            $order = Order::where([
                ['status', '=', 'Pending'],
                ['sales_type', '=', 'Recarga'],
                ['user_id', '=', auth()->user()->id]
            ])->first();

            return view('adminhtml.recharges.index', [
                'order' => $order
            ]);
        } else {
            $order = [];

            return view('adminhtml.recharges.index', [
                'order' => $order
            ])->with(
                'infoMsg',
                'Usted no tiene una cuenta activa para realizar movimientos.'
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     * Retrieve offerings according to a msisdn request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        try {
            $configuration = Configuration::wherein('code', [
                'is_sandbox',
                'qvantel_offering_endpoint',
                'qvantel_offering_endpoint_sandbox'
            ])->get();

            foreach ($configuration as $config) {
                if ($config->code == 'is_sandbox') {
                    $is_sandbox = $config->value;
                }
                if ($config->code == 'qvantel_offering_endpoint') {
                    $endpoint_live = $config->value;
                }
                if ($config->code == 'qvantel_offering_endpoint_sandbox') {
                    $endpoint_sandbox = $config->value;
                }
            }

            $msisdn = '52' . $request->msisdn;
            $offerings = collect([]);

            if ($is_sandbox === 'true') {
                $endpoint = $endpoint_sandbox;
            } else {
                $endpoint = $endpoint_live;
            }

            $response = Http::withHeaders([
                'x-channel' => 'self-service'
            ])->get($endpoint, ['msisdn' => $msisdn]);

            $responseObject = json_decode($response);

            if (isset($responseObject->error)) {
                throw new \Exception(
                    'Sucedio un error al recuperar la información.'
                );
            }

            $response_offerings = json_decode($response)->offerings;

            foreach ($response_offerings as $item) {
                if (!$item->subscriptionOffering) {
                    $offering = new Offering();
                    $offering->qv_offering_id = $item->productId;
                    $offering->name = $item->productName;
                    $offering->description = self::refactorDescription(
                        $item->longDescription
                    );
                    $offering->promotion = $item->shortDescription;
                    $offering->price = $item->prices[0]->taxIncludedAmount;

                    // TODO Identificar marca de oferta
                    $offering->brand_id = 3;

                    $offerings->push($offering);
                }
            }

            $sorted = $offerings->sortBy('price');

            return view('adminhtml.recharges.offerings', [
                'offerings' => $sorted,
                'msisdn' => $request->msisdn
            ]);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $order = new Order();
            $order->status = 'Pending';
            $order->sales_type = 'Recarga';
            $order->user_id = auth()->user()->id;
            $order->user_name = auth()->user()->name;
            $order->qv_offering_id = $request->qv_offering_id;
            $order->msisdn = $request->msisdn;
            $order->brand_id = $request->brand_id;
            $order->brand_name = $request->brand_name;
            $order->channel = 'POS';
            $order->total = $request->total;
            $order->save();
            return redirect()
                ->route('recharges.payment', $order)
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
                ->route('recharges.index')
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
        $balance = Balance::where('brand_id', auth()->user()->primary_brand_id)
            ->latest()
            ->first();

        $conekta_public_key = self::getConektaPublicConfiguration();

        $token = $this->getToken();
        $conekta = [
            'token' => $token->checkout->id,
            'public_key' => $conekta_public_key
        ];

        $openpay = self::getOpenpayPublicConfiguration();

        return view('adminhtml.recharges.payment', [
            'order' => $order,
            'balance' => $balance,
            'conekta' => $conekta,
            'openpay' => $openpay
        ]);
    }

    /**
     * Modify offering's description output format
     *
     * @param $original
     * @return string
     */
    protected function refactorDescription($original)
    {
        $descLines = preg_split("/\r\n|\r|\n/", $original);
        $description = '<ul>';

        foreach ($descLines as $descLine) {
            $description .= $descLine != '' ? '<li>' . $descLine . '</li>' : '';
        }

        $description .= '</ul>';

        return $description;
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
            if ($request->payment_method === 'Efectivo') {
                $lastBalance = Balance::where('brand_id', $order->brand_id)
                    ->latest()
                    ->first();

                $newBalance = new Balance();

                $order->payment_method = $request->payment_method;
                $newBalance->brand_id = $order->brand_id;
                $newBalance->amount = -abs($order->total);
                $newBalance->balance =
                    $lastBalance->balance + $newBalance->amount;
                $newBalance->operation = 'Retiro';
                $newBalance->user_id = $request->user_id;
                $newBalance->user_name = $request->user_name;
                $newBalance->description = 'Recarga';
                $order->status = 'Complete';

                $user = User::find($request->user_id);
                $currentUserAmount = $user->account->amount;
                $newUserAmount = $currentUserAmount + $order->total;
                $user->account->amount = $newUserAmount;

                $movement = new Movement();
                $movement->account_id = $user->account->id;
                $movement->amount = $order->total;
                $movement->description = 'Cobro de efectivo';
                $movement->operation = 'Recarga';

                $order->update();
                $newBalance->save();
                $movement->save();
                $user->account->update();
            } else {
                $configuration = Configuration::wherein('code', [
                    'is_sandbox',
                    'qvantel_baskets_endpoint',
                    'qvantel_baskets_endpoint_sandbox'
                ])->get();

                foreach ($configuration as $config) {
                    if ($config->code == 'is_sandbox') {
                        $is_sandbox = $config->value;
                    }
                    if ($config->code == 'qvantel_baskets_endpoint') {
                        $endpoint_live = $config->value;
                    }
                    if ($config->code == 'qvantel_baskets_endpoint_sandbox') {
                        $endpoint_sandbox = $config->value;
                    }
                }

                if ($is_sandbox === 'true') {
                    $endpoint = $endpoint_sandbox;
                } else {
                    $endpoint = $endpoint_live;
                }

                $basketBody = [
                    'basket' => [
                        'basketItems' => [
                            [
                                'quantity' => 1,
                                'msisdn' => '52' . $order->msisdn,
                                'productId' => $order->qv_offering_id
                            ]
                        ]
                    ]
                ];

                $basket = Http::withHeaders([
                    'x-channel' => 'self-service'
                ])
                    ->withBody(json_encode($basketBody), 'json')
                    ->post($endpoint . 'paymentIntent');

                if ($basket->successful()) {
                    $basketResponse = json_decode($basket);

                    if (!isset($basketResponse->errors)) {
                        $basketId =
                            $basketResponse->basketsPaymentIntent->basketSummary
                                ->basketId;

                        $paymentBody = [
                            'basket' => [
                                'paymentMethod' => [
                                    'paymentMethodType' =>
                                        'openpay-credit-card',
                                    'params' => [
                                        [
                                            'name' => 'deviceSessionId',
                                            'value' => $request->deviceSessionId
                                        ],
                                        [
                                            'name' => 'cardToken',
                                            'value' => $request->cardToken
                                        ],
                                        [
                                            'name' => 'description',
                                            'value' =>
                                                'Recarga ' . $order->brand_name
                                        ]
                                    ]
                                ]
                            ]
                        ];

                        $paymentIntent = Http::withHeaders([
                            'x-channel' => 'self-service'
                        ])
                            ->withBody(json_encode($paymentBody), 'json')
                            ->post($endpoint . $basketId . '/paymentIntent');

                        $paymentResponse = json_decode($paymentIntent);

                        $referenceId =
                            $paymentResponse->basketsPaymentIntent
                                ->basketSummary->referenceNumber;
                        $paymentId =
                            $paymentResponse->basketsPaymentIntent
                                ->paymentIntent->result[0]->value;

                        $order->payment_method = $request->payment_method;
                        $order->payment_id = $paymentId;
                        $order->reference_id = $referenceId;
                        $order->status = 'Complete';

                        $user = User::find($request->user_id);
                        $user->sales_limit = $user->sales_limit - $order->total;

                        $order->update();
                        $user->update();
                    } else {
                        throw new \Exception($basketResponse->error->message);
                    }
                } else {
                    throw new \Exception(
                        'Sucedio un error al recuperar la información.'
                    );
                }

                if (isset($responseObject->error)) {
                    throw new \Exception(
                        'Sucedio un error al recuperar la información.'
                    );
                }
            }
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        self::rechargeNotification($order);

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
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->telephone
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

                    self::rechargeNotification($order);

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
    private function rechargeNotification(Order $order)
    {
        $configuration = Configuration::wherein('code', [
            'notifications_email'
        ])->get();

        $to = $configuration[0]->value;

        Mail::to($to)->send(new OrderRecharge($order));
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

    /**
     * Returns the Openpay public key according to the sandbox configuration
     *
     * @return mixed
     */
    private function getOpenpayPublicConfiguration()
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'openpay_merchant_id_sandbox',
            'openpay_merchant_id',
            'openpay_public_key_sandbox',
            'openpay_public_key'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'openpay_merchant_id_sandbox') {
                $openpay_merchant_id_sandbox = $config->value;
            }
            if ($config->code == 'openpay_merchant_id') {
                $openpay_merchant_id_production = $config->value;
            }
            if ($config->code == 'openpay_public_key_sandbox') {
                $openpay_public_key_sandbox = $config->value;
            }
            if ($config->code == 'openpay_public_key') {
                $openpay_public_key_production = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $openpay_merchant_id = $openpay_merchant_id_sandbox;
            $openpay_public_key = $openpay_public_key_sandbox;
        } else {
            $openpay_merchant_id = $openpay_merchant_id_production;
            $openpay_public_key = $openpay_public_key_production;
        }

        $openpay = [
            'merchant_id' => $openpay_merchant_id,
            'public_key' => $openpay_public_key,
            'is_sandbox' => $is_sandbox
        ];

        return $openpay;
    }
}
