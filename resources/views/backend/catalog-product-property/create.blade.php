@extends('backend.layouts.main')

@section('title')
    @lang('catalog.product_property_title')
@endsection

@section('content')
    <h1>@lang('catalog.product_property_new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-product-property.form')
            @include('backend.includes.info-box')
        </div>
    </div>
@endsection