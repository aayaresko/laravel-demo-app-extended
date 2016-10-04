<div class="panel panel-default preview">
    <div class="panel-heading">
        <h3>{{ $model->visible_name }}</h3>
    </div>
    <div class="panel-body">
        <div class="post-image">
            @if ($model->image_url)
                <p>
                    <img src="{{ $model->getImagePreviewPath('image_url') }}" alt="{{ $model->visible_name }}" class="img-rounded img-responsive">
                </p>
            @endif
        </div>
        <p class="post-content">
            {{ $model->description }}
        </p>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-7">
                <a href="{{ route('backend.catalog-product.show', $model->id) }}" class="btn btn-success btn-sm">@lang('content.view')</a>
                <a href="{{ route('backend.catalog-product.edit', $model->id) }}" class="btn btn-primary btn-sm">@lang('content.edit')</a>
                <a href="{{ route('backend.catalog-product.destroy', $model->id) }}" class="btn btn-danger btn-sm">@lang('content.delete')</a>
            </div>
            <div class="col-md-5">
                <span class="text-muted pull-right">
                    {{ $model->created }}
                    <br><a href="{{ route('backend.account.show', $model->author_id) }}">{{ $model->author->profile->full_name }}</a>
                </span>
            </div>
        </div>
    </div>
</div>