@extends('backend.layouts.main')

@section('title')
    @lang('feedback.title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('backend.includes.info-box')
        </div>
    </div>
    @if (count($models))
        <div class="row">
            @foreach($models->chunk(3) as $set)
                @foreach($set as $model)
                    <div class="col-md-4">
                        @include('backend.feedback-request.preview', ['model' => $model])
                    </div>
                @endforeach
                <div class="clearfix"></div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $models->links() }}
            </div>
        </div>
    @else
        <div class="row">
            <p>@lang('content.no_models')</p>
        </div>
    @endif
@endsection