<option value="">select sub category</option>
@foreach ($data as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach
