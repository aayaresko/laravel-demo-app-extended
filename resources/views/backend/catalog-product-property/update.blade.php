@extends('backend.layouts.main')

@section('title')
    @choice('catalog.property_update', 1, ['property' => $model->visible_name])
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@choice('catalog.property_update', 1, ['property' => $model->visible_name])</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-product-property.form', ['model' => $model, 'categories' => $categories])
        </div>
    </div>
@endsection