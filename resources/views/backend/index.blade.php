@extends('backend.layouts.main')

@section('title')
    @lang('content.control_panel_title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <a href="{{ route('backend.blog-post.create') }}" class="btn btn-primary">@lang('blog.new_title')</a>
                        <a href="{{ route('backend.blog-post.index') }}" class="btn btn-success">@choice('blog.post', 2)</a>
                    </p>
                    @if (count($posts))
                        @each('backend.blog-post.preview', $posts, 'model')
                    @else
                        <p>@lang('content.no_models')</p>
                    @endif
                </div>
            </div>
        </div>
        <dic class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <a href="{{ route('backend.catalog-product.create') }}" class="btn btn-primary">@lang('catalog.new_title')</a>
                        <a href="{{ route('backend.catalog-product.index') }}" class="btn btn-success">@choice('catalog.product', 2)</a>
                    </p>
                    @if (count($products))
                        @each('backend.catalog-product.preview', $products, 'model')
                    @else
                        <p>@lang('content.no_models')</p>
                    @endif
                </div>
            </div>
        </dic>
    </div>
@endsection