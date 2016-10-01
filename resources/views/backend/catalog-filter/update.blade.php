@extends('backend.layouts.main')

@section('title')
    @lang('filter.update') '{{ $model->title }}'
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@lang('filter.update') '{{ $model->title }}'</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-filter.form', ['model' => $model, 'categories' => $categories, 'catalog_categories' => $catalog_categories])
        </div>
    </div>
@endsection