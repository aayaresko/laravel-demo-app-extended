@extends('backend.layouts.main')

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
            <div class="post-content">
                {!! $model->content !!}
            </div>
            <div class="post-categories pull-right">
                @foreach($model->categories as $category)
                    <a href="{{ route('backend.blog-post.index', $category->alias_name) }}" class="btn btn-default">{{$category->visible_name}}</a>
                @endforeach
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('backend.blog-post.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                    <a href="{{ route('backend.blog-post.destroy', $model->id) }}" class="btn btn-danger">@lang('content.delete')</a>
                </div>
                <div class="col-md-4">
                    <span class="text-muted pull-right">
                        <a href="{{ route('backend.account.show', $model->author_id) }}">{{ $model->author->profile->full_name }}</a>, {{ $model->created }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection