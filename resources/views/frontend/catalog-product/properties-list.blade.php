@if (count($properties))
    @foreach($properties as $item)
        <dl class="row">
            <dt class="col-md-6 text-muted">
                <span class="pull-left">{{ $item->category->visible_name }}</span>
            </dt>
            <dd class="col-md-6">
                <span class="pull-left">{{ $item->visible_name }}</span>
            </dd>
        </dl>
    @endforeach
@endif