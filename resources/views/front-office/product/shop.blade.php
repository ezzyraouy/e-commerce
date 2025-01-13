@extends('front-office.layouts.master')

@section('content')

<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">Shop</div>
    </div>
</div>
<!-- /page-title -->

<!-- Section Product -->
<section class="p-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-10">
                <form id="search-form" class="tf-mini-search-frm" autocomplete="off">
                    <fieldset class="text">
                        <div class="input-container">
                            <input
                                type="text"
                                placeholder="Search for products..."
                                name="query"
                                id="search-input"
                                tabindex="0"
                                aria-required="true"
                                required />
                            <div class="loader" id="search-loader" style="display: none;"></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="flat-spacing-1 pt-2">
    <div class="container">
        <div id="product-container" class="grid-layout" data-grid="grid-list">
            @foreach($products as $product)
            <!-- Add/Remove Button -->
            <div class=" product-item">
                <div class="row mb-4">
                    <p data-product-id="{{ $product->id }}" class="box-icon d-flex flex-column align-items-center w-auto quickview tf-btn-loading toggle-cart">
                        <span id="btnaddprod{{ $product->id }}" class="btn btnaddprod">Quick Add to Cart</span>
                    </p>
                    <!-- <div data-product-id="{{ $product->id }}" class="box-icon d-flex flex-column align-items-center w-auto quickview tf-btn-loading toggle-cart">
                        <input type="checkbox" name="" id="btnaddprod{{ $product->id }}">
                    </div> -->
                </div>
                <div class="row align-items-center" style="margin-bottom: 30px;">
                    <div class="col-md-3 text-center">
                        <a href="#">
                            <img class="product-image" src="{{ asset('storage/'.$product->image) }}" alt="image-product">
                        </a>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="#" class="title link">{{ $product->name }}</a>
                        <p class="description">{{ $product->description }}</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <label for="unit-{{ $product->id }}">Choose Unit:</label>
                        <select id="unit-{{ $product->id }}" class="form-select">
                            @foreach($product->unitProducts as $unitProduct)
                            <option value="{{ $unitProduct->id }}">
                                {{ $unitProduct->unit->name }} ({{ $unitProduct->quantity }} per unit)
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 text-center">
                        <label for="quantity-{{ $product->id }}">Quantity:</label>
                        <input type="number" id="quantity-{{ $product->id }}" value="1" class="form-control" min="1">
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</section>

<!-- Sticky View Cart Button -->
<div class="view-cart-container">
    <a href="/cart" class="btn-view-cart" id="view-cart-container">Continue(<span class="count-box cart-count" id="cart-count"></span>)</a>
</div>

@section('css')
<style>
    .page-link {
        width: 45px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--main);
        border: 1px solid rgb(235, 235, 235);
        border-radius: 3px;
        margin-right: 10px;
        margin-left: 10px;
    }

    .active>.page-link,
    .page-link.active {
        box-shadow: rgba(0, 0, 0, 0.2) 1px 1px 10px 0px;
        background-color: var(--main);
        color: var(--white);
        border-color: var(--main);
    }

    .tf-mini-search-frm {
        width: 100%;
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    fieldset.text {
        border: none;
        width: 100%;
        max-width: 500px;
        display: flex;
        align-items: center;
    }

    .input-container {
        display: flex;
        align-items: center;
        width: 100%;
    }

    #search-input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 25px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    #search-input:focus {
        border-color: #007bff;
        box-shadow: 0px 4px 6px rgba(0, 123, 255, 0.3);
    }

    .loader {
        position: absolute;
        right: 15px;
        top: 30%;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #007bff;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .product-item {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 15px;
        transition: box-shadow 0.3s ease-in-out;
    }

    .product-item:hover {
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
    }

    .product-image {
        max-height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.1);
    }

    .btn-view-cart {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--main);
        color: #fff;
        padding: 15px 25px;
        font-size: 16px;
        border-radius: 50px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: background-color 0.3s ease;
        width: 70%;
    }

    .btn-view-cart:hover {
        background-color: #0056b3;
    }

    .view-cart-container {
        z-index: 10;
    }

    /* Stop the button when the footer is reached */
    .stop-sticky {
        position: absolute;
        bottom: 600px;
    }

    .btnaddprod,
    .btnaddprod:hover {
        color: white;
        background-color: #000000;
    }

    @media only screen and (max-width: 800px) {
        .btn-view-cart {
            bottom: 80px;
        }
    }
