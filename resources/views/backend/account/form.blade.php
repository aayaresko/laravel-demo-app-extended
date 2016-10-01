@if ($account->id)
    <?php $route = ['backend.account.update', $account->id] ?>
@else
    <?php $route = 'backend.account.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) }}
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('nickname', trans('account.nickname_label'), ['class' => 'control-label']) }}
            {{ Form::text('nickname', $account->nickname, ['placeholder' => trans('account.nickname_label'), 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', trans('account.email_label'), ['class' => 'control-label']) }}
            {{ Form::text('email', $account->email, ['placeholder' => trans('account.email_label'), 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-2 col-md-offset-1">
        <div class="form-group">
            {{ Form::label('password', trans('account.password_label'), ['class' => 'control-label']) }}
            {{ Form::password('password', ['placeholder' => trans('account.password_placeholder'), 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation', trans('account.password_confirmation_label'), ['class' => 'control-label']) }}
            {{ Form::password('password_confirmation', ['placeholder' => trans('account.password_confirmation_placeholder'), 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-2 col-md-offset-1">
        <div class="form-group">
            {{ Form::label('first_name', trans('account.first_name_label'), ['class' => 'control-label']) }}
            {{ Form::text('first_name', $profile->first_name, ['placeholder' => trans('account.first_name_label'), 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('last_name', trans('account.last_name_label'), ['class' => 'control-label']) }}
            {{ Form::text('last_name', $profile->last_name, ['placeholder' => trans('account.last_name_label'), 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-2 col-md-offset-1">
        <div class="form-group">
            @if ($profile->avatar_url)
                <img src="{{ $profile->getImagePreviewPath('avatar_url') }}" alt="{{ $profile->full_name }}" class="img-responsive">
            @endif
        </div>
        <div class="form-group">
            {{ Form::file('avatar') }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
{{ Form::close() }}