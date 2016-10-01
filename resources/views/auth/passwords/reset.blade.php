@extends('frontend.layouts.main')

@section('title')
    @lang('account.password_reset_title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('account.password_reset_title')</div>
                <div class="panel-body">
                    {{ Form::open(['method' => 'post', 'route' => 'password.reset', 'class' => 'form-horizontal', 'role' => 'form']) }}
                    {{ Form::hidden('token', $token) }}
                    <div class="form-group">
                        {{ Form::label('email', trans('account.email_label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('email', $email ? $email : old('email'), ['placeholder' => trans('account.email_placeholder'), 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', trans('account.password_new_label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::password('password', ['placeholder' => trans('account.password_new_placeholder'), 'class' => 'form-control']) }}
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
                            {{ Form::submit(trans('account.password_reset_title'), ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                    @include('frontend.includes.info-box')
                </div>
            </div>
        </div>
    </div>
@endsection
