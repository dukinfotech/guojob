@extends('layouts.admin')

@section('content')
<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Họ và tên</th>
            <th>Tên tài khoản</th>
            <th>SĐT</th>
            <th>Mã mời</th>
            <th>Quyền</th>
            <th>Số dư</th>
            <th>Thao tác</th>
        </tr>
    </thead>
</table>
@endsection


@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/getUserData',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'phone', name: 'phone' },
            { data: 'invite_code', name: 'invite_code' },
            { data: 'role', name: 'role' },
            { data: 'balance', name: 'balance' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush
