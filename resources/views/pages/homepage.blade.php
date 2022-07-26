@extends('layouts.master')

@section('content')
    <div class="balance-block">
        <div class="user-name">
            {{ auth()->user()->name }}
        </div>
        @if (auth()->user()->role === 'admin')
        <div class="user-invite-code mb-3">
            {{ auth()->user()->invite_code }}
        </div>
        @endif
        <div class="user-balance">
            @money2(auth()->user()->balance)
        </div>
    </div>
    <div class="row g-2 menu-block">
        <div class="col-lg-3 col-6">
            <a href="/recharge">
                <div class="menu bg-light">
                    <img class="img-fluid" src="/images/recharge1.png" alt="recharge">
                    <p class="menu-text">Nạp</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
          <div class="menu bg-light">
            <img class="img-fluid" src="/images/now1.png" alt="now">
            <p class="menu-text">Rút</p>
          </div>
        </div>
        <div class="col-lg-3 col-6">
            <a href="{{ $cskh_url }}" target="_blank">
                <div class="menu bg-light">
                    <img class="img-fluid" src="/images/phone1.png" alt="phone">
                    <p class="menu-text">Trung tâm CSKH</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
          <div class="menu bg-light">
            <img class="img-fluid" src="/images/download1.png" alt="download">
            <p class="menu-text">Tải xuống APP</p>
          </div>
        </div>
    </div>
    @if(count($homepage_images) == 0)
    <div class="image-block">
        <a href="https://www.samsung.com/vn/smartphones/" target="_blank">
            <img class="img-fluid" src="/images/image.jpg" alt="image">
        </a>
    </div>
    @else
        @foreach ($homepage_images as $homepage_image)
        <div class="image-block">
            <a href="{{ $homepage_image->url }}" target="_blank">
                <img class="img-fluid" src="{{ $homepage_image->img }}" alt="image">
            </a>
        </div>
        @endforeach
    @endif
    <div class="footerlog text-center">
        <img class="img-fluid" src="/images/footerlog.png" alt="footerlog">
    </div>
@endsection