</style>
@endsection

@section('script')


<script>
    // JavaScript to make the button stop at the footer
    document.addEventListener("DOMContentLoaded", function () {
        const cartContainer = document.getElementById("view-cart-container");
        const footer = document.getElementById("footer");
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    cartContainer.classList.add("stop-sticky");
                } else {
                    cartContainer.classList.remove("stop-sticky");
                }
            },
            { root: null, threshold: 0, rootMargin: "0px" }
        );

        observer.observe(footer);
    });
</script>
<script>
    $(document).ready(function() {
        const typingDelay = 300; // Delay after user stops typing (in ms)
        let typingTimer;

        $('#search-input').on('keyup', function() {
            clearTimeout(typingTimer);
            const query = $(this).val();

            if (query.length > 0) {
                $('#search-loader').show();
                typingTimer = setTimeout(() => liveSearch(query), typingDelay);
            } else {
                $('#search-loader').show();
                fetchAllProducts();
            }
        });

        function liveSearch(query) {
            $.ajax({
                url: "{{ route('products.search1') }}",
                method: "GET",
                data: {
                    query
                },
                success: function(response) {
                    renderProducts(response.products);
                    $('#search-loader').hide();
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    $('#search-loader').hide();
                }
            });
        }

        function fetchAllProducts() {
            $.ajax({
                url: "{{ route('products.all') }}",
                method: "GET",
                success: function(response) {
                    renderProducts(response.products);
                    $('#search-loader').hide();
                },
                error: function(xhr) {
                    console.error("Error fetching all products:", xhr.responseText);
                    $('#search-loader').hide();
                }
            });
        }

        function renderProducts(products) {
            $('#product-container').empty();
            const cart = JSON.parse(Cookies.get('cart') || '[]');

            if (products.length > 0) {
                products.forEach(product => {
                    const productHTML = `
                        <div class=" product-item">
                            <div class="row mb-4">
                                 <p data-product-id="${product.id}" class="box-icon d-flex flex-column align-items-center w-auto quickview tf-btn-loading toggle-cart">
                                    <span id="btnaddprod${product.id}" class="btn btnaddprod">Quick Add to Cart</span>
                                </p>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <img src="{{ asset('storage/') }}/${product.image}" class="product-image" alt="image-product">
                                </div>
                                <div class="col-md-3 text-center">
                                    <p class="title">${product.name}</p>
                                    <p class="description">${product.description}</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <label for="unit-${product.id}">Choose Unit:</label>
                                    <select id="unit-${product.id}" class="form-select">
                                        ${product.unit_products.map(unit => `
                                            <option value="${unit.id}">
                                                ${unit.unit.name} (${unit.quantity})
                                            </option>
                                        `).join('')}
                                    </select>
                                </div>
                                <div class="col-md-3 text-center">
                                    <label for="quantity-${product.id}">Quantity:</label>
                                    <input type="number" id="quantity-${product.id}" class="form-control" value="1" min="1">
                                </div>
                            </div>
                        </div>
                        <hr>
                    `;
                    $('#product-container').append(productHTML);
                });

                cart.forEach((item) => {
                    const btnaddprod = $('#btnaddprod' + item.productId);
                    const quantityInput = $('#quantity-' + item.productId);
                    const unitSelect = $('#unit-' + item.productId);

                    // btnaddprod.prop('checked', true);
                    btnaddprod.text('Romove From Cart');
                    quantityInput.val(item.quantity);
                    unitSelect.val(item.unitId); // This assumes that item.unitId exists and matches the unit ID in the dropdown
                });
            } else {
                $('#product-container').html('<p>No products found.</p>');
            }
        }
    });
</script>
@endsection

@endsection