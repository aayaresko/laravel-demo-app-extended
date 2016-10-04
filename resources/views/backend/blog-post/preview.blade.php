<div class="panel panel-default preview">
    <div class="panel-heading">
        <h3>{{ $model->title }}</h3>
    </div>
    <div class="panel-body">
        <div class="post-image">
            @if ($model->preview_image_url)
                <p>
                    <img src="{{ $model->getImagePreviewPath('preview_image_url') }}" alt="{{ $model->title }}" class="img-rounded img-responsive">
                </p>
            @endif
        </div>
        <div class="post-content">
            {!! $model->preview !!}
            <a href="{{ route('frontend.blog-post.show', $model->alias_name) }}">@lang('blog.read_more_title')</a>
        </div>
        <div class="post-categories pull-right">
            @foreach($model->categories as $category)
                <a href="{{ route('backend.blog-post.index', $category->alias_name) }}" class="btn btn-default">{{$category->visible_name}}</a>
            @endforeach
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-7">
                <a href="{{ route('backend.blog-post.show', $model->id) }}" class="btn btn-success btn-sm">@lang('content.view')</a>
                <a href="{{ route('backend.blog-post.edit', $model->id) }}" class="btn btn-primary btn-sm">@lang('content.edit')</a>
                <a href="{{ route('backend.blog-post.destroy', $model->id) }}" class="btn btn-danger btn-sm">@lang('content.delete')</a>
            </div>
            <div class="col-md-5">
                <span class="text-muted pull-right">
                    {{ $model->created }}
                    <br><a href="{{ route('backend.account.show', $model->author_id) }}">{{ $model->author->profile->full_name }}</a>
                </span>
            </div>
        </div>
    </div>
</div>