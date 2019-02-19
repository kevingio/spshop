@extends('layouts.master')

@section('page-title')
My Profile
@endsection

@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(https://images.unsplash.com/photo-1528399783831-8318d62d10e5?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f787f39564b0b83c0caa721b9baf4f33&auto=format&fit=crop&w=967&q=80);">
    <h2 class="l-text2 t-center">
        My Profile
    </h2>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <h4 class="mb-2">Profile</h4>
                @if(!empty(session('status')) && session('status')['type'] == 'profile')
                    @if(session('status')['code'] == 200)
                    <div class="row">
                        <div class="col-6">
                            <div class="alert alert-success">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-6">
                            <div class="alert alert-danger">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
                <form action="{{ url('/editProfile') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control bg-light" autocomplete="off" name="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" required class="form-control bg-light" autocomplete="off" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-check mr-2"></i>
                                Save Change
                            </button>
                        </div>
                    </div>
                </form>
                <h4 class="mt-5 mb-2">Change Password</h4>
                @if(!empty(session('status')) && session('status')['type'] == 'password' )
                    @if(session('status')['code'] == 200)
                    <div class="row">
                        <div class="col-6">
                            <div class="alert alert-success">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-6">
                            <div class="alert alert-danger">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
                <form action="{{ url('/changePassword') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-4">
                            <input type="password" required class="form-control bg-light" name="oldpwd">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-4">
                            <input type="password" required class="form-control bg-light" name="newpwd">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Retype Password</label>
                        <div class="col-sm-4">
                            <input type="password" required class="form-control bg-light" name="repwd">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-check mr-2"></i>
                                Confirm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
