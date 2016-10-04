@extends('backend.layouts.main')

@section('title')
    @lang('account.update', ['profile' => $account->nickname])
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@lang('account.update', ['profile' => $account->nickname])</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.account.form')
        </div>
    </div>
@endsection