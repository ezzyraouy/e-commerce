<div class="section-menu-left">
    <div class="box-logo">
        <a href="index.html" id="site-logo-inner">
            <img id="logo_header" alt="" src="{{asset('assets/images/logo/logo.png')}}" data-light="{{asset('assets/images/logo/logo.png')}}" data-dark="{{asset('assets/images/logo/logo.png')}}">
        </a>
        <div class="button-show-hide">
            <i class="icon-chevron-left"></i>
        </div>
    </div>
    <div class="section-menu-left-wrap">
        <div class="center">
            <div class="center-item">
                <ul class="">
                    <li class="menu-item active">
                        <a href="index.html" class="">
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2652 3.57566C12.1187 3.42921 11.8813 3.42921 11.7348 3.57566L5.25 10.0605V19.8748C5.25 20.0819 5.41789 20.2498 5.625 20.2498H9V16.1248C9 15.0893 9.83947 14.2498 10.875 14.2498H13.125C14.1605 14.2498 15 15.0893 15 16.1248V20.2498H18.375C18.5821 20.2498 18.75 20.0819 18.75 19.8748V10.0605L12.2652 3.57566ZM20.25 11.5605L21.2197 12.5302C21.5126 12.8231 21.9874 12.8231 22.2803 12.5302C22.5732 12.2373 22.5732 11.7624 22.2803 11.4695L13.3258 2.51499C12.5936 1.78276 11.4064 1.78276 10.6742 2.515L1.71967 11.4695C1.42678 11.7624 1.42678 12.2373 1.71967 12.5302C2.01256 12.8231 2.48744 12.8231 2.78033 12.5302L3.75 11.5605V19.8748C3.75 20.9104 4.58947 21.7498 5.625 21.7498H18.375C19.4105 21.7498 20.25 20.9104 20.25 19.8748V11.5605ZM13.5 20.2498H10.5V16.1248C10.5 15.9177 10.6679 15.7498 10.875 15.7498H13.125C13.3321 15.7498 13.5 15.9177 13.5 16.1248V20.2498Z" fill="#111111" />
                                </svg>
                            </div>
                            <div class="text">Ecommerce</div>
                        </a>
                    </li>
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-file-plus"></i></div>
                            <div class="text">Product</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{route('products.index')}}" class="">
                                    <div class="text">All Products</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{route('products.create')}}" class="">
                                    <div class="text">Add Product</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">Category</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{route('categories.index')}}" class="">
                                    <div class="text">Category list</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{route('categories.create')}}" class="">
                                    <div class="text">New category</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">unit</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{route('units.index')}}" class="">
                                    <div class="text">unit list</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{route('units.create')}}" class="">
                                    <div class="text">New unit</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item ">
                        <a href="{{route('orders.index')}}" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0001 2C8.34322 2 7.00008 3.34315 7.00008 5V5.75H13.0001V5C13.0001 3.34315 11.6569 2 10.0001 2ZM14.5001 5.75V5C14.5001 2.51472 12.4854 0.5 10.0001 0.5C7.51479 0.5 5.50008 2.51472 5.50008 5V5.75H3.51287C2.55332 5.75 1.74862 6.47444 1.64817 7.42872L0.385015 19.4287C0.268481 20.5358 1.13652 21.5 2.24971 21.5H17.7504C18.8636 21.5 19.7317 20.5358 19.6151 19.4287L18.352 7.42872C18.2515 6.47444 17.4468 5.75 16.4873 5.75H14.5001ZM13.0001 7.25H7.00008V8.66146C7.23023 8.86745 7.37508 9.16681 7.37508 9.5C7.37508 10.1213 6.8714 10.625 6.25008 10.625C5.62876 10.625 5.12508 10.1213 5.12508 9.5C5.12508 9.16681 5.26992 8.86745 5.50008 8.66146V7.25H3.51287C3.32096 7.25 3.16002 7.39489 3.13993 7.58574L1.87677 19.5857C1.85347 19.8072 2.02707 20 2.24971 20H17.7504C17.9731 20 18.1467 19.8072 18.1234 19.5857L16.8602 7.58574C16.8401 7.39489 16.6792 7.25 16.4873 7.25H14.5001V8.66146C14.7302 8.86746 14.8751 9.16681 14.8751 9.5C14.8751 10.1213 14.3714 10.625 13.7501 10.625C13.1288 10.625 12.6251 10.1213 12.6251 9.5C12.6251 9.16681 12.7699 8.86745 13.0001 8.66146V7.25Z" fill="#111111"></path>
                                </svg>
                            </div>
                            <div class="text">Orders</div>
                        </a>

                    </li>
                    <li class="menu-item ">
                        <div class="menu-item-button">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>