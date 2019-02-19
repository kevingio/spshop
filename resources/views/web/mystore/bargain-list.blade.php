@extends('layouts.master')

@section('page-title')
Bargain List
@endsection

@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(https://images.unsplash.com/photo-1520089347164-2638db72ff7b?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=cd44eeaf1f084fe01ef4ffd31c702cf3&auto=format&fit=crop&w=1189&q=80);">
    <h2 class="l-text2 t-center">
        BARGAIN LIST
    </h2>
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col p-b-50">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Smartphone</th>
                            <th scope="col">Barginer</th>
                            <th scope="col">Bid</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($bargain_list) > 0)
                            @foreach($bargain_list as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->smartphone->name }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ "Rp. " . number_format($item->bid,2,',','.') }},-</td>
                                <td>
                                    @if($item->status == 'waiting')
                                    <span class="badge badge-warning">
                                        {{ $item->status }}
                                    </span>
                                    @elseif($item->status == 'approved')
                                    <span class="badge badge-success">
                                        {{ $item->status }}
                                    </span>
                                    @elseif($item->status == 'rejected')
                                    <span class="badge badge-danger">
                                        {{ $item->status }}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 'approved' || $item->status == 'rejected')
                                    <p class="text-center">-</p>
                                    @else
                                    <a href="{{ url('bargain-list') . '/' . $item->id . '/approved' }}" class="btn btn-sm btn-success px-3">
                                        Approve
                                    </a>
                                    <a href="{{ url('bargain-list') . '/' . $item->id . '/rejected' }}" class="btn btn-sm btn-danger px-3">
                                        Reject
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center bg-light">No records</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
