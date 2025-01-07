@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="wg-box mb-30">
    @csrf
    <fieldset class="category">
        <div class="body-title">Category <span class="tf-color-1">*</span></div>
        <div class="select flex-grow">
            <select class="" name="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{ (isset($product->category_id) &&  $product->category_id == $category->id) ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset class="unit">
        <div class="body-title">unit <span class="tf-color-1">*</span></div>
        <div class="select flex-grow">
            <select class="" name="unit_id">
                <option value="">Select unit</option>
                @foreach($units as $unit)
                <option value="{{$unit->id}}" {{ (isset($product->unit_id) &&  $product->unit_id == $unit->id) ? 'selected' : '' }}>{{$unit->name}}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset class="name">
        <div class="body-title mb-10">Product title <span class="tf-color-1">*</span></div>
        <input class="mb-10" type="text" placeholder="Enter title" name="name" tabindex="0" value="{{ old('name', $product->name ?? '') }}" aria-required="true">
        <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the product name.</div>
    </fieldset>

    <fieldset class="price">
        <div class="body-title mb-10">Price <span class="tf-color-1">*</span></div>
        <input class="" type="number" placeholder="Price" name="price" tabindex="0" value="{{ old('price', $product->price ?? '') }}" aria-required="true">
    </fieldset>
    <fieldset class="description">
        <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
        <textarea class="mb-10" name="description" placeholder="Short description about Category" tabindex="0" aria-required="true">{{ old('description', $product->description ?? '') }}</textarea>
        <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
    </fieldset>
    <!-- <fieldset class="stock">
        <div class="body-title mb-10">Stock <span class="tf-color-1">*</span></div>
        <input class="" type="number" placeholder="Stock" name="stock" tabindex="0" value="{{ old('stock', $product->stock ?? '') }}" aria-required="true">
        <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
    </fieldset> -->
    <!-- <div class="col-12">
        <div class="body-title mb-10">Sizes</div>
        <input type="text" name="sizes" class="tagsinput" 
            value="{{ old('sizes', isset($product->sizes) ? ($product->sizes) : '') }}"
            data-role="tagsinput">
        @if ($errors->has('sizes'))
        <span class="text-danger text-left">{{ $errors->first('sizes') }}</span>
        @endif
    </div> -->

    <fieldset class="image">
        <div class="body-title mb-10">Image <span class="tf-color-1">*</span></div>
        <input class="mb-10" type="file" name="image" tabindex="0" aria-required="true">
        @if(isset($product) && $product->image)
        <div class="item">
            <img src="{{asset('storage/'.$product->image)}}" alt="{{$product->image}}">
        </div>
        @endif
    </fieldset>
</div>
<div class="wg-box mb-30">
    <fieldset class="images">
        <div class="body-title mb-10">Upload images</div>
        <input type="file" multiple name="images[]" class="form-control" id="images">
        <div class="upload-image mb-16">
            <div class="flex gap20 flex-wrap">
                @if( isset($product) && $product->images->count() > 0)
                @foreach($product->images as $image)
                <div class="item">
                    <img src="{{asset('storage/'.$image->path)}}" alt="{{$image->path}}">
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details</div>
    </fieldset>
</div>
<div class="cols gap10">
    <button class="tf-button w380" type="submit">Add</button>
    <a href="#" class="tf-button style-3 w380" type="submit">Cancel</a>
</div>

<style>
    .bootstrap-tagsinput .tag {
        color: black !important;
        border: 1px solid;
        padding: 5px;
    }

    .bootstrap-tagsinput {
        display: block !important;
        width: 100% !important;
        padding: 0.375rem 0.75rem !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        background-color: #fff !important;
        background-clip: padding-box !important;
        border: 1px solid #ced4da !important;
    }

    .bootstrap-tagsinput {
        line-height: 2.5 !important;
    }
</style>