@extends('backend.layouts.main')

@section('title')
    @lang('blog.post_update') '{{ $model->title }}'
@endsection

@section('content')
    @include('backend.includes.info-box')
    <h1>@lang('blog.post_update') '{{ $model->title }}'</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.blog-post.form')
        </div>
    </div>
@endsection