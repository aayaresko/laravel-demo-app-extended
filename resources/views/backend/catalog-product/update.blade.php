@extends('backend.layouts.main')

@section('title')
    @lang('catalog.product_update') '{{ $model->visible_name }}'
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@lang('catalog.product_update') '{{ $model->visible_name }}'</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-product.form')
        </div>
    </div>
@endsection