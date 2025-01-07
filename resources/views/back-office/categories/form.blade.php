@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="wg-box mb-30">
    @csrf
    <fieldset class="name">
        <div class="body-title mb-10">Category title <span class="tf-color-1">*</span></div>
        <input class="mb-10" type="text" placeholder="Enter title" name="name" tabindex="0" value="{{ old('name', $category->name ?? '') }}" aria-required="true">
        <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the category name.</div>
    </fieldset>

    <fieldset class="description">
        <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
        <textarea class="mb-10" name="description" placeholder="Short description about product" tabindex="0" aria-required="true">{{ old('description', $category->description ?? '') }}</textarea>
        <div class="text-tiny">Do not exceed 100 characters when entering the category name.</div>
    </fieldset>
    <fieldset class="image">
        <div class="body-title mb-10">Image <span class="tf-color-1">*</span></div>
        <input class="mb-10" type="file" name="image" tabindex="0" aria-required="true">
        @if(isset($category) && $category->image)
        <div class="item">
          <img src="{{asset('storage/'.$category->image)}}" alt="{{$category->image}}">
        </div>
        @endif
    </fieldset>
    <fieldset class="category">
        <div class="body-title">Category <span class="tf-color-1">*</span></div>
        <div class="select flex-grow">
            <select class="" name="parent_id">
                <option value="">Select Category</option>
                @foreach($categories as $item)
                <option value="{{$item->id}}" {{ (isset($category->parent_id) &&  $category->parent_id == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </fieldset>

</div>

<div class="cols gap10">
    <button class="tf-button w380" type="submit">Add</button>
    <a href="#" class="tf-button style-3 w380" type="submit">Cancel</a>
</div>