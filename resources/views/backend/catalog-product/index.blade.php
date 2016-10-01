@extends('backend.layouts.main')

@section('title')
    @choice('catalog.product', 2)
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('backend.includes.info-box')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('create', App\Models\Entities\CatalogProduct::class)
                <p>
                    <a href="{{ route('backend.catalog-product.create') }}" class="btn btn-primary">@lang('catalog.new_title')</a>
                </p>
            @endcan
        </div>
    </div>
    @if (count($models))
        <div class="row">
            @foreach($models->chunk(3) as $set)
                @foreach($set as $model)
                    <div class="col-md-4">
                        @include('backend.catalog-product.preview', ['model' => $model])
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