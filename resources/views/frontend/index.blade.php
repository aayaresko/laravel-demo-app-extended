@extends('frontend.layouts.main')

@section('title')
    @lang('content.welcome_message')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('frontend.includes.info-box')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>@lang('content.hi_there')</h1>
                <p>@lang('content.welcome_message')</p>
            </div>
        </div>
    </div>
@endsection