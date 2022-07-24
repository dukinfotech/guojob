@extends('layouts.admin')

@section('content')
<form action="/admin/payments" method="post">
    @csrf
    <div class="mb-3">
        <label for="bank" class="form-label">Ngân hàng <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="bank" id="bank" placeholder="Nhập tên ngân hàng" required value="{{ old('bank') }}"></input>
    </div>
    <label for="bank" class="form-label">Logo ngân hàng <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
        <button class="btn btn-outline-secondary" type="button" data-input="bank_logo" id="lfm">Chọn ảnh</button>
        <input type="text" class="form-control" name="bank_logo" id="bank_logo">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Nội dung chuyển khoản <span class="text-danger">*</span></label>
        <textarea rows="5" class="form-control" name="content" id="content" placeholder="Nhập nội dung chuyển khoản" required>{{ old('content') }}</textarea>
    </div>
    <div class="mb-3">
        <label for="receiver" class="form-label">Người nhận <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="receiver" id="receiver" placeholder="Nhập tên người nhận" required value="{{ old('receiver') }}"></input>
    </div>
    <div class="mb-3">
        <label for="number" class="form-label">Số tài khoản <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="number" id="number" placeholder="Nhập số tài khoản" required value="{{ old('number') }}"></input>
    </div>
    @if (session('success'))
            <div class="error"></div>
            <div class="alert alert-success" role="alert">
                Tạo thành công
            </div>
    @endif
    <button class="btn btn-success">Lưu</button>
@endsection
