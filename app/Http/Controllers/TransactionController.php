<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function __construct(Transaction $transaction, DetailTransaction $detail_transaction)
    {
        $this->transaction = $transaction;
        $this->detail_transaction = $detail_transaction;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->get('cart');
        $transactions = $this->transaction->with(['user', 'detail.smartphone.brand', 'store'])
                                        ->where('user_id', auth()->user()->id)
                                        ->get();
        // dd($transactions);
        return view('web.transaction.index', compact('cart', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = session()->get('cart');
        // dd($cart);
        $transaction = $this->transaction->create([
            'user_id' => auth()->user()->id,
            'store_id' => $cart['store_id'],
            'total' => $cart['total']
        ]);
        foreach ($cart['data'] as $item) {
            $this->detail_transaction->create([
                'transaction_id' => $transaction->id,
                'smartphone_id' => $item->id,
                'qty' => $item->qty,
                'price' => $item->price
            ]);
        }
        return redirect('/transaction');
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = session()->get('cart');
        $transaction = $this->transaction->with(['user', 'detail.smartphone.brand', 'store'])->find($id);
        return view('web.transaction.detail', compact('cart', 'transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyPayment(Request $request, $id)
    {
        if($request->kode == 'paid') {
            $this->transaction->findOrFail($id)->update([
                'isPaid' => 1
            ]);
            return redirect('/transaction');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function showVerify($id)
    {
        $cart = session()->get('cart');
        $transaction = $this->transaction->with(['user', 'detail.smartphone.brand', 'store'])->find($id);
        return view('web.transaction.verify', compact('cart', 'transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
