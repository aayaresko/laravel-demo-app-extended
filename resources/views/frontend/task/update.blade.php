@extends('frontend.layouts.main')

@section('title')
    @lang('task.update') '{{ $model->title }}'
@endsection

@section('content')
    @include('frontend.includes.info-box')
    <h1>@lang('task.update') '{{ $model->title }}'</h1>
    <div class="row">
        <div class="col-md-12">
            @include('frontend.task.form')
        </div>
    </div>
@endsection