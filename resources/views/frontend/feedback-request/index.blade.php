@extends('frontend.layouts.main')

@section('title')
    @lang('feedback.title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('feedback.title')</div>
                <div class="panel-body">
                    @include('frontend.feedback-request.form')
                    @include('frontend.includes.info-box')
                </div>
            </div>
        </div>
    </div>
@endsection