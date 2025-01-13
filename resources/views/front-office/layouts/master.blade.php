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
        console.log(Cookies.get('cart'))

        $(document).ready(function() {
            // Check for '.btnaddprod' and update its text
            if ($('.btnaddprod').length) {
                $('.btnaddprod').each(function() {
                    $(this).text('Quick Add to Cart');
                });
            }

            // Update Cart Modal
            window.updateCartModal = function() {
                const cart = JSON.parse(Cookies.get('cart') || '[]'); // Get cart from cookies
                cart.forEach((item) => {
                    const btnaddprod = $('#btnaddprod' + item.productId);
                    const quantityInput = $('#quantity-' + item.productId);
                    const unitSelect = $('#unit-' + item.productId);

                    // btnaddprod.prop('checked', true);
                    btnaddprod.text('Remove From to Cart');
                    quantityInput.val(item.quantity);
                    unitSelect.val(item.unitId); // This assumes that item.unitId exists and matches the unit ID in the dropdown
                });
                // Update cart count
                if ($('.cart-count').length) {
                    $('.cart-count').html(cart.length);
                }
                if (cart.length==0) {
                    $('.tf-mini-cart-items').html('');
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: "/get-cart-items",
                    type: "POST",
                    data: {
                        cartItems: cart,
                    },
                    success: function(response) {
                        // console.log("Cart Items Response:", response); // Debug the response
                        let cartItemsHTML = '';
                        let total = 0;
                        // Loop through the products in the response
                        response.products.forEach(function(product) {
                            // Retrieve the unit and quantity from the cart data
                            const productCartData = cart.find(item => item.productId === product.id);
                            const unitId = productCartData ? productCartData.unitId : ''; // Get unitId from cart data
                            const quantity = productCartData ? productCartData.quantity : 1; // Default quantity to 1 if not found
                            // console.log(productCartData);

                            // Find the unit from the units array based on the unitId
                            const unit = response.units.find(unit => unit.id == unitId);
                            console.log(response.units);
                            // console.log(productCartData);

                            // If unit is found, extract the unit name
                            const unitName = unit ? unit.unit.name : '';

                            const productImage = 'storage/' + (product.image || '');
                            const cartItemHTML = `
                            <div class="tf-mini-cart-item" id="cart-item-${product.id}">
                                <div class="tf-mini-cart-image">
                                    <img style="max-height:80px" src="{{asset('${productImage}')}}" alt="${product.name}">
                                </div>
                                <div class="tf-mini-cart-info">
                                    <a class="title link" href="/product-detail/${product.slug}">${product.name}</a>
                                    <div class="tf-mini-cart-unit">
                                        <span>Unit: ${unitName}</span> <!-- Display unit -->
                                    </div>
                                    <div class="tf-mini-cart-quantity">
                                        <span>Quantity: ${quantity}</span> <!-- Display quantity -->
                                    </div>
                                    <div class="tf-mini-cart-btns">
                                        <div class="tf-mini-cart-remove remove-from-cart" data-product-id="${product.id}">Remove</div>
                                    </div>
                                </div>
                            </div>`;
                            cartItemsHTML += cartItemHTML;
                            total += product.price * quantity; // Add product total to the cart total
                        });

                        // Update the cart items in the modal
                        if (cartItemsHTML && $('.tf-mini-cart-items').length) {
                            $('.tf-mini-cart-items').html(cartItemsHTML);
                        }

                        // Update the total price in the modal
                        $('.total_price').html(total + ' <span class="currency">Dhs</span>');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching cart items:", status, error);
                    },
                });
            };




            // Update Wishlist Count
            window.updateCount = function() {
                const wishlist = JSON.parse(Cookies.get('wishlist') || '[]');

                if ($('.wishlist-btn').length) {
                    $('.wishlist-btn').each(function() {
                        const productId = $(this).data('product-id');
                        const tooltipText = $(this).find('.tooltip');
                        const heartIcon = $(this).find('.icon-heart');
                        const deleteIcon = $(this).find('.icon-delete');

                        if (wishlist.includes(productId)) {
                            tooltipText.text('Remove from Wishlist');
                            heartIcon.hide();
                            deleteIcon.show();
                        } else {
                            tooltipText.text('Add to Wishlist');
                            heartIcon.show();
                            deleteIcon.hide();
                        }
                    });
                }

                const wishlistCountElement = $('#wishlist-count');
                if (wishlistCountElement.length) {
                    wishlistCountElement.text(wishlist.length);
                }
            };

            // Toggle Wishlist
            window.toggleWishlist = function(productId) {
                const wishlistBtn = $('#wishlist-btn-' + productId);
                const tooltipText = wishlistBtn.find('.tooltip');
                let wishlist = JSON.parse(Cookies.get('wishlist') || '[]');

                const index = wishlist.indexOf(productId);

                if (index === -1) {
                    wishlist.push(productId);
                    Cookies.set('wishlist', JSON.stringify(wishlist.filter(item => item !== null)), {
                        path: '/',
                    });
                    tooltipText.text('Remove from Wishlist');
                } else {
                    wishlist.splice(index, 1);
                    Cookies.set('wishlist', JSON.stringify(wishlist), {
                        path: '/',
                    });
                    tooltipText.text('Add to Wishlist');
                }

                updateCount();
            };

            // Toggle Cart
            window.toggleCart = function(productId, unitId, quantity) {
                // Parse the cart from cookies or initialize it as an empty array
                let cart = JSON.parse(Cookies.get('cart') || '[]');
                const cartItemIndex = cart.findIndex(item => item.productId === productId && item.unitId === unitId);
                const btn = $('#btnaddprod' + productId);

                if (cartItemIndex === -1) {
                    // Add the product to the cart
                    if (btn.length) {
                        // btn.prop('checked', true); // Set checkbox as checked
                        btn.text('Remove From to Cart');
                    }
                    cart.push({
                        productId,
                        unitId,
                        quantity,
                    });
                    Cookies.set('cart', JSON.stringify(cart), {
                        path: '/',
                    });
                    updateCartModal();
                    // if ($('#shoppingCart').length) {
                    //     $('#shoppingCart').modal('show');
                    // }
                } else {
                    // Remove the product from the cart
                    if (btn.length) {
                        // btn.prop('checked', false); // Set checkbox as unchecked
                        btn.text('Quick Add to Cart');
                    }
                    cart.splice(cartItemIndex, 1);
                    Cookies.set('cart', JSON.stringify(cart), {
                        path: '/',
                    });
                    updateCartModal(); // Update the modal without reloading
                }
            };


            // Event Handlers
            $(document).on('click', '.toggle-cart', function() {
                const productId = $(this).data('product-id');
                const unitId = $(`#unit-${productId}`).val();
                const quantity = $(`#quantity-${productId}`).val();

                // Remove any previous error classes
                $(`#unit-${productId}`).removeClass('is-invalid');
                $(`#quantity-${productId}`).removeClass('is-invalid');

                // Check for valid input
                if (!unitId || !quantity || quantity <= 0) {
                    // Add error class to the inputs
                    if (!unitId) {
                        $(`#unit-${productId}`).addClass('is-invalid');
                    }
                    if (!quantity || quantity <= 0) {
                        $(`#quantity-${productId}`).addClass('is-invalid');
                    }
                    return;
                }

                toggleCart(productId, unitId, quantity);
            });


            $(document).on('click', '.remove-from-cart', function() {
                const productId = $(this).data('product-id');
                removeFromCart(productId);
            });

            $(document).on('click', '.wishlist-btn', function() {
                const productId = $(this).data('product-id');
                toggleWishlist(productId);
            });
            // Remove from Cart
            window.removeFromCart = function(productId) {
                let cart = JSON.parse(Cookies.get('cart') || '[]'); // Retrieve cart from cookies or initialize as empty array
                const index = cart.findIndex(item => item.productId === productId); // Find the product index by productId
                const btn = $('#btnaddprod' + productId); // Get the checkbox button by productId

                if (index !== -1) {
                    cart.splice(index, 1); // Remove product from cart if found
                }

                if (btn.length) {
                    // btn.prop('checked', false); // Set checkbox as unchecked
                    btn.text('Quick Add to Cart');
                }

                // Save the updated cart back to the cookies
                Cookies.set('cart', JSON.stringify(cart), {
                    path: '/',
                });

                updateCartModal(); // Update the modal without reloading
                updateCart();
            };

            // Initial Updates
            updateCartModal();
            updateCount();

            // Register Form Submission
            $('#register-form').on('submit', function(e) {
                e.preventDefault();

                $('#alert-placeholder').html('');

                const formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val(),
                    Company_name: $('#Company_name').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password-confirm').val(),
                    _token: '{{ csrf_token() }}',
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'POST',
                    url: '{{ route("registerFront") }}',
                    data: formData,
                    success: function(response) {
                        Cookies.set('user_id', response.user.id);
                        location.reload();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            let errorMessages = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            errorMessages += '<ul>';
                            $.each(errors, function(key, value) {
                                errorMessages += '<li>' + value[0] + '</li>';
                            });
                            errorMessages += '</ul>';
                            errorMessages += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            errorMessages += '</div>';
                            $('#alert-placeholder').html(errorMessages);
                        } else {
                            let genericError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            genericError += 'An error occurred, please try again.';
                            genericError += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            genericError += '</div>';
                            $('#alert-placeholder').html(genericError);
                        }
                    },
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