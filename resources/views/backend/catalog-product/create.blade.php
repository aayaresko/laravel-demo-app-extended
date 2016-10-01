@extends('backend.layouts.main')

@section('title')
    @lang('catalog.new_title')
@endsection

@section('content')
    <h1>@lang('catalog.new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-product.form', ['authors' => $authors, 'categories' => $categories])
            @include('backend.includes.info-box')
        </div>
    </div>
@endsection