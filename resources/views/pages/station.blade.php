@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/me">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Bản ghi thư trang web</h3>
        <h3>
        </h3>
    </div>
</div>
@endsection

@section('content')
    <div class="mt-3">
        @foreach($notifications as $notification)
        <div class="station-item mb-2">
            <h6>{{ $notification->content }}</h6>
            <div>Thời gian: @datetime($notification->created_at)</div>
        </div>
        @endforeach
    </div>
@endsection
