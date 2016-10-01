@extends('frontend.layouts.main')

@section('title')
    @lang('content.not_allowed_title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>@lang('content.not_allowed_title')</h3>
                </div>
                <div class="panel-body">
                    <p class="text-danger">@lang('content.not_allowed_account_not_confirmed')</p>
                    @include('frontend.includes.info-box')
                </div>
            </div>
        </div>
    </div>
@endsection