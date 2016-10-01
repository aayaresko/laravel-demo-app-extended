@extends('frontend.layouts.main')

@section('title')
    @lang('blog.title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('frontend.includes.info-box')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('create', $models->first())
                <p>
                    <a href="{{ route('frontend.blog-post.create') }}" class="btn btn-primary">@lang('blog.new_title')</a>
                </p>
            @endcan
        </div>
    </div>
    <div class="row">
        @if (count($models))
            @foreach($models->chunk(3) as $set)
                @foreach($set as $model)
                    <div class="col-md-4">
                        @include('frontend.blog-post.preview', ['model' => $model])
                    </div>
                @endforeach
                <div class="clearfix"></div>
            @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $models->links() }}
        </div>
    </div>
@endsection