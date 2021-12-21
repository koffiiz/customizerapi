<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function edit (Request $request) {
        $id = $request->get('id');
        $path = $request->file('file')->store('public/waveformAudio');
        $realPath = config('app.url')."/".str_replace("public",'storage', $path);
        $order = Order::where('id', $id)->first();
        $order->waveform_file_url = $realPath;

        if($order->save())
        {
            return response()->json([
                'success' => true,
                'message' => 'Succesfully Updated the Audio / Video of the waveform'
            ], 200);
        }

    }
}
