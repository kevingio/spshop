<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartphone;
use App\Models\SmartphoneImage;
use App\Models\Brand;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function __construct(Brand $brand, Smartphone $smartphone, SmartphoneImage $smartphone_image, Store $store)
    {
        $this->brand = $brand;
        $this->smartphone = $smartphone;
        $this->smartphone_image =  $smartphone_image;
        $this->store = $store;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = session()->get('cart');
        $brands = $this->brand->all();
        $filter = $request->except('page');
        $smartphones = $this->smartphone;
        $sort = 'asc';
        if(!empty($filter['search'])) {
            $smartphones = $smartphones->where('name', 'like', "%{$filter['search']}%");
        }
        if(!empty($filter['brand'])) {
            $smartphones = $smartphones->whereHas('brand', function ($query) use ($filter) {
                $query->where('name', 'like', "%{$filter['brand']}%");
            });
        }
        if(!empty($filter['sort'])) {
            $sort = $filter['sort'];
        }
        if(auth()->check()) {
            $smartphones = $smartphones->whereHas('store', function ($query) {
                $query->where('user_id', '!=', auth()->user()->id);
            });
        }
        $smartphones = $smartphones->orderBy('price', $sort)->paginate(12);
        $smartphones->appends(request()->input())->links();
        return view('web.product.index', compact('brands', 'smartphones', 'cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = session()->get('cart');
        $brands = $this->brand->all();
        $store = $this->store->where('user_id', auth()->user()->id)->first();
        return view('web.product.create', compact('store', 'brands', 'cart'));
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
        $data['store_id'] = $this->store->select('id')->where('user_id', auth()->user()->id)->first()->id;
        $photos = $request->file('photos');
        $insertedRow = $this->smartphone->create($data);
        foreach ($photos as $photo) {
            $this->smartphone_image->create([
                'smartphone_id' => $insertedRow->id,
                'filename' => $photo->store('public/smartphones')
            ]);
        }

        return redirect('/mystore');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = session()->get('cart');
        $smartphone = $this->smartphone->findOrFail($id);
        $related_products = $this->smartphone->where('brand_id', $smartphone->brand_id)
                                                ->where('id', '!=', $smartphone->id)
                                                ->take(12)
                                                ->get();
        return view('web.product.detail', compact('smartphone', 'related_products', 'cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cart = session()->get('cart');
        $brands = $this->brand->all();
        $store = $this->store->where('user_id', auth()->user()->id)->first();
        $smartphone = $this->smartphone->findOrFail($id);
        return view('web.product.edit', compact('smartphone', 'store', 'brands', 'cart'));
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
        $data = $request->all();
        $data['store_id'] = $this->store->select('id')->where('user_id', auth()->user()->id)->first()->id;
        $this->smartphone->find($id)->update($data);
        $photos = $request->file('photos');
        if(!empty($photos)) {
            $oldPhotos = $this->smartphone_image->where('smartphone_id', $id);
            foreach ($oldPhotos->get() as $photo) {
                Storage::delete($photo->filename);
            }
            $oldPhotos->delete();
            foreach ($photos as $photo) {
                $this->smartphone_image->create([
                    'smartphone_id' => $id,
                    'filename' => $photo->store('public/smartphones')
                ]);
            }
        }

        return redirect('/mystore');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $smartphone = $this->smartphone->findOrFail($id);
        $smartphone_image = $this->smartphone_image->where('smartphone_id', $smartphone->id);
        foreach ($smartphone_image->get() as $smartphone) {
            Storage::delete($smartphone->filename);
        }
        $smartphone_image->delete();
        $smartphone->delete();
        return response()->json(['status' => 200]);
    }
}
