@extends('layouts.master')

@section('navbar')
<div class="container h-100 d-flex justify-content-between align-items-center">
    <h3>
        <a href="{{ request()->get('from') ? request()->get('from') : '/' }}">
            <img src="/images/white-left.png" alt="left">
        </a>
    </h3>
</div>
@endsection

@section('content')
{!! $setting->downloadpage !!}

@endsection
