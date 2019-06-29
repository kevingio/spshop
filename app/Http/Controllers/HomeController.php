<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Smartphone;
use App\Models\Brand;
use App\Models\Store;
use App\Models\BargainList;
use Hash;

class HomeController extends Controller
{
    function __construct(Brand $brand, Smartphone $smartphone, Store $store, BargainList $bargain_list, User $user)
    {
        $this->user = $user;
        $this->brand = $brand;
        $this->smartphone = $smartphone;
        $this->store = $store;
        $this->bargain_list = $bargain_list;
        $this->middleware('auth', ['except' => ['index', 'addToCart', 'removeFromCart']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brand->all();
        $cart = session()->get('cart');
        $featured_products = $this->smartphone->with('image')->orderBy('created_at', 'desc')->take(15)->get();
        return view('web.home', compact('brands', 'featured_products', 'cart'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $cart = session()->get('cart');
        $user = auth()->user();
        return view('web.profile', compact('user', 'cart'));
    }

    /**
     * Show the application cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function mycart()
    {
        $brands = $this->brand->all();
        $cart = session()->get('cart');
        if(empty($cart)) {
            return redirect('/product');
        }
        return view('web.cart', compact('brands', 'cart'));
    }

    /**
     * Show mystore
     *
     * @return \Illuminate\Http\Response
     */
    public function mystore(Request $request)
    {
        $cart = session()->get('cart');
        $store = $this->store->where('user_id', auth()->user()->id)->first();
        if(empty($store)) {
            $store = $this->store->create([
                'user_id' => auth()->user()->id,
                'name' => ucwords(auth()->user()->name) . "'s Store"
            ]);
        }
        $brands = $this->brand->all();
        $filter = $request->except('page');
        $smartphones = $this->smartphone->with(['image'])->where('store_id', $store->id);
        if(!empty($filter['search'])) {
            $smartphones = $smartphones->where('name', 'like', "%{$filter['search']}%");
        }
        if(!empty($filter['brand'])) {
            $smartphones = $smartphones->whereHas('brand', function ($query) use ($filter) {
                $query->where('name', 'like', "%{$filter['brand']}%");
            });
        }
        if(!empty($filter['sort'])) {
            if(in_array($filter['sort'], ['asc', 'desc'])) {
                $smartphones = $smartphones->orderBy('price', $filter['sort']);
            }else {
                $temp = explode('_', $filter['sort']);
                $smartphones = $smartphones->orderBy('created_at', $temp[1]);
            }
        }else {
            $smartphones = $smartphones->orderBy('created_at', 'desc');
        }
        $smartphones = $smartphones->paginate(12);
        $smartphones->appends(request()->input())->links();
        // dd(empty($smartphones[0]->image));
        return view('web.mystore.index', compact('smartphones', 'store', 'brands', 'cart'));
    }

    /**
     * Show mystore bargain list
     *
     * @return \Illuminate\Http\Response
     */
    public function bargainList()
    {
        $cart = session()->get('cart');
        $bargain_list = $this->bargain_list->with(['user'])
                                        ->whereHas('smartphone', function ($query) {
                                            $query->whereHas('store', function ($inner_query) {
                                                $inner_query->where('user_id', auth()->user()->id);
                                            });
                                        })
                                        ->get();
        return view('web.mystore.bargain-list', compact('cart', 'bargain_list'));
    }

    /**
     * Edit mystore.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editStore(Request $request)
    {
        $data = $request->all();
        $store = $this->store->where('user_id', auth()->user()->id)->first();
        $store->update($data);

        return redirect()->intended('/mystore');
    }

    /**
     * add to cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $data = $request->all();
        $smartphone = $this->smartphone->with('image')->findOrFail($data['id']);
        $smartphone->qty = $data['qty'];
        if(!empty($data['price'])) {
            $smartphone->price = $data['price'];
        }
        $cart = session()->pull('cart');
        if($data['store_id'] != $cart['store_id']) {
            $cart = null;
        }
        $total = empty($cart['total']) ? 0 : $cart['total'];
        $isNew = true;
        if(empty($cart)) {
            $cart['total'] = 0;
            $cart['data'] = [];
        }
        if(count($cart['data']) > 0) {
            foreach ($cart['data'] as $item) {
                if($item->id == $smartphone->id) {
                    $item->qty += $data['qty'];
                    $total += ($smartphone->price * $smartphone->qty);
                    $isNew = false;
                }
            }
        }
        if($isNew == true) {
            array_push($cart['data'], $smartphone);
            $cart['total'] = $total + ($smartphone->price * $data['qty']);
            $cart['store_id'] = $data['store_id'];
        }else {
            $cart['total'] = $total;
        }
        session()->put('cart', $cart);
        return response()->json(['status' => 200]);
    }

    /**
     * remove to cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        $data = $request->all();
        $cart = session()->pull('cart');
        $total = empty($cart['total']) ? 0 : $cart['total'];
        foreach ($cart['data'] as $key => $item) {
            if($item->id == $data['id']) {
                $total -= ($item->price * $item->qty);
                unset($cart['data'][$key]);
            }
        }
        $cart['total'] = $total;
        session()->put('cart', $cart);
        return response()->json(['status' => 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {
        $data = $request->all();
        $this->user->find(auth()->user()->id)->update($data);
        $errors = [
            'type' => 'profile',
            'code' => 200,
            'message' => 'Profile changed!'
        ];

        return redirect('/profile')->with('status', $errors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $data = $request->all();
        $password = auth()->user()->password;
        if(Hash::check($data['oldpwd'], $password)) {
            if($data['newpwd'] == $data['repwd']) {
                $this->user->find(auth()->user()->id)->update([
                    'password' => Hash::make($data['newpwd'])
                ]);
                $errors = [
                    'type' => 'password',
                    'code' => 200,
                    'message' => 'Password changed!'
                ];
            }else {
                $errors = [
                    'type' => 'password',
                    'code' => 500,
                    'message' => 'Retype password not match!'
                ];
            }
        }else {
            $errors = [
                'type' => 'password',
                'code' => 500,
                'message' => 'Old password not match!'
            ];
        }

        return redirect('/profile')->with('status', $errors);
    }
}
