@extends('backend.layouts.main')

@section('title')
    @lang('blog.new_title')
@endsection

@section('content')
    <h1>@lang('blog.new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('backend.blog-post.form', ['authors' => $authors, 'categories' => $categories])
            @include('backend.includes.info-box')
        </div>
    </div>
@endsection