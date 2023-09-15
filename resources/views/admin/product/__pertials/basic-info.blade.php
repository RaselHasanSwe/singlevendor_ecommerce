<div class="col-sm-6">
    <div class="form-group">
        <label>Product Name</label>
        <input name="name" class="form-control" value="{{ @$data->name }}" type="text">
        @if($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-3">
    <div class="form-group">
        <label>Product SKU</label>
        <input name="sku" class="form-control" value="{{ @$data->sku }}" type="text">
        @if($errors->has('sku'))
            <div class="invalid-feedback">
                {{ $errors->first('sku') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-3">
    <div class="form-group">
        <label>Product Stock</label>
        <input name="stock" class="form-control" value="{{ @$data->stock }}" type="number">
        @if($errors->has('stock'))
            <div class="invalid-feedback">
                {{ $errors->first('stock') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label>Product Price</label>
        <input name="price" class="form-control" value="{{ @$data->price }}" type="number">
        @if($errors->has('price'))
            <div class="invalid-feedback">
                {{ $errors->first('price') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label>Product Discount</label>
        <input name="discount" class="form-control" value="{{ @$data->discount }}" type="number">
        @if($errors->has('discount'))
            <div class="invalid-feedback">
                {{ $errors->first('discount') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label>Discount Type</label>
        <select class="form-control select" name="discount_type">
            <option value="">select discount type</option>
            <option value="1" {{ @$data->discount_type == 1 ? 'selected' : '' }}>Percentence</option>
            <option value="2" {{ @$data->discount_type == 2 ? 'selected' : '' }}>Flat Price </option>
        </select>
        @if($errors->has('discount_type'))
            <div class="invalid-feedback">
                {{ $errors->first('discount_type') }}
            </div>
        @endif
    </div>
</div>

<div class="col-sm-4">
    <div class="form-group">
        <label>Select Category</label>
        <select class="form-control select" name="category_id" id="category">
            <option value="">select category</option>
            @foreach ($category as $item)
                <option value="{{ $item->id }}" {{ @$data->category_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
            @endforeach
        </select>
        @if($errors->has('category'))
            <div class="invalid-feedback">
                {{ $errors->first('category') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label>Select Sub Category</label>
        <select class="form-control select" id="sub_category" name="sub_category_id">
            <option value="">select sub category</option>
            @if(isset($sub_category) && count($sub_category) > 0)
                @foreach (@$sub_category as $item)
                    <option value="{{ $item->id }}" {{ @$data->sub_category_id == $item->id ? 'selected': '' }}>{{ $item->name }}</option>
                @endforeach
            @endif
        </select>
        @if($errors->has('sub_category'))
            <div class="invalid-feedback">
                {{ $errors->first('sub_category') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label>Select Inner Category</label>
        <select class="form-control select" id="inner_category" name="inner_category_id">
            <option value="">select inner category</option>
            @if(isset($sub_category) && count($sub_category) > 0)
                @foreach (@$inner_category as $item)
                    <option value="{{ $item->id }}" {{ @$data->inner_category_id == $item->id ? 'selected': '' }}>{{ $item->name }}</option>
                @endforeach
            @endif
        </select>
        @if($errors->has('inner_category'))
            <div class="invalid-feedback">
                {{ $errors->first('inner_category') }}
            </div>
        @endif
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label>Show Product in Hot Section</label><br/>
        <input type="checkbox" {{ @$data->hot == 1 ? 'checked' : '' }} name="hot_product" data-toggle="toggle" data-onstyle="primary">
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label>Show Product in Recommendation Section</label><br/>
        <input type="checkbox" {{ @$data->recomend == 1 ? 'checked' : '' }} name="recomend_product" data-toggle="toggle" data-onstyle="primary">
    </div>
</div>
<div class="col-sm-12">
    <label>Sort Description</label>
    <div class="form-group">
        <textarea id="sort_description" name="sort_description">{{ @$data->sort_description }}</textarea>
    </div>
</div>
