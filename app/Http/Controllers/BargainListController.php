<?php

namespace App\Http\Controllers;

use App\Models\BargainList;
use Illuminate\Http\Request;

class BargainListController extends Controller
{
    function __construct(BargainList $bargain_list)
    {
        $this->bargain_list = $bargain_list;
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
        $bargain_list = $this->bargain_list->with(['smartphone.store', 'user'])->where('user_id', auth()->user()->id)->get();
        return view('web.bargain-list', compact('cart', 'bargain_list'));
    }

    /**
     * Change status item
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id, $status)
    {
        $this->bargain_list->find($id)->update([
            'status' => $status
        ]);

        return redirect('/mystore/bargain-list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $this->bargain_list->create($data);

        return redirect('/bargain-list');
    }
}
