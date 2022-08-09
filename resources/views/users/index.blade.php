@extends('layouts.admin')

@section('content')
<div class="modal" tabindex="-1" role="dialog" id="notificationModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Gửi thông báo tới người dùng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea name="" id="notificationContent" cols="30" rows="10" class="form-control" placeholder="Nhập nội dung thông báo"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="sendNotification()">Gửi</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Tên tài khoản</th>
            <th>Số dư</th>
            <th>SĐT</th>
            <th>Level</th>
            <th>Hoa hồng</th>
            <th>Trạng thái</th>
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
    var tableUser = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/getUserData',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'balance', name: 'balance' },
            { data: 'phone', name: 'phone' },
            { data: 'level', name: 'level' },
            { data: 'commission', name: 'commission' },
            { data: 'active', name: 'active' },
            { data: 'invite_code', name: 'invite_code' },
            { data: 'role', name: 'role' },
            { data: 'balance', name: 'balance' },
            { data: 'action', name: 'action' },
        ]
    });

var selected_user = null;
function showModalNotification(user_id) {
    selected_user = user_id;
    $('#notificationContent').val('');
    $('#notificationModal').modal('show');
}

function sendNotification() {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  var content = $('#notificationContent').val();
    if (content) {
        var fd = new FormData();
        fd.append('selected_user', selected_user);
        fd.append('content', content);
        fd.append('_token', "{{ csrf_token() }}");

        $.ajax({
          url: '/admin/send-notification',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function(data){
            $('#notificationModal').modal('hide');
            $.notify('Đã gửi thông báo thành công', 'success');
          }
        });
    } else {
        alert('Vui lòng nhập nội dung thông báo');
    }
}
</script>
@endpush
