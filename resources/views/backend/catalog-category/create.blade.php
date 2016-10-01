@extends('backend.layouts.main')

@section('title')
    @lang('category.new_title')
@endsection

@section('content')
    <h1>@lang('category.new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.catalog-category.form', ['model' => $model])
            @include('backend.includes.info-box')
        </div>
    </div>
@endsection