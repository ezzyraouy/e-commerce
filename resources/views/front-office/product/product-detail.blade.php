@extends('front-office.layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="tf-breadcrumb">
    <div class="container">
        <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
            <div class="tf-breadcrumb-list">
                <a href="index.html" class="text">Home</a>
                <i class="icon icon-arrow-right"></i>
                <a href="#" class="text">Women</a>
                <i class="icon icon-arrow-right"></i>
                <span class="text">{{ $product->name }}</span>
            </div>
            <div class="tf-breadcrumb-prev-next">
                <a href="#" class="tf-breadcrumb-prev hover-tooltip center">
                    <i class="icon icon-arrow-left"></i>
                    <!-- <span class="tooltip">Cotton jersey top</span> -->
                </a>
                <a href="#" class="tf-breadcrumb-back hover-tooltip center">
                    <i class="icon icon-shop"></i>
                    <!-- <span class="tooltip">Back to Women</span> -->
                </a>
                <a href="#" class="tf-breadcrumb-next hover-tooltip center">
                    <i class="icon icon-arrow-right"></i>
                    <!-- <span class="tooltip">Cotton jersey top</span> -->
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
<!-- default -->
<section class="flat-spacing-4 pt_0">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <div class="thumbs-slider">
                            <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                <div class="swiper-wrapper stagger-wrap">
                                    <div class="swiper-slide stagger-item" data-color="beige">
                                        <div class="item">
                                            <img class="lazyload" data-src="{{ asset('storage/' . $product->image) }}"
                                                src="{{ asset('storage/' . $product->image) }}" alt="img-product">
                                        </div>
                                    </div>
                                    @if($product->images)
                                    @foreach($product->images as $image)
                                    <div class="swiper-slide stagger-item" data-color="beige">
                                        <div class="item">
                                            <img class="lazyload" data-src="{{ asset('storage/' . $image->path) }}"
                                                src="{{ asset('storage/' . $image->path) }}" alt="img-product">
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" data-color="beige">
                                        <a href="{{ asset('storage/' . $product->image) }}" target="_blank"
                                            class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                            <img class="tf-image-zoom lazyload"
                                                data-zoom="{{ asset('storage/' . $product->image) }}"
                                                data-src="{{ asset('storage/' . $product->image) }}"
                                                src="{{ asset('storage/' . $product->image) }}" alt="">
                                        </a>
                                    </div>
                                    @if($product->images)
                                    @foreach($product->images as $image)
                                    <div class="swiper-slide" data-color="beige">
                                        <a href="{{ asset('storage/' . $image->path) }}" target="_blank"
                                            class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                            <img class="tf-image-zoom lazyload"
                                                data-zoom="{{ asset('storage/' . $image->path) }}"
                                                data-src="{{ asset('storage/' . $image->path) }}"
                                                src="{{ asset('storage/' . $image->path) }}" alt="">
                                        </a>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            <div class="tf-product-info-title">
                                <h5>{{ $product->name }}</h5>
                            </div>
                            <div class="tf-product-info-price">
                                <div class="price">{{ $product->price }}  <span class="currency">Dhs</span></div>
                            </div>
                            <!-- <div class="tf-product-info-quantity">
                                <div class="quantity-title fw-6">Quantity</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity btn-decrease">-</span>
                                    <input type="text" class="quantity-product" name="number" value="1">
                                    <span class="btn-quantity btn-increase">+</span>
                                </div>
                            </div> -->
                            <div class="tf-product-info-buy-button">
                                <form class="">
                                    <!-- <a href="javascript:void(0);"
                                        class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add
                                            to cart</a> -->
                                    <p data-product-id="{{ $product->id }}" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart toggle-cart">
                                        <span id="btnaddprod{{ $product->id }}" class="btnaddprod">
                                            <!-- Optionally add content here -->
                                        </span>
                                    </p>
                                    <!-- <a href="javascript:void(0);"
                                        class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a> -->
                                    <a href="javascript:void(0);" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action wishlist-btn"
                                        data-product-id="{{ $product->id }}" id="wishlist-btn-{{ $product->id }}">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip"></span> <!-- Tooltip text will be set in JS -->
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <!-- <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                        class="tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                        <span class="icon icon-check"></span>
                                    </a>
                                    <div class="w-100">
                                        <a href="#" class="btns-full">Buy with <img
                                                src="{{ asset('assets/images/payments/paypal.png') }}"
                                                alt=""></a>
                                        <a href="#" class="payment-more-option">More payment options</a>
                                    </div> -->
                                    <a href="{{ url('cart') }}"
                                        class="tf-btn btn-outline radius-3 link w-100 justify-content-center">View
                                        cart</a>
                                </form>
                            </div>
                            <div class="tf-product-info-extra-link">
                                <a href="#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon">
                                    <div class="icon">
                                        <i class="icon-question"></i>
                                    </div>
                                    <div class="text fw-6">Ask a question</div>
                                </a>
                                <a href="#delivery_return" data-bs-toggle="modal" class="tf-product-extra-icon">
                                    <div class="icon">
                                        <svg class="d-inline-block" xmlns="http://www.w3.org/2000/svg') }}"
                                            width="22" height="18" viewBox="0 0 22 18" fill="currentColor">
                                            <path
                                                d="M21.7872 10.4724C21.7872 9.73685 21.5432 9.00864 21.1002 8.4217L18.7221 5.27043C18.2421 4.63481 17.4804 4.25532 16.684 4.25532H14.9787V2.54885C14.9787 1.14111 13.8334 0 12.4255 0H9.95745V1.69779H12.4255C12.8948 1.69779 13.2766 2.07962 13.2766 2.54885V14.5957H8.15145C7.80021 13.6052 6.85421 12.8936 5.74468 12.8936C4.63515 12.8936 3.68915 13.6052 3.33792 14.5957H2.55319C2.08396 14.5957 1.70213 14.2139 1.70213 13.7447V2.54885C1.70213 2.07962 2.08396 1.69779 2.55319 1.69779H9.95745V0H2.55319C1.14528 0 0 1.14111 0 2.54885V13.7447C0 15.1526 1.14528 16.2979 2.55319 16.2979H3.33792C3.68915 17.2884 4.63515 18 5.74468 18C6.85421 18 7.80021 17.2884 8.15145 16.2979H13.423C13.7742 17.2884 14.7202 18 15.8297 18C16.9393 18 17.8853 17.2884 18.2365 16.2979H21.7872V10.4724ZM16.684 5.95745C16.9494 5.95745 17.2034 6.08396 17.3634 6.29574L19.5166 9.14894H14.9787V5.95745H16.684ZM5.74468 16.2979C5.27545 16.2979 4.89362 15.916 4.89362 15.4468C4.89362 14.9776 5.27545 14.5957 5.74468 14.5957C6.21392 14.5957 6.59575 14.9776 6.59575 15.4468C6.59575 15.916 6.21392 16.2979 5.74468 16.2979ZM15.8298 16.2979C15.3606 16.2979 14.9787 15.916 14.9787 15.4468C14.9787 14.9776 15.3606 14.5957 15.8298 14.5957C16.299 14.5957 16.6809 14.9776 16.6809 15.4468C16.6809 15.916 16.299 16.2979 15.8298 16.2979ZM18.2366 14.5957C17.8853 13.6052 16.9393 12.8936 15.8298 12.8936C15.5398 12.8935 15.252 12.943 14.9787 13.04V10.8511H20.0851V14.5957H18.2366Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="text fw-6">Delivery & Return</div>
                                </a>
                                <a href="#share_social" data-bs-toggle="modal" class="tf-product-extra-icon">
                                    <div class="icon">
                                        <i class="icon-share"></i>
                                    </div>
                                    <div class="text fw-6">Share</div>
                                </a>
                            </div>
                            <div class="tf-product-info-delivery-return">
                                <div class="row">
                                    <div class="col-xl-6 col-12">
                                        <div class="tf-product-delivery">
                                            <div class="icon">
                                                <i class="icon-delivery-time"></i>
                                            </div>
                                            <p>Estimate delivery times: <span class="fw-7">12-26 days</span>
                                                (International), <span class="fw-7">3-6 days</span> (United States).
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-12">
                                        <div class="tf-product-delivery mb-0">
                                            <div class="icon">
                                                <i class="icon-return-order"></i>
                                            </div>
                                            <p>Return within <span class="fw-7">30 days</span> of purchase. Duties &
                                                taxes are non-refundable.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-product-info-trust-seal">
                                <div class="tf-product-trust-mess">
                                    <i class="icon-safe"></i>
                                    <p class="fw-6">Guarantee Safe <br> Checkout</p>
                                </div>
                                <div class="tf-payment">
                                    <img src="{{ asset('assets/images/payments/visa.png') }}" alt="">
                                    <img src="{{ asset('assets/images/payments/img-1.png') }}" alt="">
                                    <img src="{{ asset('assets/images/payments/img-2.png') }}" alt="">
                                    <img src="{{ asset('assets/images/payments/img-3.png') }}" alt="">
                                    <img src="{{ asset('assets/images/payments/img-4.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="tf-sticky-btn-atc">
        <div class="container">
            <div class="tf-height-observer w-100 d-flex align-items-center">
                <div class="tf-sticky-atc-product d-flex align-items-center">
                    <div class="tf-sticky-atc-img">
                        <img class="lazyloaded" data-src="{{ asset('assets/images/shop/products/p-d1.png') }}"
                            alt="" src="{{ asset('assets/images/shop/products/p-d1.png') }}">
                    </div>
                    <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">Cotton jersey top</div>
                </div>
                <div class="tf-sticky-atc-infos">
                    <form class="">
                        <div class="tf-sticky-atc-variant-price text-center">
                            <select class="tf-select">
                                <option selected="selected">Beige / S - $8.00</option>
                                <option>Beige / M - $8.00</option>
                                <option>Beige / L - $8.00</option>
                                <option>Beige / XL - $8.00</option>
                                <option>Black / S - $8.00</option>
                                <option>Black / M - $8.00</option>
                                <option>Black / L - $8.00</option>
                                <option>Black / XL - $8.00</option>
                                <option>Blue / S - $8.00</option>
                                <option>Blue / M - $8.00</option>
                                <option>Blue / L - $8.00</option>
                                <option>Blue / XL - $8.00</option>
                                <option>White / S - $8.00</option>
                                <option>White / M - $8.00</option>
                                <option>White / L - $8.00</option>
                                <option>White / XL - $8.00</option>
                            </select>
                        </div>
                        <div class="tf-sticky-atc-btns">
                            <div class="tf-product-info-quantity">
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn">-</span>
                                    <input type="text" name="number" value="1">
                                    <span class="btn-quantity plus-btn">+</span>
                                </div>
                            </div>
                            <a href="javascript:void(0);"
                                class="tf-btn btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add
                                    to cart</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</section>
<!-- /default -->
@endsection