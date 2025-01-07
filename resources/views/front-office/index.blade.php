@extends('front-office.layouts.master')
@section('css')
<style>
    .cont-prix,
    .cont-prix:hover {
        background-color: transparent !important;
        color: black !important;
        box-shadow: none !important;
    }

    .tf-btn-loading {
        background-color: white;
        padding-right: 15px;
        padding-left: 15px;
        opacity: 1;
    }
</style>
@endsection
@section('content')
<!-- slider -->
<div class="tf-slideshow slider-effect-fade slider-skincare position-relative">
    <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="true" data-auto-play="false" data-delay="2000" data-speed="1000">
        <div class="swiper-wrapper">
            <div class="swiper-slide" lazy="true">
                <div class="wrap-slider">
                    <img class="lazyload" data-src="{{asset('assets/images/slider/skincare-slide1.jpg')}}" src="{{asset('assets/images/slider/skincare-slide1.jpg')}}" alt="skincare-slideshow-01" loading="lazy">
                    <div class="box-content text-center">
                        <div class="container">
                            <h1 class="fade-item fade-item-1 text-white heading">Lorem ipsum dolor sit amet consectetur.</h1>
                            <p class="fade-item fade-item-2 text-white">Lorem ipsum dolor sit amet consectetur To deliver peak potency, minus the waste</p>
                            <a href="/shop" class="fade-item fade-item-3 tf-btn btn-light-icon animate-hover-btn btn-xl radius-3"><span>All producs</span><i class="icon icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" lazy="true">
                <div class="wrap-slider">
                    <img class="lazyload" data-src="{{asset('assets/images/slider/skincare-slide2.jpg')}}" src="{{asset('assets/images/slider/skincare-slide2.jpg')}}" alt="skincare-slideshow-02" loading="lazy">
                    <div class="box-content text-center">
                        <div class="container">
                        <h1 class="fade-item fade-item-1 text-white heading">Lorem ipsum dolor sit amet consectetur.</h1>
                        <p class="fade-item fade-item-2 text-white">Lorem ipsum dolor sit amet consectetur To deliver peak potency, minus the waste</p>
                            <a href="/shop" class="fade-item fade-item-3 tf-btn btn-light-icon animate-hover-btn btn-xl radius-3"><span>All producs</span><i class="icon icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" lazy="true">
                <div class="wrap-slider">
                    <img class="lazyload" data-src="{{asset('assets/images/slider/skincare-slide3.jpg')}}" src="{{asset('assets/images/slider/skincare-slide3.jpg')}}" alt="fashion-slideshow-03" loading="lazy">
                    <div class="box-content text-center">
                        <div class="container">
                        <h1 class="fade-item fade-item-1 text-white heading">Lorem ipsum dolor sit amet consectetur.</h1>
                        <p class="fade-item fade-item-2 text-white">Lorem ipsum dolor sit amet consectetur To deliver peak potency, minus the waste</p>
                            <a href="/shop" class="fade-item fade-item-3 tf-btn btn-light-icon animate-hover-btn btn-xl radius-3"><span>All producs</span><i class="icon icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-pagination sw-absolute-3">
        <div class="sw-dots style-2 dots-white sw-pagination-slider justify-content-center"></div>
    </div>
</div>
<!-- /slider -->
<!-- /Slider -->
<!-- <section class="cont-text">
    <div class="container-full">
        <div class="row justify-content-center">
            <div class="col-md-10 flat-title wow fadeInUp" data-wow-delay="0s">
                <h2>Shop Gram</h2>
                <p class="sub-title">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati nisi aut, quidem
                    facere culpa laborum perspiciatis eaque hic porro reprehenderit voluptas rem numquam ipsum fuga! Porro
                    nemo quis nihil facilis. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci beatae id
                    earum dicta ducimus molestias eos assumenda nostrum minima, quam quia sunt aspernatur natus, molestiae
                    veniam possimus nam repudiandae cum?</p>
            </div>
        </div>
    </div>
