@extends('frontend.layouts.main')

@section('title')
    {{ $model->title }}
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ $model->title }}</h3>
        </div>
        <div class="panel-body">
            <div class="post-content">
                {!! $model->content !!}
            </div>
        </div>
        <div class="panel-footer">
            <p class="text-muted">@lang('content.created_by', [ 'author' => $model->author->profile->full_name ])
                , {{ $model->created }}</p>
            @can('update-own-task', $model)
                <a href="{{ route('frontend.task.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                <a href="{{ route('frontend.task.destroy', $model->id) }}" class="btn btn-danger">@lang('content.delete')</a>
            @endcan
        </div>
    </div>
@endsection