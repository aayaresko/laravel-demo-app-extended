@extends('frontend.layouts.main')

@section('title')
    @lang('subscription.update')
@endsection

@section('content')
    @include('frontend.includes.info-box')
    <h1>@lang('subscription.update')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('frontend.subscriptions.form', ['model' => $model])
        </div>
    </div>
@endsection