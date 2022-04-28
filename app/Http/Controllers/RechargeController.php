<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Configuration;
use App\Models\Offering;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::where([
            ['status', '=', 'Pending'],
            ['sales_type', '=', 'Recarga'],
            ['user_id', '=', auth()->user()->id]
        ])->first();

        return view('adminhtml.recharges.index', [
            'order' => $order
        ]);
    }

    public function create(Request $request)
    {
        try {
            $configuration = Configuration::wherein('code', [
                'is_sandbox',
                'qvantel_offering_endpoint',
                'qvantel_offering_endpoint_sandbox'
            ])->get();

            $is_sandbox = $configuration[0]->value;
            $msisdn = '52' . $request->msisdn;
            $offerings = collect([]);

            if ($is_sandbox === 'true') {
                $endpoint = $configuration[2]->value;
            } else {
                $endpoint = $configuration[1]->value;
            }

            $response = Http::withHeaders([
                'x-channel' => 'self-service'
            ])->get($endpoint, ['msisdn' => $msisdn]);

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
}
