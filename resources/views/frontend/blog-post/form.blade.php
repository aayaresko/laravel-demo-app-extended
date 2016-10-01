@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.multiple-select').select2({
                placeholder: '@lang('content.select_placeholder')',
                allowClear: false
            });
            jQuery('#content').ckeditor();
            jQuery('#preview_content').ckeditor();
        });
    </script>
@endsection

@if ($model->id)
    <?php $route = ['frontend.blog-post.update', $model->id] ?>
@else
    <?php $route = 'frontend.blog-post.store' ?>
@endif
{{ Form::open(['method' => 'post', 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) }}
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('title', trans('blog.title_label'), ['class' => 'control-label']) }}
            {{ Form::text('title', $model->title, ['placeholder' => trans('blog.title_placeholder'), 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('categories[]', trans_choice('content.category', 2), ['class' => 'control-label']) }}
            {{ Form::select('categories[]', $categories, $model->categories()->pluck('id')->all(), ['multiple', 'class' => 'multiple-select js-example-basic-single js-states form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('is_published', trans('blog.post_is_published'), ['class' => 'control-label']) }}
            {{ Form::select('is_published', [ 0 => trans('content.no'), 1 => trans('content.yes') ], $model->is_published, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('preview_content', trans('blog.preview_content_label'), ['class' => 'control-label']) }}
            {{ Form::textarea('preview_content', $model->preview_content, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-7">
        @if ($model->preview_image_url)
            <img src="{{ $model->getImagePath('preview_image_url') }}" alt="{{ $model->title }}" class="img-responsive img-rounded">
        @endif
        <p>
            {{ Form::label('preview', trans('blog.preview_image_label'), ['class' => 'control-label']) }}
            {{ Form::file('preview') }}
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('content', trans('blog.content_label'), ['class' => 'control-label']) }}
            {{ Form::textarea('content', $model->content, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
{{ Form::close() }}