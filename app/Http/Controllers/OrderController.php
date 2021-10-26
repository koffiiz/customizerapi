<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('customer_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $order,
            'message' => 'Order succesfully fetched'
        ]);
    }
}
