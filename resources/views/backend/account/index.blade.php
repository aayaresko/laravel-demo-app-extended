@extends('backend.layouts.main')

@section('title')
    @choice('account.title', 2)
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('backend.includes.info-box')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('create', App\Models\Entities\Account::class)
                <p>
                    <a href="{{ route('backend.account.create') }}" class="btn btn-primary">@lang('account.new_title')</a>
                </p>
            @endcan
        </div>
    </div>
    <div class="table-responsive">
        {{ $table->renderTable() }}
        {{ $table->renderLinks() }}
    </div>
@endsection