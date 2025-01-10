@extends('front-office.layouts.master')

@section('content')
<section class="flat-spacing-11">
    <div class="container cart-page">

        <div class="tf-page-cart text-center mt_140 mb_200" id="empty">
            <h5 class="mb_24">Your cart is empty</h5>
            <p class="mb_24">You may check out all the available products and buy some in the shop</p>
            <a href="/" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Return to shop<i class="icon icon-arrow1-top-left"></i></a>
        </div>
        <div class="tf-page-cart-wrap" id="cart-packed">
            <div class="tf-page-cart-item">
                <div id='alert-placeholder'></div>
                <form>
                    <table class="tf-table-page-cart">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <!-- <th>Size</th> -->
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="cart-items">


                        </tbody>
                    </table>
                    <!-- <div class="tf-page-cart-note">
                        <label for="cart-note">Add Order Note</label>
                        <textarea name="note" id="cart-note" placeholder="How can we help you?"></textarea>
                    </div> -->
                </form>
            </div>
            <div class="tf-page-cart-footer">
                <div class="tf-cart-footer-inner">
                    <div class="tf-free-shipping-bar" style="visibility: hidden;">
                        <div class="tf-progress-bar">
                            <span style="width: 50%;">
                                <div class="progress-car">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0.875C0 0.391751 0.391751 0 0.875 0H13.5625C14.0457 0 14.4375 0.391751 14.4375 0.875V3.0625H17.3125C17.5867 3.0625 17.845 3.19101 18.0104 3.40969L20.8229 7.12844C20.9378 7.2804 21 7.46572 21 7.65625V11.375C21 11.8582 20.6082 12.25 20.125 12.25H17.7881C17.4278 13.2695 16.4554 14 15.3125 14C14.1696 14 13.1972 13.2695 12.8369 12.25H7.72563C7.36527 13.2695 6.39293 14 5.25 14C4.10706 14 3.13473 13.2695 2.77437 12.25H0.875C0.391751 12.25 0 11.8582 0 11.375V0.875ZM2.77437 10.5C3.13473 9.48047 4.10706 8.75 5.25 8.75C6.39293 8.75 7.36527 9.48046 7.72563 10.5H12.6875V1.75H1.75V10.5H2.77437ZM14.4375 8.89937V4.8125H16.8772L19.25 7.94987V10.5H17.7881C17.4278 9.48046 16.4554 8.75 15.3125 8.75C15.0057 8.75 14.7112 8.80264 14.4375 8.89937ZM5.25 10.5C4.76676 10.5 4.375 10.8918 4.375 11.375C4.375 11.8582 4.76676 12.25 5.25 12.25C5.73323 12.25 6.125 11.8582 6.125 11.375C6.125 10.8918 5.73323 10.5 5.25 10.5ZM15.3125 10.5C14.8293 10.5 14.4375 10.8918 14.4375 11.375C14.4375 11.8582 14.8293 12.25 15.3125 12.25C15.7957 12.25 16.1875 11.8582 16.1875 11.375C16.1875 10.8918 15.7957 10.5 15.3125 10.5Z"></path>
                                    </svg>
                                </div>
                            </span>
                        </div>
                      
                    </div>
                    <div class="tf-page-cart-checkout">


                        <!-- <div class="tf-cart-totals-discounts">
                            <h3>Subtotal</h3>

                            <span class="total-value total_price"></span>
                        </div> -->

                        <!-- <p class="tf-cart-tax">
                            Taxes and <a href="shipping-delivery.html">shipping</a> calculated at checkout
                        </p>
                        <div class="cart-checkbox">
                            <input type="checkbox" class="tf-check" id="check-agree">
                            <label for="check-agree" class="fw-4">
                                I agree with the <a href="terms-conditions.html">terms and conditions</a>
                            </label>
                        </div> -->
                        <div class="alert-login"></div>
                        <div class="cart-checkout-btn">
                            @if(!Auth::check())
                            <a href="#login" data-bs-toggle="modal" class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center " id='btn-checkout'>
                                <span>Login Or Register First</span>
                            </a>
                            @else
                            <a href="#" class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center" id="btn-checkout">
                                <span>Checkout</span>
                                <div class="spinner-border spinner-border-sm ms-2" role="status" id="checkout-loader" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>

                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('script')
@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        toastr.success("{{ session('success') }}", "Success!", {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 5000 // Numeric value, no quotes
        });
    });
</script>

