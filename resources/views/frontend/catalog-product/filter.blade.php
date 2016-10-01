@foreach($models as $model)
    <p>{!! $model->getFilterTitle($category, $filter_parameters) !!}</p>
@endforeach
