@if ($model->id)
    <?php $route = ['backend.catalog-category.update', $model->id] ?>
@else
    <?php $route = 'backend.catalog-category.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form']) }}
<div class="form-group">
    {{ Form::label('visible_name', trans('content.visible_name_label'), ['class' => 'control-label']) }}
    {{ Form::text('visible_name', $model->visible_name, ['placeholder' => trans('content.visible_name_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('alias_name', trans('content.alias_name_label'), ['class' => 'control-label']) }}
    {{ Form::text('alias_name', $model->alias_name, ['placeholder' => trans('content.alias_name_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('description', trans('content.description_label'), ['class' => 'control-label']) }}
    {{ Form::textarea('description', $model->description, ['placeholder' => trans('content.description_placeholder'),'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
</div>
{{ Form::close() }}