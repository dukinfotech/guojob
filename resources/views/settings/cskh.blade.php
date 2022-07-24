@extends('layouts.admin')

@section('content')
<form action="/admin/settings/CSKH" method="post">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="cskh" class="form-label">URL CSKH <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="cskh_url" id="cskh" placeholder="Nhập URL CSKH" required value="{{ auth()->user()->cskh_url }}">
    </div>
    <button class="btn btn-success">Lưu</button>
</form>
@endsection
