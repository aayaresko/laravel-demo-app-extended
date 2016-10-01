<?php

namespace App\Http\Controllers\Frontend;

use App\Components\Facades\CatalogFilterFacade;
use App\Http\Controllers\Controller;
use App\Models\Entities\CatalogCategory;
use App\Models\Entities\CatalogFilter;
use App\Models\Entities\CatalogProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CatalogProductController extends Controller
{

    public function index(Request $request, $category = null, $filter = null)
    {
        /** @var Builder $query */
        $category = CatalogCategory::where('alias_name', '=', $category)->first();
        $query = CatalogProduct::distinct();
        $facade = new CatalogFilterFacade();
        if ($facade->parseFilterQuery($filter)) {
            $facade->attachConditionsToQuery($query, $category);
        }
        $filters = CatalogFilter::all();
        $categories = CatalogCategory::all();
        return view('frontend.catalog-product.index', [
            'models' => $query->get(),
            'filter_parameters' => $facade->getFilterParameters(),
            'filters' => $filters,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function show($identifier)
    {
        if (!(int)$identifier) {
            $model = CatalogProduct::where('alias_name', $identifier)->firstOrFail();
        } else {
            $model = CatalogProduct::findOrFail($identifier);
        }
        $categories = CatalogCategory::all();
        return view('frontend.catalog-product.show', [
            'model' => $model,
            'categories' => $categories,
            'images' => $model->images,
            'properties' => $model->properties
        ]);
    }
}
