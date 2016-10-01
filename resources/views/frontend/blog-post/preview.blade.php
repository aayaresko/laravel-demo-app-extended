<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <a href="{{ route('frontend.blog-post.show', $model->alias_name) }}">
                {{ $model->title }}
            </a>
        </h3>
    </div>
    <div class="panel-body">
        <div class="post-image">
            @if ($model->preview_image_url)
                <p>
                    <a href="{{ route('frontend.blog-post.show', $model->alias_name) }}">
                        <img src="{{ $model->getImagePreviewPath('preview_image_url') }}" alt="{{ $model->title }}" class="img-rounded img-responsive">
                    </a>
                </p>
            @endif
        </div>
        <div class="post-content">
            {!! $model->preview !!}
            <a href="{{ route('frontend.blog-post.show', $model->alias_name) }}">@lang('blog.read_more_title')</a>
        </div>
        <div class="like-box pull-left">
            {!! $model->likes !!}
        </div>
        <div class="post-categories pull-right">
            @foreach($model->categories as $category)
                <a href="{{ route('frontend.blog-post.index', $category->alias_name) }}" class="btn btn-default">{{$category->visible_name}}</a>
            @endforeach
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-4">
                @can('update-own-post', $model)
                    <a href="{{ route('frontend.blog-post.edit', $model->id) }}" class="btn btn-primary">@lang('content.edit')</a>
                @endcan
            </div>
            <div class="col-md-8">
                <p class="text-muted pull-right">@lang('content.created_by', [ 'author' => $model->author->profile->full_name ]), {{ $model->created }}</p>
            </div>
        </div>
    </div>
</div>