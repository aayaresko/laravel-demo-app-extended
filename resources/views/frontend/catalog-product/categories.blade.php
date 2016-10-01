<div class="dropdown">
    <button class="btn btn-success dropdown-toggle" type="button" id="categories-menu" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
        @choice('content.category', 2)
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        @foreach($models as $model)
            <li>
                <a href="{{ route('frontend.catalog-product.index', $model->alias_name) }}" alt="{{ $model->visible_name }}">{{ $model->visible_name }}</a>
            </li>
        @endforeach
    </ul>
</div>
