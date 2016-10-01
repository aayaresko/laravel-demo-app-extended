@if ($model->id)
    <?php $route = ['frontend.subscriptions.update', $model->id] ?>
@else
    <?php $route = 'frontend.subscriptions.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-inline', 'role' => 'form', 'files' => true]) }}
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('news', trans('subscription.is_news_subscribed'), ['class' => 'control-label']) }}
            {{ Form::select('news', [ 0 => trans('content.no'), 1 => trans('content.yes') ], $model->news, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('posts', trans('subscription.is_posts_subscribed'), ['class' => 'control-label']) }}
            {{ Form::select('posts', [ 0 => trans('content.no'), 1 => trans('content.yes') ], $model->posts, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
{{ Form::close() }}