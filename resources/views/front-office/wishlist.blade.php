@extends('front-office.layouts.master')

@section('content')
<!-- page-title -->
<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">Your wishlist</div>
    </div>
</div>
<!-- /page-title -->

<!-- Section Product -->
<section class="flat-spacing-2">
    <div class="container">
        <div class="grid-layout wrapper-shop wishlist-items" data-grid="grid-4">
            <!-- card product 1 -->


        </div>
    </div>
</section>
<!-- /Section Product -->

@section('script')
<script>
    console.log(sessionStorage.getItem('wishlist'));

    $(document).ready(function() {
        function getwihlist() {
            // updateCount()   
            
            const wishlistItemsContainer = $('.wishlist-items');
            const emptyMessage = $('#empty');

            wishlistItemsContainer.empty(); // Clear container
            let wishlist = JSON.parse(Cookies.get('wishlist') || '[]'); // Get wishlist from cookies

            $('#wishlist-count').html(wishlist.length); // Update wishlist count
            // Send the AJAX request with the wishlist items
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                },
                url: "/get-wishlist-items",
                type: "POST",
                data: {
                    wishlistItems: wishlist // Send wishlist items
                },
                success: function(response) {
                    let wishlistItemsHTML = ''; // String to store HTML for wishlist items

                    if (response.length === 0) {
                        emptyMessage.text("No items found in the wishlist."); // If no items are returned
                    } else {
                        $.each(response, function(index, product) {
                            const productImage = product.image ? `storage/${product.image}` : 'default-image-path.jpg'; // Handle missing image
                            const wishlistItemHTML = `
                           
                            <div class="card-product">
                                <div class="card-product-wrapper">
                                    <a href="/product-detail/${product.slug}" class="product-img">
                                        <img class="lazyload img-product" data-src="{{asset('${productImage}')}}" src="{{asset('${productImage}')}}" alt="${product.name}">
                                        <img class="lazyload img-hover" data-src="{{asset('${productImage}')}}" src="{{asset('${productImage}')}}" alt="${product.name}">
                                    </a>
                                    <div class="list-product-btn type-wishlist">
                                        <a href="javascript:void(0);" class="box-icon wishlist bg_white round btn-icon-action wishlist-btn"
                                            data-product-id="${product.id}" id="wishlist-btn-${product.id}">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip"></span> <!-- Tooltip text will be set in JS -->
                                            <span class="icon icon-delete"></span>
                                        </a>

                                        <a href="#quick_view" data-bs-toggle="modal"
                                            class="box-icon quickview bg_white round tf-btn-loading">
                                            <span class="icon icon-view"></span>
                                            <span class="tooltip">Quick View</span>
                                        </a>
                                    </div>
                                  
                                </div>
                                <div class="card-product-info">
                                    <a href="/product-detail/${product.slug}" class="title link">${product.name}</a>
                                    <span class="price">${product.price}</span>
                                
                                </div>
                            </div>
                        `;
                            wishlistItemsHTML += wishlistItemHTML; // Append each item to the HTML string
                        });

                        wishlistItemsContainer.html(wishlistItemsHTML); // Inject wishlist items into the container
                    }
                    updateCount()
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching wishlist items:", status, error); // Log any errors
                    emptyMessage.text("An error occurred while fetching your wishlist.");
                }
            });
        }

        $(document).on('click', '.wishlist-btn', function() {
            getwihlist()
        });
        getwihlist()
    });
</script>

@endsection
@endsection