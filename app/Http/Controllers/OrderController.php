<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Session;

class OrderController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrder( Request $request, \App\Order $order) {
        Validator::make($request->all(), [
            'client_email' => 'required|email',
            'partner_id' => 'required',
            'status' => 'required',
        ])->validate();
        
        $input = $request->all();

        $order->update([
            'client_email' => $input['client_email'],
            'partner_id' => $input['partner_id'],
            'status' => $input['status'],
        ]);

        Session::flash('order_saved', true);
        return Redirect::to('orders');
    }
}
