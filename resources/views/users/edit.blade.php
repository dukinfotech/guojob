@extends('layouts.admin')

@section('content')
<form action="/admin/users/{{ $user->id }}" method="post">
    @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ và tên" required value="{{ old('name') ? old('name') : $user->name }}">
        </div>
        @if(count($errors) && $errors->get('name'))
            <ul class="text-danger">
            @foreach ($errors->get('name') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="username" class="form-label">Tên tài khoản <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tên tài khoản" required value="{{ old('username') ? old('username') : $user->username }}">
        </div>
        @if(count($errors) && $errors->get('username'))
            <ul class="text-danger">
            @foreach ($errors->get('username') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="phone" id="phone" placeholder="Nhập số điện thoại" required value="{{ old('phone') ? old('phone') : $user->phone }}">
        </div>
        @if(count($errors) && $errors->get('phone'))
            <ul class="text-danger">
            @foreach ($errors->get('phone') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu đăng nhập</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu đăng nhập">
        </div>
        @if(count($errors) && $errors->get('password'))
            <ul class="text-danger">
            @foreach ($errors->get('password') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="passcode" class="form-label">Mật khẩu quỹ</label>
            <input type="text" class="form-control" name="passcode" id="passcode" placeholder="Nhập mật khẩu quỹ">
        </div>
        @if(count($errors) && $errors->get('passcode'))
            <ul class="text-danger">
            @foreach ($errors->get('passcode') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="role" class="form-label">Quyền <span class="text-danger">*</span></label>
            <select name="role" id="role" class="form-control">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="ba" class="form-label">Số dư <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="balance" id="balance" placeholder="Nhập số dư" required value="{{ old('balance') ? old('balance') : $user->balance }}">
        </div>
        @if(count($errors) && $errors->get('balance'))
            <ul class="text-danger">
            @foreach ($errors->get('balance') as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        @if (session('success'))
            <div class="text-danger"></div>
            <div class="alert alert-success" role="alert">
                Cập nhật thành công
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
</form>
@endsection
