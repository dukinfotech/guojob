@extends('layouts.admin')

@section('content')
<a href="/admin/payments/create" class="btn btn-success mb-3">Tạo mới</a>
<table class="table table-bordered" id="payment-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nội dung chuyển khoản</th>
            <th>Tên người thụ hưởng</th>
            <th>Số tài khoản</th>
            <th>Ngân hàng</th>
            <th>Logo ngân hàng</th>
            <th>Thao tác</th>
        </tr>
    </thead>
</table>
@endsection


@push('scripts')
<script>
$(function() {
    $('#payment-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/getPaymentData',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'content', name: 'content' },
            { data: 'receiver', name: 'receiver' },
            { data: 'number', name: 'number' },
            { data: 'bank', name: 'bank' },
            { data: 'bank_logo', name: 'bank_logo' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush
