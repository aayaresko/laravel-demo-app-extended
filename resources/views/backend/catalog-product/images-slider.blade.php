<div id="product-images-carousel" class="carousel slide form-group">
    <ol class="carousel-indicators">
        @foreach ($images as $image)
            <li data-target="#images-carousel" data-slide-to="{{ $loop->index }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach ($images as $image)
            <?php $alt = $image->alt ? $image->alt : $model->visible_name ?>
            <div class="{{ $loop->index ? '' : 'active ' }}item">
                <a href="#" data-toggle="modal" data-target="#image-{{ $loop->index }}">
                    <img src="{{ $image->getImagePreviewPath('url') }}" alt="{{ $alt }}" class="img-responsive">
                </a>
                <div class="carousel-caption"></div>
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
    <a class="left carousel-control" href="#product-images-carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">@lang('content.previous')<</span>
    </a>
    <a class="right carousel-control" href="#product-images-carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">@lang('content.next')</span>
    </a>
</div>