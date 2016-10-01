{{ Form::open(['method' => 'post', 'route' => 'frontend.feedback', 'class' => 'form-horizontal', 'role' => 'form']) }}
<div class="form-group">
    {{ Form::label('name', trans('feedback.from_name_label'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-7">
        {{ Form::text('name', null, ['placeholder' => trans('feedback.from_name_placeholder'), 'class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('email', trans('account.email_label'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-7">
        {{ Form::text('email', null, ['placeholder' => trans('account.email_placeholder'), 'class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('content', trans('content.message_title'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-7">
        {{ Form::textarea('content', null, ['placeholder' => trans('content.message_placeholder'), 'class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    <div class="col-md-7">
        {{ Form::submit(trans('content.send'), ['class' => 'btn btn-primary']) }}
    </div>
</div>
{{ Form::close() }}