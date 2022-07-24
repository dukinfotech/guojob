(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var target_input = $('#lfm').data('input');
        if (target_input === 'images') {
            var html = '';
            items.forEach((item, i) => {
                html += `<li class="mb-2" id="sortItem${item.name}" data-url="${item.url}">
                    <img src="${item.url}" height="100">
                    <button class="btn btn-danger" onclick="removeSortItem(${item.name})">Xóa</button>
                    <div>
                        <input type="text" class="form-control" placeholder="Nhập URL khi click vào ảnh">
                    </div>
                </li>`;
            });
            $('#sortable').append(html);
        } else {
            var file_path = items.map(function (item) {
                return item.url;
              }).join(',');

              $('#' + target_input).val(file_path);
        }
    };
      return false;
    });
  }

})(jQuery);
