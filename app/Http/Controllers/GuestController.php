<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guest.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('guest.show', compact('user'));
    }

    public function restaurants(){
        return view('guest.restaurants');
    }

    // public function checkout(Request $request)
    // {

    //     $amount = $request->total;
    //     $nonce = $request->nonce;
    //     $customerName = $request->customerName;

    //     $gateway = new \Braintree\Gateway([
    //         'environment' => env('BRAINTREE_ENV'),
    //         'merchantId' => env('BRAINTREE_MERCHANT_ID'),
    //         'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
    //         'privateKey' => env('BRAINTREE_PRIVATE_KEY')
    //     ]);

    //     $result = $gateway->transaction()->sale([
    //         'amount' => $amount,
    //         'paymentMethodNonce' => $nonce,
    //         'customer' => [
    //             'firstName' => $customerName,
    //         ],
    //     ]);

    //     if($result->success) {
    //         $transaction = $result->transaction;

    //         $order = new Order();
    //         // ...
    //         $order->save();

    //         // seleziona l'ordine corrente
    //         $currentOrder = Order::find($order->id);
    //         $currentOrder->dishes()->attach($request->dishIdsArray);

    //         return response()->json(['message' => 'Transazione andata a buon fine. Controlla la tua mail per il riepilogo. ID: ' . $transaction->id,]);
    //     } else {
    //         return response()->json(['message' => 'Transazione non andata a buon fine.']);
    //     };
        
    // }
}
