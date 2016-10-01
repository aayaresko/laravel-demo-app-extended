<div class="form-group">
    @foreach($properties as $item)
        <p>{{ $item->value_label }}</p>
    @endforeach
</div>