@extends('frontend.layouts.main')

@section('title')
    @lang('content.registration_title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('content.registration_title')</div>
                <div class="panel-body">
                    {{ Form::open(['method' => 'post', 'route' => 'frontend.account.store', 'class' => 'form-horizontal', 'role' => 'form']) }}
                    <div class="form-group">
                        {{ Form::label('name', trans('account.nickname_label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('name', $account->nickname, ['placeholder' => trans('account.nickname_label'), 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', trans('account.email_label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('email', $account->email, ['placeholder' => trans('account.email_placeholder'), 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', trans('account.password_label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::password('password', ['placeholder' => trans('account.password_placeholder'), 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', trans('account.password_confirmation_label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::password('password_confirmation', ['placeholder' => trans('account.password_confirmation_placeholder'), 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit(trans('content.send'), ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                    @include('frontend.includes.info-box')
                </div>
            </div>
        </div>
    </div>
@endsection