@extends('backend.layouts.main')

@section('title')
    @choice('content.category', 1) '{{ $model->visible_name }}'
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>@choice('content.category', 1) '{{ $model->visible_name }}'</h3>
        </div>
        <div class="panel-body">
            <p>
                <span class="text-info">@lang('content.visible_name_label'):</span> {{ $model->visible_name }}
            </p>
            <p>
                <span class="text-info">@lang('content.alias_name_label'):</span> {{ $model->alias_name }}
            </p>
            <p>
                <span class="text-info">@lang('content.description_label'):</span> {{ $model->description }}
            </p>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('backend.catalog-filter-category.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                    <a href="{{ route('backend.catalog-filter-category.destroy', $model->id) }}" class="btn btn-danger">@lang('content.delete')</a>
                </div>
                <div class="col-md-4">
                    <span class="text-muted pull-right">{{ $model->created }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection