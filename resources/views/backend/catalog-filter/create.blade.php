@extends('backend.layouts.main')

@section('title')
    @lang('filter.new_title')
@endsection

@section('content')
    <h1>@lang('filter.new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-filter.form', ['model' => $model, 'categories' => $categories, 'catalog_categories' => $catalog_categories])
            @include('backend.includes.info-box')
        </div>
    </div>
@endsection