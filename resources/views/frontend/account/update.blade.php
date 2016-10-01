@extends('frontend.layouts.main')

@section('title')
    @lang('account.profile_update')
@endsection

@section('content')
    @include('frontend.includes.info-box')
    <h1>@lang('account.profile_update')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('frontend.account.form', ['model' => $model, 'profile' => $profile])
        </div>
    </div>
@endsection