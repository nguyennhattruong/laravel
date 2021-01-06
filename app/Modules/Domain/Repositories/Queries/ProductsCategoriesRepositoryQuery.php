<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Products;
use App\Modules\Domain\Models\ProductsCategories;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class ProductsCategoriesRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'title' => 'like',
        ];

        $conditions = $this->getCondition($defaults, $request);
        $conditions[] = $this->getConditionStatus($request->input('status'));

        if (!empty($lang = $this->getConditionLanguage($request->input('language')))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request->input('display'));

        return ProductsCategories::sortable()->where($conditions)
            ->orderBy('lft', 'ASC')
            ->paginate($display);
    }

    public function getListForControl($current_id = NULL) {
        $table = getTable(ProductsCategories::class);

        if (!is_null($current_id)) {
            $current = ProductsCategories::find($current_id);

            return ProductsCategories::whereRaw("id NOT IN (SELECT id 
                                                        FROM {$table} 
                                                        WHERE lft >= {$current->lft} 
                                                            AND rgt <= {$current->rgt})")->get()->sortBy('lft');
        } else {
            return ProductsCategories::all()->toArray();
        }
    }

    public function getListProductsByAlias($alias, $display = 10) {
        $category = $this->getByAlias($alias);

        if (empty($category)) {
            return [];
        }

        $where = [
            'category_id' => $category->id,
            'status' => 1
        ];

        return Products::where($where)->paginate($display);
    }

    public function getTotal() {
        return ProductsCategories::count();
    }

    public function getByAlias($alias) {
        return ProductsCategories::where([
            'alias' => $alias
        ])->first();
    }

    public function getAll() {
        return ProductsCategories::all();
    }
}

