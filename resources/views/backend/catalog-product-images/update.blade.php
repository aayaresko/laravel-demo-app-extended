@extends('backend.layouts.main')

@section('title')
    @lang('catalog.product_images_update', ['product' => $model->visible_name ])
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@lang('catalog.product_images_update', ['product' => $model->visible_name ])</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-product-images.form')
        </div>
    </div>
@endsection