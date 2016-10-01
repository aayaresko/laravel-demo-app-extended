<div class="panel panel-default">
    <div class="panel-body">
        <div class="">
            <a href="{{ route('frontend.catalog-product.show', $model->alias_name) }}">
                <img src="{{ $model->getImagePreviewPath('image_url') }}" alt="{{ $model->visible_name }}" class="img-responsive">
            </a>
        </div>
        <div class="product-title">
            <a href="{{ route('frontend.catalog-product.show', $model->alias_name) }}">
                {{ $model->visible_name }}
            </a>
        </div>
        <div class="controls">
            <a href="{{ route('frontend.catalog-product.show', $model->alias_name) }}" class="btn btn-success">@lang('content.view')</a>
        </div>
        <div class="like-box">
            {!! $model->likes !!}
        </div>
        <div class="product-description">
            {{ $model->preview }}
        </div>
    </div>
</div>
