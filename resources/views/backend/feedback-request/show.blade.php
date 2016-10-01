@extends('backend.layouts.main')

@section('title')
    @lang('feedback.request_from') {{ $model->sender_name }}
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>@lang('feedback.request_from') {{ $model->sender_name }}</h3>
        </div>
        <div class="panel-body">
            <p class="feedback-request-content">{!! $model->content !!}</p>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('backend.feedback-request.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                    <a href="{{ route('backend.feedback-request.destroy', $model->id) }}" class="btn btn-danger">@lang('content.delete')</a>
                </div>
                <div class="col-md-4">
                    <span class="text-muted pull-right">
                        {{ $model->sender_name }}, {{ $model->created }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection