<div class="row list-group-item">
    <div class="col-md-1">
        <a href="{{ route('frontend.account.show', $model->author_id) }}" target="_blank" class="thumbnail">
            <img src="{{ $model->author->profile->getImagePath('avatar_url') }}" alt="{{ $model->author->full_name }}" class="img-responsive">
        </a>
    </div>
    <div class="col-md-9">
        <p>
            <strong>
                <a href="{{ $model->author->full_name }}" target="_blank">{{ $model->author->full_name }}</a>
            </strong>
        </p>
        <div>{{ $model->content }}</div>
    </div>
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted pull-right">{{ $model->created }}</p>
            </div>
        </div>
        @can('update-own-task', $model)
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right">
                        <a href="{{ route('frontend.task.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                        <a href="{{ route('frontend.task.destroy', $model->id) }}" class="btn btn-danger">@lang('content.delete')</a>
                    </p>
                </div>
            </div>
        @endcan
    </div>
</div>