@extends('frontend.layouts.main')

@section('title')
    @lang('blog.new_title')
@endsection

@section('content')
    <h1>@lang('blog.new_title')</h1>
    <div class="row">
        <div class="col-md-12">
            @include('frontend.blog-post.form')
            @include('frontend.includes.info-box')
        </div>
    </div>
@endsection