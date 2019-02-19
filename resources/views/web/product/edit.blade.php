@extends('layouts.master')

@section('page-title')
Edit Product
@endsection

@section('content')

<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(https://images.unsplash.com/photo-1520089347164-2638db72ff7b?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=cd44eeaf1f084fe01ef4ffd31c702cf3&auto=format&fit=crop&w=1189&q=80);">
    <h2 class="l-text2 t-center">
        {{ $store->name }}
    </h2>
    <p class="m-text13 t-center">
        EDIT PRODUCT
    </p>
</section>

<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('product.update', [$smartphone->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <div class="bo4 of-hidden">
                                <input class="sizefull s-text15 p-l-22 p-r-22 p-t-15 p-b-15" type="text" autocomplete="off" value="{{ $smartphone->name }}" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="bo4 of-hidden">
                                        <input class="sizefull s-text15 p-l-22 p-r-22 p-t-15 p-b-15" type="text" autocomplete="off" value="{{ $smartphone->price }}" name="price" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Brand</label>
                                        <div class="col-sm-8">
                                            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                                <select class="selection-1" name="brand_id" required>
                                                    <option>Choose an option</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" @if($smartphone->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label for="inputPassword" class="col-sm-5 col-form-label">Stock</label>
                                        <div class="col-sm-7">
                                            <div class="bo4 of-hidden">
                                                <input class="sizefull s-text15 p-l-22 p-r-22 p-t-15 p-b-15" type="number" value="{{ $smartphone->stock }}" autocomplete="off" name="stock" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <div class="bo4 of-hidden">
                                <textarea class="sizefull s-text15 p-l-22 p-r-22 p-t-15 p-b-15" style="border: 0;" name="description" required>{{ $smartphone->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Photos</label>
                        <div class="col-sm-10">
                            <input type="file" class="s-text15 p-r-22 p-t-15 p-b-15" name="photos[]" multiple>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-danger px-5 py-3"><i class="fas fa-save mr-2"></i> Save</button>
                            <a href="{{ route('mystore') }}" class="btn btn-dark px-5 py-3"><i class="fas fa-close mr-2"></i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
