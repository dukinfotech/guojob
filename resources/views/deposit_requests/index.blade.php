@extends('layouts.admin')

@section('content')
<table class="table table-bordered" id="deposit-request-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Họ và tên</th>
            <th>Chủ tài khoản</th>
            <th>Số điện thoại</th>
            <th>Số tài khoản</th>
            <th>Số tiền</th>
            <th>Trạng thái</th>
            <th>Ngân hàng</th>
            <th>Ngày yêu cầu</th>
            <th>Thao tác</th>
        </tr>
    </thead>
</table>
@endsection


@push('scripts')
<script>
$(function() {
    $('#deposit-request-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/getDepositRequestData',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user.name', name: 'user' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'number', name: 'number' },
            { data: 'money', name: 'money' },
            { data: 'isPaid', name: 'isPaid' },
            { data: 'payment.bank', name: 'bank' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush
