@extends('frontend.layouts.main')

@section('title')
    @lang('task.title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('frontend.includes.info-box')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('create', App\Models\Entities\Task::class)
                <p>
                    <a href="{{ route('frontend.task.create') }}" class="btn btn-primary">@lang('task.new_title')</a>
                </p>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (count($models))
                <div class="list-group">
                    @foreach($models as $model)
                        @include('frontend.task.preview', ['model' => $model])
                    @endforeach
                </div>
            @else
                 @lang('content.no_models')
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $models->links() }}
        </div>
    </div>
@endsection