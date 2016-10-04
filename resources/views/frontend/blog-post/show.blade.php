@extends('frontend.layouts.main')

@section('title')
    {{ $model->title }}
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ $model->title }}</h3>
        </div>
        <div class="panel-body">
            <div class="post-image">
                @if ($model->preview_image_url)
                    <p>
                        <img src="{{ $model->getImagePath('preview_image_url') }}" alt="{{ $model->title }}" class="img-rounded img-responsive">
                    </p>
                @endif
            </div>
            <div class="post-preview">
                {!! $model->preview_content !!}
            </div>
            <div class="post-content">
                {!! $model->content !!}
            </div>
            <div class="like-box pull-left">
                {!! $model->likes !!}
            </div>
            <div class="post-categories pull-right">
                @foreach($model->categories as $category)
                    <a href="{{ route('frontend.blog-post.index', $category->alias_name) }}" class="btn btn-default">{{$category->visible_name}}</a>
                @endforeach
            </div>
        </div>
        <div class="panel-footer">
            <p class="text-muted">@lang('content.created_by', [ 'author' => $model->author->profile->full_name ])
                , {{ $model->created }}</p>
            @can('update-own-post', $model)
                <a href="{{ route('frontend.blog-post.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
            @endcan
        </div>
    </div>
@endsection