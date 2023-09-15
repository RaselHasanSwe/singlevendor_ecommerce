<div class="col-sm-12">
    <h4>Choose Color and Size</h4>
    <hr/>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Choose Colors</label>
        <select class="select" multiple id="colors" name="colors[]" onchange="generateVariatioon()">
            @foreach ($color as $item)
                <option value="{{ $item->id }}" {{ isset($selected_color) && in_array($item->id, @$selected_color) ? 'selected' : '' }} >{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Choose Sizes</label>
        <select class="select" multiple id="sizes" name="sizes[]" onchange="generateVariatioon()">
            @foreach ($size as $item)
            <option value="{{ $item->id }}" {{ isset($selected_color) && in_array($item->id, @$selected_size) ? 'selected' : '' }}>{{ $item->name }} ({{ $item->measurement }})</option>
            @endforeach
        </select>
    </div>
</div>

