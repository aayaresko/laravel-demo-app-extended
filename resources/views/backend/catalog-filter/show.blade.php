@extends('backend.layouts.main')

@section('title')
    @choice('content.filter', 1) '{{ $model->title }}'
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>@choice('content.filter', 1) '{{ $model->title }}'</h3>
        </div>
        <div class="panel-body">
            <p>
                <span class="text-info">@lang('filter.title_label'):</span> {{ $model->title }}
            </p>
            <p>
                <span class="text-info">@lang('filter.type_label'):</span> {{ $model->type }}
            </p>
            <p>
                <span class="text-info">@lang('filter.left_property_label')
                    :</span> {{ $model->left_property_id ? $model->leftProperty->value_label : '' }}
            </p>
            <p>
                <span class="text-info">@lang('filter.right_property_label')
                    :</span> {{ $model->right_property_id ? $model->rightProperty->value_label : '' }}
            </p>
            <p>
                <span class="text-info">@lang('content.category'):</span> {{ $model->category->visible_name }}
            </p>
            <p>
                <span class="text-info">@lang('filter.catalog_category')
                    :</span> {{ $model->catalogCategory->visible_name }}
            </p>
            <p>
                <span class="text-info">@lang('content.description_label'):</span> {{ $model->description }}
            </p>
            <span class="pull-right text-danger">{{ $model->is_disabled ? trans('content.disabled') : '' }}</span>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('backend.catalog-filter.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                    <a href="{{ route('backend.catalog-filter.destroy', $model->id) }}" class="btn btn-danger">@lang('content.delete')</a>
                </div>
                <div class="col-md-4">
                    <span class="text-muted pull-right">{{ $model->created }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection