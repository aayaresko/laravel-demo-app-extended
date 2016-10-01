@extends('frontend.layouts.main')

@section('title')
    {{ $profile->full_name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            @if ($profile->avatar_url)
                <img src="{{ $profile->getImagePath('avatar_url') }}" alt="{{ $profile->full_name }}" class="img-responsive thumbnail">
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-sm-2 col-xs-3">
            <p class="text-muted">@lang('account.login_title'):</p>
        </div>
        <div class="col-md-1 col-sm-2 col-xs-3">
            <p>{{ $account->nickname }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-sm-2 col-xs-3">
            <p class="text-muted">@lang('account.email_title'):</p>
        </div>
        <div class="col-md-1 col-sm-2 col-xs-3">
            <p>
                <a href="mailto:{{ $account->email }}">{{ $account->email }}</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-sm-2 col-xs-3">
            <p class="text-muted">@lang('account.full_name_title'):</p>
        </div>
        <div class="col-md-1 col-sm-2 col-xs-3">
            <p>{{ $profile->full_name }}</p>
        </div>
    </div>
@endsection