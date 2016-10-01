{{ Form::open(['method' => 'post', 'route' => ['backend.feedback-request.update', $model->id]]) }}
<div class="form-group">
    {{ Form::label('sender_name', trans('feedback.sender_name_title'), ['class' => 'control-label']) }}
    {{ Form::text('sender_name', $model->sender_name, ['placeholder' => trans('feedback.sender_name_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('sender_email', trans('feedback.sender_email_title'), ['class' => 'control-label']) }}
    {{ Form::text('sender_email', $model->sender_email, ['placeholder' => trans('feedback.sender_email_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('content', trans('feedback.message_content_title'), ['class' => 'control-label']) }}
    {{ Form::textarea('content', $model->content, ['placeholder' => trans('feedback.message_content_placeholder'), 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
</div>
{{ Form::close() }}