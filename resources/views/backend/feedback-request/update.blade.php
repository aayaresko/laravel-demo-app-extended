@extends('backend.layouts.main')

@section('title')
    @lang('feedback.message_update') '{{ $model->sender_name }}'
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@lang('feedback.message_update') '{{ $model->sender_name }}'</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.feedback-request.form')
        </div>
    </div>
@endsection