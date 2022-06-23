<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Configuration;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
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
}
