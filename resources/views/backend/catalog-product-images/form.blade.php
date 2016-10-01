{{ Form::open(['method' => 'post', 'route' => ['backend.catalog-product-images.store', $model->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) }}
<div class="row">
    <div class="col-md-12">
        @if ($images)
            <div class="form-group">
                @foreach($images as $image)
                    <?php $alt = $image->alt ? $image->alt : $model->name ?>
                    <div class="col-md-3 alert" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ Form::hidden("assigned_images[{$image->id}]", $image->id, ['class' => 'dynamic-image', 'data-key' => $image->id]) }}
                        <a href="#" data-toggle="modal" data-target="#image-{{ $loop->index }}">
                            <img src="{{ $image->getImagePreviewPath('url') }}" alt="{{ $alt }}" class="img-rounded img-responsive">
                        </a>
                        <div id="image-{{ $loop->index }}" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labledby="{{ $alt }}">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4>{{ $alt }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ $image->getImagePath('url') }}" alt="{{ $alt }}" class="img-responsive">
                                    </div>
                                    <div class="modal-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::file('uploaded_images[]', ['multiple']) }}
        </div>
        <div class="form-group">
            {{ Form::submit(trans('content.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
{{ Form::close() }}