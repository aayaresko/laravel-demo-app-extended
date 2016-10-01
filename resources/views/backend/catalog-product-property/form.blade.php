@if ($model->id)
    <?php $route = ['backend.catalog-product-property.update', $model->id] ?>
@else
    <?php $route = 'backend.catalog-product-property.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form']) }}
<div class="form-group">
    {{ Form::label('visible_name', trans('content.visible_name_label'), ['class' => 'control-label']) }}
    {{ Form::text('visible_name', $model->visible_name, ['placeholder' => trans('content.visible_name_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('value', trans('catalog.product_property_value_label'), ['class' => 'control-label']) }}
    {{ Form::text('value', $model->value, ['placeholder' => trans('catalog.product_property_value_label'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('category_id', trans_choice('content.category', 1), ['class' => 'control-label']) }}
    {{ Form::select('category_id', $categories, $model->category_id, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
</div>
{{ Form::close() }}