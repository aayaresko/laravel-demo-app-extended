@if (Session::has('success') || Session::has('status'))
    <div class="info-box">
        <div class="alert alert-info">
            {{ Session::get('success') ? Session::get('success') : Session::get('status') }}
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="info-box">
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    </div>
@endif
@if (count($errors) > 0)
    <div class="info-box">
        <div class="alert alert-danger">
            <p>@lang('validation.errors_title')</p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif