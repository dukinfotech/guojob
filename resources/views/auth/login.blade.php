@extends('layouts.auth')

@section('content')
    <form action="/login" method="post" id="loginForm">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="phoneOrUsername" class="form-label">Tên người dùng hoặc số điện thoại <span class="required">*</span></label>
            <input type="text" class="form-control" name="phoneOrUsername" id="phoneOrUsername" placeholder="Nhập tên người dùng hoặc số điện thoại" required value="{{ old('phone') }}">
        </div>
        @if(count($errors) && $errors->get('phone'))
            <ul class="error">
            @foreach ($errors->get('phone') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu <span class="required">*</span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu" required>
        </div>
        @if(count($errors) && $errors->get('password'))
            <ul class="error">
            @foreach ($errors->get('password') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        @if (session('notFoundError'))
            <div class="error"></div>
            <div class="alert alert-danger" role="alert">
                {{ session('notFoundError') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Đăng nhập</button>
            <a href="/register">Đăng ký</a>
        </div>
    </form>
@stop
