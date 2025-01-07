<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Ecomus - Ultimate HTML</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- font -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/drift-basic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/photoswipe.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-style.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/logo/favicon.png') }}">
    @yield('css')
</head>

<body class="preload-wrapper">
    <!-- RTL -->
    <!-- <a href="javascript:void(0);" id="toggle-rtl" class="tf-btn animate-hover-btn btn-fill">RTL</a> -->
    <!-- /RTL  -->
    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <!-- Top bar -->
        @php
        use App\Models\Category;

        $categories = Category::all();
        @endphp

        @include('front-office.layouts.header', ['categories' => $categories])
        @include('front-office.layouts.header-mobile', ['categories' => $categories])
        @yield('content')
        @include('front-office.layouts.footer')
    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/count-down.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/drift.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/multiple-modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/model-viewer.min.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/zoom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    <script>
        $(document).ready(function() {

            // Check for '.btnaddprod' and update its text
            if ($('.btnaddprod').length) {
                $('.btnaddprod').each(function() {
                    $(this).text('Quick Add to Cart');
                });
            }

            window.updateCartModal = function() {
                const cartItemsContainer = $('.tf-mini-cart-items');
                if (!cartItemsContainer.length) return;

                cartItemsContainer.html('');
                let cart = JSON.parse(Cookies.get('cart') || '[]');

                // Update cart count
                if ($('#cart-count').length) {
                    $('#cart-count').html(cart.length);
                }

                // Update total price
                if ($('.total_price').length) {
                    $('.total_price').html('0  <span class="currency">Dhs</span>');
                }

                // Update button text for items in the cart
                cart.forEach(function(element) {
                    const btn = $('#btnaddprod' + element);
                    if (btn.length) {
                        btn.text('Remove from Cart');
                    }
                });

                if (cart.length === 0) {
                    return;
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/get-cart-items",
                    type: "POST",
                    data: {
                        cartItems: cart
                    },
                    success: function(response) {
                        let cartItemsHTML = '';
                        let total = 0;

                        response.forEach(function(product) {
                            const productImage = 'storage/' + product.image || '';
                            const cartItemHTML = `
                        <div class="tf-mini-cart-item" id="cart-item-${product.id}">
                            <div class="tf-mini-cart-image">
                                <a href="/product-detail/${product.slug}">
                                    <img src="{{asset('${productImage}')}}" alt="${product.name}">
                                </a>
                            </div>
                            <div class="tf-mini-cart-info">
                                <a class="title link" href="/product-detail/${product.slug}">${product.name}</a>
                                <div class="tf-mini-cart-btns">
                                    <div class="wg-price">
                                        ${product.price}  <span class="currency">Dhs</span>
                                    </div>
                                    <div class="tf-mini-cart-remove remove-from-cart" data-product-id="${product.id}"> Remove</div>
                                </div>
                            </div>
                        </div>`;
                            cartItemsHTML += cartItemHTML;
                            total += parseFloat(product.price);
                        });

                        if (cartItemsHTML && cartItemsContainer.length) {
                            cartItemsContainer.html(cartItemsHTML);
                        } else {
                            if (cartItemsContainer.length) {
                                cartItemsContainer.html('<p>No items in the cart.</p>');
                            }
                        }

                        if ($('.total_price').length) {
                            $('.total_price').html(total + '  <span class="currency">Dhs</span>');
                        }
                        if ($('#total_amount').length) {
                            $('#total_amount').val(total);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching cart items:", status, error);
                    }
                });
            }

            window.toggleCart = function(productId) {
                let cart = JSON.parse(Cookies.get('cart') || '[]');
                const index = cart.indexOf(productId);
                const btn = $('#btnaddprod' + productId);

                if (index === -1) {
                    if (btn.length) {
                        btn.text('Remove from Cart');
                    }
                    cart.push(productId);
                    Cookies.set('cart', JSON.stringify(cart.filter(item => item !== null)), {
                        path: '/'
                    });
                    updateCartModal();
                    if ($('#shoppingCart').length) {
                        $('#shoppingCart').modal('show');
                    }
                } else {
                    if (btn.length) {
                        btn.text('Quick Add to Cart');
                    }
                    cart.splice(index, 1);
                    Cookies.set('cart', JSON.stringify(cart), {
                        path: '/'
                    });
                    updateCartModal();
                }
            }

            window.removeFromCart = function(productId) {
                let cart = JSON.parse(Cookies.get('cart') || '[]');
                const index = cart.indexOf(productId);
                const btn = $('#btnaddprod' + productId);
                if (btn.length) {
                    btn.text('Quick Add to Cart');
                }

                cart.splice(index, 1);
                Cookies.set('cart', JSON.stringify(cart), {
                    path: '/'
                });
                updateCartModal();
                updateCart()
            }

            window.updateCount = function() {
                const wishlist = JSON.parse(Cookies.get('wishlist') || '[]');

                if ($('.wishlist-btn').length) {
                    $('.wishlist-btn').each(function() {
                        const productId = $(this).data('product-id'); // Get the product ID from data attribute
                        const tooltipText = $(this).find('.tooltip'); // Find the tooltip element
                        const heartIcon = $(this).find('.icon-heart'); // Find the heart icon
                        const deleteIcon = $(this).find('.icon-delete'); // Find the delete icon

                        if (wishlist.includes(productId)) {
                            tooltipText.text('Remove from Wishlist'); // Set text if product is in wishlist
                            heartIcon.hide(); // Hide heart icon
                            deleteIcon.show(); // Show delete icon
                        } else {
                            tooltipText.text('Add to Wishlist'); // Set default text
                            heartIcon.show(); // Show heart icon
                            deleteIcon.hide(); // Hide delete icon
                        }
                    });
                }

                const wishlistCountElement = $('#wishlist-count');
                if (wishlistCountElement.length) {
                    wishlistCountElement.text(wishlist.length);
                }
            }

            window.toggleWishlist = function(productId) {
                const wishlistBtn = $('#wishlist-btn-' + productId);
                const tooltipText = wishlistBtn.find('.tooltip');
                let wishlist = JSON.parse(Cookies.get('wishlist') || '[]');

                const index = wishlist.indexOf(productId);

                if (index === -1) {
                    wishlist.push(productId);
                    Cookies.set('wishlist', JSON.stringify(wishlist.filter(item => item !== null)), {
                        path: '/'
                    });
                    tooltipText.text('Remove from Wishlist');
                } else {
                    wishlist.splice(index, 1);
                    Cookies.set('wishlist', JSON.stringify(wishlist), {
                        path: '/'
                    });
                    tooltipText.text('Add to Wishlist');
                }

                updateCount();
            }

            // Event handlers
            $(document).on('click', '.toggle-cart', function() {
                const productId = $(this).data('product-id');
                toggleCart(productId);
            });
            $(document).on('click', '.remove-from-cart', function() {
                const productId = $(this).data('product-id');
                removeFromCart(productId);
                // getcart()
            });

            $(document).on('click', '.wishlist-btn', function() {
                const productId = $(this).data('product-id');
                toggleWishlist(productId);
            });

            // Initial updates
            updateCartModal();
            updateCount();

            //register

        });
        $(document).ready(function() {
            $('#register-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the normal way

                // Clear any existing alerts
                $('#alert-placeholder').html('');

                // Gather form data
                const formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password-confirm').val(),
                    _token: '{{ csrf_token() }}' // Include CSRF token
                };

                // Send AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route("registerFront") }}', // Laravel route for registration
                    data: formData,
                    success: function(response) {
                        // Handle success (you can redirect or display a success message)
                        Cookies.set('user_id', response.user.id)
                        location.reload();
                        // $("#register .icon-close-popup").click()
                        // $(document).ready(function() {
                        //     // Append success alert message to the alert-login container
                        //     $(".alert-login").append(`
                        //         <div class="alert alert-success" role="alert">
                        //             You have successfully logged in! You can now check out.
                        //         </div>
                        //     `);

                        //     // Update the cart checkout button
                        //     $("#btn-checkout").removeAttr('data-bs-toggle').attr('href', '#');
                        //     $("#btn-checkout span").text('Checkout')
                        //     updateMenuToLogout();
                        // });
                        // alert('Registration successful');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors (display validation errors, etc.)
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            let errorMessages = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            errorMessages += '<ul>';

                            $.each(errors, function(key, value) {
                                errorMessages += '<li>' + value[0] + '</li>'; // Show each error in a list
                            });

                            errorMessages += '</ul>';
                            errorMessages += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            errorMessages += '</div>';

                            // Insert the Bootstrap alert with error messages into the placeholder
                            $('#alert-placeholder').html(errorMessages);
                        } else {
                            // Generic error handling
                            let genericError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            genericError += 'An error occurred, please try again.';
                            genericError += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            genericError += '</div>';

                            $('#alert-placeholder').html(genericError);
                        }
                    }
                });
            });
            $('#login-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the normal way

                // Clear any existing alerts
                $('#alert-placeholder-login').html('');

                // Gather form data
                const formData = {
                    email: $('#email-login').val(),
                    password: $('#password-login').val(),
                    _token: '{{ csrf_token() }}' // Include CSRF token
                };

                // Send AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route("loginFront") }}', // Laravel route for registration
                    data: formData,
                    success: function(response) {
                        // Handle success (you can redirect or display a success message)
                        Cookies.set('user_id', response.user.id)
                        location.reload();
                        // console.log(response.user.id)
                        // $("#login .icon-close-popup").click()
                        // $(document).ready(function() {
                        //     // Append success alert message to the alert-login container
                        //     $(".alert-login").append(`
                        //         <div class="alert alert-success" role="alert">
                        //             You have successfully logged in! You can now check out.
                        //         </div>
                        //     `);

                        //     // Update the cart checkout button
                        //     $("#btn-checkout").removeAttr('data-bs-toggle').attr('href', '#');
                        //     $("#btn-checkout span").text('Checkout')
                        //     updateMenuToLogout();
                        // });
                    },
                    error: function(xhr, status, error) {
                        // Handle errors (display validation errors, etc.)
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            let errorMessages = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            errorMessages += '<ul>';

                            $.each(errors, function(key, value) {
                                errorMessages += '<li>' + value[0] + '</li>'; // Show each error in a list
                            });

                            errorMessages += '</ul>';
                            errorMessages += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            errorMessages += '</div>';

                            // Insert the Bootstrap alert with error messages into the placeholder
                            $('#alert-placeholder-login').html(errorMessages);
                        } else {
                            // Generic error handling
                            let genericError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            genericError += 'An error occurred, please try again.';
                            genericError += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            genericError += '</div>';

                            $('#alert-placeholder-login').html(genericError);
                        }
                    }
                });
            });

            function updateMenuToLogout() {
                $(".nav-account").html(`
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="submit" class="nav-icon-item btn btn-link" style="border: none; background: none;">
                            <i class="icon icon-account"></i> Logout
                        </button>
                    </form>
                `);
            }
        });
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @yield('script')


</body>

</html>