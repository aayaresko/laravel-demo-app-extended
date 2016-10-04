@extends('backend.layouts.main')

@section('title')
    {{ $model->visible_name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $model->visible_name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="post-content">
                                {{ $model->description }}
                            </p>
                            <hr>
                            @if (isset($properties) && count($properties))
                                <h4>@choice('content.property', 2)</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('backend.catalog-product.properties-list', ['model' => $model, 'properties' => $properties])
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="post-image">
                                <p>
                                    @if ($model->image_url)
                                        <img src="{{ $model->getImagePath('image_url') }}" alt="{{ $model->name }}" class="img-rounded img-responsive">
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if (isset($images) && count($images))
                                <h4>@choice('content.image', 2)</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('backend.catalog-product.images-slider', ['model' => $model, 'images' => $images])
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="{{ route('backend.catalog-product.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                            <a href="{{ route('backend.catalog-product.destroy', $model->id) }}" class="btn btn-danger">@lang('content.delete')</a>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted pull-right">
                                {{ $model->created }}
                                , <a href="{{ route('backend.account.show', $model->author_id) }}">{{ $model->author->profile->full_name }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection