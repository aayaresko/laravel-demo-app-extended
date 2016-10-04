@extends('frontend.layouts.main')

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/web-animations/web-animations-next.min.js') }}"></script>
@endsection

@section('title')
    @lang('content.live_chat_title')
@endsection

@section('content')
    <div id="messages-list">
        <app-root>
            <div class="alert alert-info">@lang('content.loading')</div>
        </app-root>
    </div>
    <script type="text/javascript" src="{{ asset('js/angular/inline.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/angular/styles.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/angular/main.bundle.js') }}"></script>
@endsection