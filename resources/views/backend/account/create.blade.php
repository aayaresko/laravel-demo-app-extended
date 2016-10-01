@extends('backend.layouts.main')

@section('title')
    @lang('account.new_title')
@endsection

@section('content')
    <h1>@lang('account.new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.account.form', ['account' => $account, 'profile' => $profile])
            @include('backend.includes.info-box')
        </div>
    </div>
@endsection