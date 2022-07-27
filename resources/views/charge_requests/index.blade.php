@extends('layouts.admin')

@section('content')
<table class="table table-bordered" id="charge-request-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Mã yêu cầu</th>
            <th>Người dùng</th>
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
    $('#charge-request-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/getChargeRequestData',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'code', name: 'code' },
            { data: 'user.name', name: 'user' },
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
