@extends('frontend.layouts.main')

@section('title')
    @lang('auth.login')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('auth.login')</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10">
                            {{ Form::open(['method' => 'post', 'route' => 'auth.login', 'class' => 'form-horizontal', 'role' => 'form']) }}
                            {{--<div class="form-group">
                                {{ Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::text('name', old('name'), ['placeholder' => 'Your name', 'class' => 'form-control']) }}
                                </div>
                            </div>--}}
                            <div class="form-group">
                                {{ Form::label('email', trans('account.email_label'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::text('email', old('email'), ['placeholder' => trans('account.email_placeholder'), 'class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('password', trans('account.password_label'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::password('password', ['placeholder' => trans('account.password_placeholder'), 'class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('remember', 1, false) }} @lang('account.remember_label')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {{ Form::submit(trans('auth.login'), ['class' => 'btn btn-primary']) }}
                                    <a class="btn btn-link" href="{{ route('password.request') }}">@lang('auth.password_reset_forgot')</a>
                                </div>
                            </div>
                            {{ Form::close() }}
                            @include('frontend.includes.info-box')
                        </div>
                        <div class="col-md-2">
                            <p>
                                <a href="{{ route('auth.github') }}" class="btn btn-default">@lang('auth.github_login')</a>
                            </p>
                            <p>
                                <a href="{{ route('auth.facebook') }}" class="btn btn-primary">@lang('auth.facebook_login')</a>
                            </p>
                            <p>
                                <a href="{{ route('auth.google') }}" class="btn btn-danger">@lang('auth.google_login')</a>
                            </p>
                            <p>
                                <a href="{{ route('auth.vkontakte') }}" class="btn btn-primary">@lang('auth.vkontakte_login')</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection