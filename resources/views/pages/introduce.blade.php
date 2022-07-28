@extends('layouts.master')

@section('navbar')
<div class="container h-100 d-flex justify-content-between align-items-center">
    <h3>
        <a href="/">
            <img src="/images/white-left.png" alt="left">
        </a>
    </h3>
</div>
@endsection

@section('content')
{!! $setting->introducepage !!}

@endsection
