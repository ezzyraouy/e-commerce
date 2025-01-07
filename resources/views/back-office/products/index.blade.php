@extends('back-office.layouts.master')
<!-- main-content-wrap -->
@section('content')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>All Products</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="#">
                        <div class="text-tiny">Product</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All Products</div>
                </li>
            </ul>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- product-list -->
        <div class="wg-box">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Start date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>#{{$product->id}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>  
                                <div class="list-icon-function">
                                    <a class="item edit" href="{{route('products.edit',$product->id)}}">
                                        <i class="icon-edit-3"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"  onsubmit="return confirm('Are you sure you want to delete this?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{--<div class="wg-box">
            <div class="title-box">
                <i class="icon-coffee"></i>
                <div class="body-text">Tip search by Product ID: Each product is provided with a unique ID, which you can rely on to find the exact product you need.</div>
            </div>
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <div class="show">
                        <div class="text-tiny">Showing</div>
                        <div class="select">
                            <select class="">
                                <option>10</option>
                                <option>20</option>
                                <option>30</option>
                            </select>
                        </div>
                        <div class="text-tiny">entries</div>
                    </div>
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{route('products.create')}}"><i class="icon-plus"></i>Add new</a>
            </div>
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li>
                        <div class="body-title">Name</div>
                    </li>
                    <li>
                        <div class="body-title"> ID</div>
                    </li>
                    <li>
                        <div class="body-title">Price</div>
                    </li>
                    <li>
                        <div class="body-title">Quantity</div>
                    </li>

                    <li>
                        <div class="body-title">Start date</div>
                    </li>
                    <li>
                        <div class="body-title">Action</div>
                    </li>
                </ul>
                <ul class="flex flex-column">
                    @foreach($products as $product)
                    <li class="wg-product item-row gap20">
                        <div class="name">
                            <div class="title line-clamp-2 mb-0">
                                <a href="#" class="body-text">{{$product->name}}</a>
                            </div>
                        </div>
                        <div class="body-text text-main-dark mt-4">#{{$product->id}}</div>
                        <div class="body-text text-main-dark mt-4">{{$product->price}}</div>
                        <div class="body-text text-main-dark mt-4">{{$product->stock}}</div>

                        <div class="body-text text-main-dark mt-4">{{$product->created_at}}</div>
                        <div class="list-icon-function">
                            <a class="item edit" href="{{route('products.edit',$product->id)}}">
                                <i class="icon-edit-3"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <i class="icon-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10">
                <div class="text-tiny">Showing 10 entries</div>
                <ul class="wg-pagination">
                    <li>
                        <a href="#"><i class="icon-chevron-left"></i></a>
                    </li>
                    <li>
                        <a href="#">1</a>
                    </li>
                    <li class="active">
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>--}}
        <!-- /product-list -->
    </div>
    <!-- /main-content-wrap -->
</div>


@endsection
<!-- /main-content-wrap -->