@php
session()->forget('success');
@endphp
@endif
<script>
    $(document).ready(function() {
        window.updateCart = function() {
            const cart = JSON.parse(Cookies.get('cart') || '[]'); // Get cart from cookies

            const emptyMessage = $('#empty'); // Assuming you have a container for the empty message
            const cartpacked = $('#cart-packed'); // Assuming you have a container for the cart

            if (cart.length > 0) {
                emptyMessage.hide(); // Hide the empty cart message
                cartpacked.show(); // Show the cart content
            } else {
                emptyMessage.show(); // Show the empty cart message
                cartpacked.hide(); // Hide the cart content
                return; // Exit the function if cart is empty
            }

            // Update cart count
            if ($('#cart-count').length) {
                $('#cart-count').html(cart.length);
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
                    let cartItemsHTML = '';

                    // Loop through the products in the response
                    response.products.forEach(function(product) {
                        // Retrieve the unit and quantity from the cart data
                        const productCartData = cart.find(item => item.productId === product.id);
                        const unitId = productCartData ? productCartData.unitId : ''; // Get unitId from cart data
                        const quantity = productCartData ? productCartData.quantity : 1; // Default quantity to 1 if not found

                        // Find the unit from the units array based on the unitId
                        const unit = response.units.find(unit => unit.id == unitId);

                        // If unit is found, extract the unit name
                        const unitName = unit ? unit.unit.name : '';
                        const unitquantity = unit ? unit.unit.quantity : '';

                        const productImage = 'storage/' + (product.image || '');
                        const cartItemHTML = `
                        <tr class="tf-cart-item file-delete cart-item-checkout" id="cart-item-${product.id}" data-product-id="${product.id}">
                            <td class="tf-cart-item_product">
                                <a href="/product-detail/${product.slug}" class="img-box">
                                    <img src="{{asset('${productImage}')}}" alt="${product.name}">
                                </a>
                                <div class="cart-info">
                                    <a href="/product-detail/${product.id}" class="cart-title link">${product.name}</a>
                                </div>
                            </td>
                            <td class="tf-cart-item_quantity" cart-data-title="Quantity">
                                <div class="item_quantity d-flex justify-content-center">
                                    ${quantity}
                                    <input type="hidden" name="number" id="quantity-${product.id}" min="1" class="w-50 text-center" data-product-id="${product.id}" value="${quantity}">
                                </div>
                            </td>
                            <td class="tf-cart-item_unit" cart-data-title="Unit">
                                <input type="hidden" name="number" id="unit_product-${product.id}"  data-unit_product-id="${unitId}"  data-product-id="${product.id}" value="${unitId}">
                                <span>${unitName}(${unitquantity} per unit)</span> <!-- Display unit -->
                            </td>
                            <td class="tf-mini-cart-remove remove-from-cart" data-product-id="${product.id}">
                                Remove
                            </td>
                        </tr>
                    `;
                        cartItemsHTML += cartItemHTML;
                    });

                    // Update the cart items in the table
                    if (cartItemsHTML && $('.cart-items').length) {
                        $('.cart-items').html(cartItemsHTML);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching cart items:", status, error);
                },
            });
        }


        updateCart(); // Call the function to load the cart

    });

    $(document).ready(function() {
        $(document).on('click', '.remove-from-page-cart', function() {
            const productId = $(this).data('product-id');

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
            updateCart();
            updateCartModal(); // Ensure this is defined globally
        });

    });

    $(document).ready(function() {
        $(document).on("change", ".tf-cart-item_quantity input[type='number']", function() {
            const productId = $(this).data('product-id');
            if ($(this).val() <= 0) {
                $(this).val(1)
            }
            const quantity = $(this).val();
            console.log(productId + 'Quantity changed');
        });
    });

    $(document).ready(function() {
        $("#btn-checkout").click(function(e) {
            // Show loader and disable the button
            if ($("#checkout-loader").is(":visible")) {
                return; // Do nothing if the loader is active
            }
            $("#btn-checkout").addClass('disabled');
            $("#checkout-loader").show();
            if ($(this).attr('data-bs-toggle')) {
                return;
            }
            e.preventDefault(); // Prevent default link behavior

            const CartItem = $('.cart-item-checkout');
            let AllProduct = [];
            let total_amount = 0;
            let user_id = '{{Auth::id()}}';
            CartItem.each(function(index, element) {
                const productId = $(element).data('product-id');
                const unit_product_id = $(element).find(`#unit_product-${productId}`).val();
                const quantity = $(element).find(`#quantity-${productId}`).val();
                if (productId && quantity ) {
                    AllProduct.push({
                        product_id: productId,
                        unit_product_id: unit_product_id,
                        quantity: quantity
                    });
                }
            });
    

            const formData = {
                _token: '{{ csrf_token() }}', // Include CSRF token
                CartItem: AllProduct,
                user_id: user_id || Cookies.get('user_id'),
                total_amount: total_amount,
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ route("orders") }}', // Laravel route for registration
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Cookies.remove('cart');
                        window.location.href = '/cart';
                    }
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON?.errors;
                    let errorMessages = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';

                    if (errors) {
                        errorMessages += '<ul>';
                        $.each(errors, function(key, value) {
                            errorMessages += `<li>${value[0]}</li>`;
                        });
                        errorMessages += '</ul>';
                    } else {
                        errorMessages += 'An error occurred, please try again.';
                    }

                    errorMessages += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    errorMessages += '</div>';

                    // Insert the Bootstrap alert with error messages into the placeholder
                    $('#alert-placeholder').html(errorMessages);
                }
            });
        });
    });
</script>

@endsection
@endsection