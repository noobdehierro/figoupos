<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CopomexController extends Controller
{
    public function create()
    {

        try {
            $postcode = request('postcode');
            $postcode = trim($postcode);

            $configuration = Configuration::wherein('code', [
                'copomex_token'
            ])->get();

            $response = Http::get('https://api.copomex.com/query/info_cp/' . $postcode . '?token=' . $configuration[0]->value);

            return $response->json();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
