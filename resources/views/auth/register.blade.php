@extends('layouts.auth')

@section('content')
    <form action="/register" method="post" id="registerForm">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên <span class="required">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ và tên" required value="{{ old('name') }}">
        </div>
        @if(count($errors) && $errors->get('name'))
            <ul class="error">
            @foreach ($errors->get('name') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="username" class="form-label">Tên tài khoản <span class="required">*</span></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tên tài khoản" required value="{{ old('username') }}">
        </div>
        @if(count($errors) && $errors->get('username'))
            <ul class="error">
            @foreach ($errors->get('username') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại <span class="required">*</span></label>
            <input type="number" class="form-control" name="phone" id="phone" placeholder="Nhập số điện thoại" required value="{{ old('phone') }}">
        </div>
        @if(count($errors) && $errors->get('phone'))
            <ul class="error">
            @foreach ($errors->get('phone') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu đăng nhập <span class="required">*</span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu đăng nhập" required>
        </div>
        @if(count($errors) && $errors->get('password'))
            <ul class="error">
            @foreach ($errors->get('password') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="passcode" class="form-label">Mật khẩu quỹ <span class="required">*</span></label>
            <input type="text" class="form-control" name="passcode" id="passcode" placeholder="Nhập mật khẩu quỹ" required>
        </div>
        @if(count($errors) && $errors->get('passcode'))
            <ul class="error">
            @foreach ($errors->get('passcode') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="invite_code" class="form-label">Mã thư mời <span class="required">*</span></label>
            <input type="text" class="form-control" name="invite_code" id="invite_code" placeholder="Nhập mã thư mời" required value="{{ old('invite_code') }}">
        </div>
        @if(count($errors) && $errors->get('invite_code'))
            <ul class="error">
            @foreach ($errors->get('invite_code') as $error)
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
        @if (session('success'))
            <div class="error"></div>
            <div class="alert alert-success" role="alert">
                Đăng ký thành công. Click vào <a href="/login">đây</a> để đăng nhập
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Đăng ký</button>
            <a href="/login">Đăng nhập</a>
        </div>
    </form>
@stop
