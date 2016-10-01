@extends('backend.layouts.main')

@section('title')
    @choice('content.filter', 2)
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('backend.includes.info-box')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('create', App\Models\Entities\CatalogFilter::class)
                <p>
                    <a href="{{ route('backend.catalog-filter.create') }}" class="btn btn-primary">@lang('filter.new_title')</a>
                </p>
            @endcan
        </div>
    </div>
    <div class="table-responsive">
        {{ $table->renderTable() }}
        {{ $table->renderLinks() }}
    </div>
@endsection