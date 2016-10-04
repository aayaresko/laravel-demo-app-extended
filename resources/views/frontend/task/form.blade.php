@if ($model->id)
    <?php $route = ['frontend.task.update', $model->id] ?>
@else
    <?php $route = 'frontend.task.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) }}
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('title', trans('task.title_label'), ['class' => 'control-label']) }}
            {{ Form::text('title', $model->title, ['placeholder' => trans('task.title_placeholder'), 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('content', trans('task.content_label'), ['class' => 'control-label']) }}
            {{ Form::textarea('content', $model->content, ['placeholder' => trans('task.content_placeholder'), 'class' => 'form-control']) }}
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