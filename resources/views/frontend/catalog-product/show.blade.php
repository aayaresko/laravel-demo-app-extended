@extends('frontend.layouts.main')

@section('title')
    {{ $model->visible_name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1 tabs-container">
            @include('frontend.catalog-product.categories', ['models' => $categories])
            <h1>{{ $model->visible_name }}</h1>
            <div class="pull-right">
                {!! $model->likes !!}
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#all-about-product" aria-controls="all-about-product" role="tab" data-toggle="tab">
                        @lang('catalog.product_information')
                    </a>
                </li>
                <li role="presentation">
                    <a href="#characteristics" aria-controls="characteristics" role="tab" data-toggle="tab">
                        @lang('catalog.product_characteristics')
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="all-about-product">
                    <div class="row">
                        <div class="col-md-4">
                            @include('frontend.catalog-product.images-slider', ['model' => $model, 'images' => $images])
                        </div>
                        <div class="col-md-5">
                            {{ $model->description }}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="characteristics">
                    <h3>@lang('catalog.product_characteristics')</h3>
                    <div class="row">
                        <div class="col-md-8">
                            @include('frontend.catalog-product.properties-list', ['model' => $model, 'properties' => $properties])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection