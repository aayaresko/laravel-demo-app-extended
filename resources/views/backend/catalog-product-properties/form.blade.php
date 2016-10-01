@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/select2/select2.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.multiple-select').select2({
                placeholder: '@lang('content.select_placeholder')',
                allowClear: false
            });
        });
    </script>
@endsection

{{ Form::open(['method' => 'post', 'route' => ['backend.catalog-product-properties.store', $model->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::select('properties[]', $available_properties, $model->properties()->pluck('property_id')->all(), ['multiple', 'class' => 'multiple-select js-example-basic-single js-states form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
{{ Form::close() }}