@extends('frontend.layouts.main')

@section('title')
    @lang('task.new_title')
@endsection

@section('content')
    <h1>@lang('task.new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('frontend.task.form')
            @include('frontend.includes.info-box')
        </div>
    </div>
@endsection