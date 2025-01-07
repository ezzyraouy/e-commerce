@extends('back-office.layouts.master')
@section('content')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Edit unit</h3>
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
                        <div class="text-tiny">unit</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit unit</div>
                </li>
            </ul>
        </div>
        <!-- form-edit-product -->
        <form class="form-edit-product" action="{{route('units.update',$unit->id)}}" method="POST" enctype="multipart/form-data">
           @method('PUT')
           @include('back-office.units.form',[$units,$unit])
        </form>
        <!-- /form-edit-product -->
    </div>
    <!-- /main-content-wrap -->
</div>
@endsection