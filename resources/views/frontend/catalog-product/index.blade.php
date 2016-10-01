@extends('frontend.layouts.main')

@section('title')
    {{ $category ? $category->visible_name : trans('catalog.title') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-12">
                            @include('frontend.catalog-product.categories', ['models' => $categories])
                        </div>
                    </div>
                    <hr>
                    @if ($category)
                        <div class="row">
                            <div class="col-md-12">
                                @include('frontend.catalog-product.filter', ['models' => $filters, 'filter_parameters' => $filter_parameters, 'category' => $category])
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h1>{{ $category ? $category->visible_name : trans('catalog.title') }}</h1>
                    @if (count($models) > 0)
                        <div class="row">
                            @foreach($models->chunk(3) as $set)
                                @foreach($set as $model)
                                    <div class="col-md-4">
                                        @include('frontend.catalog-product.preview', ['model' => $model])
                                    </div>
                                @endforeach
                                <div class="clearfix"></div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection