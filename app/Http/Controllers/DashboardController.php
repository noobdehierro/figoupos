<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id <= 2) {
            $orders = Order::latest()
                ->take(10)
                ->get();
        } else {
            $orders = Order::where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(5);
        }

        if ($user->role_id <= 2) {
            $orders = Order::latest()
                ->take(10)
                ->get();
        } else {
            $orders = Order::where('user_id', auth()->user()->id)
                ->latest()
                ->take(10)
                ->get();
        }

        $complete = Order::where('status', 'Complete')->count();
        $pending = Order::where('status', 'Pending')->count();
        $canceled = Order::where('status', 'Canceled')->count();
        $total = Order::count();

        return view('adminhtml.dashboard', [
            'orders' => $orders,
            'complete' => $complete,
            'pending' => $pending,
            'candeled' => $canceled,
            'total' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
