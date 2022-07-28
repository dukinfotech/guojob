@extends('layouts.master')

@section('navbar')
<div class="container h-100 d-flex justify-content-between align-items-center">
    <h3>
        <a href="/">
            <img src="/images/white-left.png" alt="left">
        </a>
    </h3>
</div>
@endsection

@section('content')
{!! $setting->teampage !!}

@endsection

@push('scripts')
<script>
    var data = [
        ['**9920', '3 mảnh', '33000K', '44000K'],
        ['**1120', '6 mảnh', '34000K', '63000K'],
        ['**2536', '43 mảnh', '5000K', '32000K'],
        ['**4792', '54 mảnh', '33000K', '24000K'],
        ['**1265', '12 mảnh', '1800K', '1000K'],
        ['**3909', '34 mảnh', '21000K', '123000K'],
        ['**9838', '13 mảnh', '129000K', '36000K'],
        ['**1209', '43 mảnh', '68000K', '123000K'],
        ['**8783', '32 mảnh', '98000K', '639000K'],
        ['**9893', '12 mảnh', '145000K', '24000K'],
        ['**6733', '9 mảnh', '9100K', '111000K'],
    ];
    var html = '';
    data.forEach((x, i) => {
        html += `
        <tr>
            <td>${x[0]}</td>
            <td>${x[1]}</td>
            <td>${x[2]}</td>
            <td>${x[3]}</td>
        </tr>`;
    })
    $('#data-info').html(html);
</script>
@endpush
