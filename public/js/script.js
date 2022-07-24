$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.filemanager').click(function () {
    window.open('/admin/filemanager?type=image','popUpWindow','height=800,width=1000,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
});
$('#lfm').filemanager('image');

$('#btnSave1').click(function () {
    if (confirm("Lưu?") == true) {
        var data = [];
        $('#sortable').children().each((index, e) => {
            let img = $(e).data('url');
            data.push({
                img: img,
                url: $(e).find('input').val()
            });
        });
        $.ajax({
            url: '/admin/settings/homepage-image',
            method: 'put',
            data: { data: data },
            success: function (res) {
                $.notify('Đã lưu thành công', 'success');
            }
        })
    }
});

function removeSortItem(index) {
    $(`#sortItem${index}`).remove();
}

function deleteUser(userId) {
    if (confirm("Xóa?") == true) {
        $('#deleteUserForm' + userId).submit();
    }
}

function deletePayment(paymentId) {
    if (confirm("Xóa?") == true) {
        $('#deletePaymentForm' + paymentId).submit();
    }
}
