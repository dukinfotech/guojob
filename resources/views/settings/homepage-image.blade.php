@extends('layouts.admin')

@section('content')
<div class="input-group">
    <span class="input-group-btn">
        <a id="lfm" data-input="images" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Chọn ảnh
        </a>
        <button class="btn btn-success" id="btnSave1">Lưu</button>
    </span>
</div>

<div id="images" class="mt-3">
    <ol id="sortable">
        @foreach ($homepage_images as $i => $homepage_image)
        <li class="mb-2" id="sortItem{{ $i }}" data-url="{{$homepage_image->img}}">
            <img src="{{$homepage_image->img}}" height="100">
            <button class="btn btn-danger" onclick="removeSortItem({{ $i }})">Xóa</button>
            <div>
                <input type="text" class="form-control" placeholder="Nhập URL khi click vào ảnh" value="{{ $homepage_image->url }}">
            </div>
        </li>
        @endforeach
    </ol>
</div>
@endsection

@push('scripts')
<script>
    $( "#sortable" ).sortable();
</script>
@endpush