</section> -->
<section class="flat-spacing-1">
    <div class="container">
        <div class="wrapper-control-shop">
            <div class="meta-filter-shop"></div>
            <div class="grid-layout wrapper-shop" data-grid="grid-4">
                @foreach($products as $product)
                <div class="card-product" data-price="16.95" data-color="orange black white">
                    <div class="card-product-wrapper">
                        <a href="{{'/product-detail/'.$product->slug}}" class="product-img">
                            <img class="img-product ls-is-cached lazyloaded" data-src="{{ asset('storage/'.$product->image) }}" src="{{ asset('storage/'.$product->image) }}" alt="image-product">
                            <img class="img-hover ls-is-cached lazyloaded" data-src="{{ asset('storage/'.$product->image) }}" src="{{ asset('storage/'.$product->image) }}" alt="image-product">
                        </a>
                        <div class="list-product-btn absolute-2">
                            <p data-product-id="{{ $product->id }}" class="box-icon d-flex flex-column align-items-center w-auto quickview tf-btn-loading toggle-cart">
                                <span id="btnaddprod{{ $product->id }}" class="btnaddprod">
                                    <!-- Optionally add content here -->
                                </span>
                            </p>
                            <a data-product-id="{{ $product->id }}" href="/product-detail/{{$product->slug }}" class="box-icon d-flex flex-column align-items-center w-auto quickview tf-btn-loading">
                                Shop
                            </a>
                        </div>
                    </div>
                    <div class="card-product-info">
                        <span>{{ $product->name }}</span>
                        <span>{{ $product->price }} <span class="currency">Dhs</span></span>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
{{--<section class="cont-product">
    <div class="grid-layout wrapper-shop">
        @foreach($products as $product)      
        <div class="card-product p-0 border-0 ">
            <div class="card-product-wrapper rounded-0 ">
                <a href="{{'/product-detail/'.$product->slug}}" class="product-img">
<img class="img-product ls-is-cached lazyloaded"
    data-src="{{ asset('storage/'.$product->image) }}"
    src="{{ asset('storage/'.$product->image) }}" alt="image-product">
<img class="img-hover ls-is-cached lazyloaded"
    data-src="{{ asset('storage/'.$product->image) }}"
    src="{{ asset('storage/'.$product->image) }}" alt="image-product">
</a>
<div class="list-product-btn absolute-2 d-flex justify-content-around">
    <a href="#quick_add" data-bs-toggle="modal"
        class="box-icon d-flex flex-column align-items-start w-auto cont-prix !important">
        <span>{{ $product->name }}</span>
        <span>{{ $product->price }} <span class="currency">Dhs</span></span>
    </a>

    <p data-product-id="{{ $product->id }}" class="box-icon d-flex flex-column align-items-center w-auto quickview tf-btn-loading toggle-cart">
        <span id="btnaddprod{{ $product->id }}" class="btnaddprod">
        </span>
    </p>
    <a data-product-id="{{ $product->id }}" href="/product-detail/{{$product->slug }}" class="box-icon d-flex flex-column align-items-center w-auto quickview tf-btn-loading">
        Shop
    </a>
</div>
</div>
</div>
@endforeach
</div>
<div class="col-md-12 d-flex justify-content-center seemore">
    <a href="/shop"><span>See More</span> <i class="icon icon-arrow-down"></i></a>
</div>
</section>--}}
<!-- 
<section class="flat-spacing-20 mt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="cont-two-article">
                    <img src="{{ asset('assets/images/slider/pod-store-2.jpg') }}" alt="">
                    <h3 class="text-center mt-4">Lorem ipsum dolor sit amet elit</h3>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="cont-two-article">
                    <h3 class="text-center mb-4">Lorem ipsum dolor sit amet elit</h3>
                    <img src="{{ asset('assets/images/slider/pod-store-1.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection