@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/select2/select2.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.multiple-select').select2({
                placeholder: '@lang('content.select_placeholder')',
                allowClear: false
            });
        });
    </script>
@endsection

@if ($model->id)
    <?php $route = ['backend.catalog-product.update', $model->id] ?>
@else
    <?php $route = 'backend.catalog-product.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) }}
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('visible_name', trans('content.visible_name_label'), ['class' => 'control-label']) }}
            {{ Form::text('visible_name', $model->visible_name, ['placeholder' => trans('content.visible_name_placeholder'), 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('alias_name', trans('catalog.product_alias_name_label'), ['class' => 'control-label']) }}
            {{ Form::text('alias_name', $model->alias_name, ['placeholder' => trans('catalog.product_alias_name_placeholder'), 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('author_id', trans('content.author_title'), ['class' => 'control-label']) }}
            {{ Form::select('author_id', $authors, $model->author_id, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('categories[]', trans_choice('content.category', 2), ['class' => 'control-label']) }}
            {{ Form::select('categories[]', $categories, $model->categories()->pluck('id')->all(), ['multiple', 'class' => 'multiple-select js-example-basic-single js-states form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', trans('content.description_label'), ['class' => 'control-label']) }}
            {{ Form::textarea('description', $model->description, ['placeholder' => trans('content.description_placeholder'), 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-5 col-md-offset-1">
        {{ Form::label('preview', trans('catalog.product_main_image_label'), ['class' => 'control-label']) }}
        <div class="form-group">
            @if ($model->image_url)
                <img src="{{ $model->getImagePreviewPath('image_url') }}" alt="{{ $model->visible_name }}">
            @endif
        </div>
        <div class="form-group">
            <p>
                {{ Form::file('preview') }}
            </p>
        </div>
    </div>
    <div class="col-md-3">
        <h4>@choice('content.image', 2)</h4>
        <div class="row">
            <div class="col-md-12">
                @if (isset($images) && count($images))
                    @include('backend.catalog-product.images-slider', ['model' => $model, 'images' => $images])
                @endif
                <div class="form-group">
                    <a href="{{ route('backend.catalog-product-images.update', $model->id) }}" class="btn btn-default">@lang('content.update', ['model' => mb_strtolower(trans_choice('content.image', 2))])</a>
                </div>
            </div>
        </div>
        <h4>@choice('content.property', 2)</h4>
        <div class="row">
            <div class="col-md-12">
                @if (isset($properties) && count($properties))
                    @include('backend.catalog-product.properties-list', ['model' => $model, 'properties' => $properties])
                @endif
                <div class="form-group">
                    <a href="{{ route('backend.catalog-product-properties.update', $model->id) }}" class="btn btn-default">@lang('content.update', ['model' => mb_strtolower(trans_choice('content.property', 2))])</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
{{ Form::close() }}
