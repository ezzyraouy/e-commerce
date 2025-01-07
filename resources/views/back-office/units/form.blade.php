@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="wg-box mb-30">
    @csrf
    <fieldset class="name">
        <div class="body-title mb-10">Unit title <span class="tf-color-1">*</span></div>
        <input class="mb-10" type="text" placeholder="Enter title" name="name" tabindex="0" value="{{ old('name', $unit->name ?? '') }}" aria-required="true">
        <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the unit name.</div>
    </fieldset>

    <fieldset class="quantity">
        <div class="body-title mb-10">quantity <span class="tf-color-1">*</span></div>
        <input class="" type="number" placeholder="quantity" name="quantity" tabindex="0" value="{{ old('quantity', $unit->quantity ?? '') }}" aria-required="true">
    </fieldset>
    

</div>

<div class="cols gap10">
    <button class="tf-button w380" type="submit">Add</button>
    <a href="#" class="tf-button style-3 w380" type="submit">Cancel</a>
</div>