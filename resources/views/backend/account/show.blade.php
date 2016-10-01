@extends('backend.layouts.main')

@section('title')
    @choice('account.title', 1) '{{ $account->nickname }}'
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>@choice('account.title', 1) '{{ $account->nickname }}'</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    @if ($profile->avatar_url)
                        <img src="{{ $profile->getImagePreviewPath('avatar_url') }}" alt="{{ $profile->full_name }}" class="img-responsive thumbnail">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <dl class="dl-horizontal">
                        <dt class="text-muted">
                            <span class="pull-left">@lang('account.nickname_label'):</span>
                        </dt>
                        <dd>
                            {{ $account->nickname }}
                        </dd>
                        <dt class="text-muted">
                            <span class="pull-left">@lang('account.email_title'):</span>
                        </dt>
                        <dd>
                            <a href="mailto:{{ $account->email }}">{{ $account->email }}</a>
                        </dd>
                        <dt class="text-muted">
                            <span class="pull-left">@lang('account.full_name_title'):</span>
                        </dt>
                        <dd>
                            {{ $profile->full_name }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('backend.account.edit', $account->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                    <a href="{{ route('backend.account.destroy', $account->id) }}" class="btn btn-danger">@lang('content.delete')</a>
                </div>
                <div class="col-md-4">
                    <span class="text-muted pull-right">
                        {{ $account->created }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection