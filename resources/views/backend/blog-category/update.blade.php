@extends('backend.layouts.main')

@section('title')
    @lang('category.update') '{{ $model->visible_name }}'
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@lang('category.update') '{{ $model->visible_name }}'</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.blog-category.form', ['model' => $model])
        </div>
    </div>
@endsection