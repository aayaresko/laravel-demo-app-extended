<div class="panel panel-default preview">
    <div class="panel-heading">
        <h3>@lang('feedback.request_from') {{ $model->sender_name }}</h3>
    </div>
    <div class="panel-body">
        <p class="feedback-request-content">
            {!! $model->preview !!}
        </p>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-7">
                <a href="{{ route('backend.feedback-request.show', $model->id) }}" class="btn btn-success btn-sm">@lang('content.view')</a>
                <a href="{{ route('backend.feedback-request.edit', $model->id) }}" class="btn btn-primary btn-sm">@lang('content.edit')</a>
                <a href="{{ route('backend.feedback-request.destroy', $model->id) }}" class="btn btn-danger btn-sm">@lang('content.delete')</a>
            </div>
            <div class="col-md-5">
                <span class="text-muted pull-right">{{ $model->created }}<br>{{ $model->sender_name }}</span>
            </div>
        </div>
    </div>
</div>