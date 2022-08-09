@extends('layouts.admin')

@section('content')
<h2>Setting trang tải xuống</h2>
<form action="/admin/settings/download" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <textarea id="my-editor" name="downloadpage" class="form-control">{{ $setting->downloadpage }}</textarea>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            Lưu thành công
        </div>
    @endif
    <button class="btn btn-success">Lưu</button>
</form>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/admin/filemanager?type=image',
    filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/admin/filemanager?type=Files',
    filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token='
  };
  CKEDITOR.replace('my-editor', options);
</script>
@endpush
