@extends('backend.layouts.main')

@section('title')
    @lang('blog.title')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('backend.includes.info-box')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('create', App\Models\Entities\BlogPost::class)
                <p>
                    <a href="{{ route('backend.blog-post.create') }}" class="btn btn-primary">@lang('blog.new_title')</a>
                </p>
            @endcan
        </div>
    </div>
    @if (count($models))
        <div class="row">
            @foreach($models->chunk(3) as $set)
                @foreach($set as $model)
                    <div class="col-md-4">
                        @include('backend.blog-post.preview', ['model' => $model])
                    </div>
                @endforeach
                <div class="clearfix"></div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $models->links() }}
            </div>
        </div>
    @else
        <div class="row">
            <p>@lang('content.no_models')</p>
        </div>
    @endif
@endsection