@section('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#category_id').on('change', function (event) {
                var item = jQuery(this);
                var left_item = jQuery('.left-target');
                var right_item = jQuery('.right-target');
                jQuery.ajax({
                    type: 'POST',
                    url: item.data('path'),
                    data: {category_id: item.val(), _token: Laravel.csrfToken},
                    dataType: 'html'
                }).done(function (data) {
                    data = jQuery(data);
                    left_item.html(data.html());
                    right_item.html(data.html());
                });
            });
        });
    </script>
@endsection

@if ($model->id)
    <?php $route = ['backend.catalog-filter.update', $model->id] ?>
@else
    <?php $route = 'backend.catalog-filter.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form']) }}
<div class="form-group">
    {{ Form::label('title', trans('filter.title_label'), ['class' => 'control-label']) }}
    {{ Form::text('title', $model->title, ['placeholder' => trans('filter.title_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('type_id', trans('filter.type_label'), ['class' => 'control-label']) }}
    {{ Form::select('type_id', $types, $model->type_id, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('priority', trans('content.priority_label'), ['class' => 'control-label']) }}
    {{ Form::text('priority', $model->priority, ['placeholder' => trans('content.priority_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('catalog_category_id', trans('filter.catalog_category'), ['class' => 'control-label']) }}
    {{ Form::select('catalog_category_id', $catalog_categories, $model->catalog_category_id, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('category_id', trans_choice('content.category', 1), ['class' => 'control-label']) }}
    {{ Form::select('category_id', $categories, $model->category_id, ['class' => 'form-control', 'data-path' => route('backend.catalog-product-property.generate-dropdown', $model->category_id)]) }}
</div>
<div class="form-group">
    {{ Form::label('left_property_id', trans('filter.left_property_label'), ['class' => 'control-label']) }}
    {{ Form::select('left_property_id', $property_values, $model->left_property_id, ['class' => 'form-control left-target']) }}
</div>
<div class="form-group">
    {{ Form::label('right_property_id', trans('filter.right_property_label'), ['class' => 'control-label']) }}
    {{ Form::select('right_property_id', $property_values, $model->right_property_id, ['class' => 'form-control right-target']) }}
</div>
<div class="form-group">
    {{ Form::label('is_disabled', trans('filter.is_filter_disabled'), ['class' => 'control-label']) }}
    {{ Form::select('is_disabled', [ 0 => trans('content.no'), 1 => trans('content.yes') ], $model->is_disabled, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
</div>
{{ Form::close() }}