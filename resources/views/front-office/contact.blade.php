@extends('front-office.layouts.master')
@section('title')
Contact Us & Returns/Exchanges
@endsection

@section('description')
Get in touch for inquiries, returns, or exchanges. Our team is here to assist you with any questions regarding your order or our policies.
@endsection
@section('content')
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Contact Us</div>
    </div>
</div>
<section class="flat-spacing-21">
    <div class="container">
        <div class="tf-grid-layout gap30 lg-col-2">
            <div class="tf-content-left">
                <h5 class="mb_20">Visit Our Store</h5>

                <div class="mb_20">
                    <p class="mb_15"><strong>Phone</strong></p>
                    <p>+212 22222222</p>
                </div>
                <div class="mb_20">
                    <p class="mb_15"><strong>Email</strong></p>
                    <p>abdo@gmail.com</p>
                </div>
                <div class="mb_36">
                    <p class="mb_15"><strong>Open Time</strong></p>
                    <p class="mb_15">Our store has re-opened for shopping, </p>
                    <p>exchange Every day 11am to 7pm</p>
                </div>
                <div>
                    <ul class="tf-social-icon d-flex gap-20 style-default">
                        <li><a href="#" class="box-icon link round social-facebook border-line-black"><i class="icon fs-14 icon-fb"></i></a></li>
                        <li><a href="#" class="box-icon link round social-twiter border-line-black"><i class="icon fs-12 icon-Icon-x"></i></a></li>
                        <li><a href="#" class="box-icon link round social-instagram border-line-black"><i class="icon fs-14 icon-instagram"></i></a></li>
                        <li><a href="#" class="box-icon link round social-tiktok border-line-black"><i class="icon fs-14 icon-tiktok"></i></a></li>
                        <li><a href="#" class="box-icon link round social-pinterest border-line-black"><i class="icon fs-14 icon-pinterest-1"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="tf-content-right">
                <h5 class="mb_20">Get in Touch</h5>
                <!-- <p class="mb_24">If you’ve got great products your making or looking to work with us then drop us a line.</p> -->
                <div>
                    <div class="form w-100 md-mb50">
                        <!-- <h4 class="fw-700 color-font mb-50">Entrer en contact</h4> -->
                        <form action="{{ route('store.contact') }}" method="post" class=" mt-3">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="text" name="name" required placeholder="Full Name">
                                @if ($errors->has('name'))
                                <div style="color: red">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="tele" placeholder="Phone" required>
                                @if ($errors->has('tele'))
                                <div style="color: red">{{ $errors->first('tele') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                <div style="color: red">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group mb-4">

                                <textarea name="message" id="" placeholder="Message" class="form-control form-rounded color-secondary" required placeholder=""
                                    cols="30" rows="6"></textarea>
                                @if ($errors->has('message'))
                                <div style="color: red">{{ $errors->first('message') }}</div>
                                @endif
                            </div>

                            <div class="form-group mb-4mt-4">
                                <button type="submit" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn w-100 justify-content-center">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: "<div class='cont-like'><i class='bi bi-hand-thumbs-up-fill like'></i></div>   Nous vous remercions sincèrement pour votre message. \n Notre équipe s'engage à vous répondre dans les plus brefs délais",
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: "Ok",
            denyButtonText: false
        });
    });
</script>
@endif

@endsection