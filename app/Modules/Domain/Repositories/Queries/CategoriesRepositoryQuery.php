<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Categories;
use App\Modules\Domain\Models\Content;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class CategoriesRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getAll() {
        return Categories::all();
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

        return Categories::sortable()->where($conditions)
                                     ->orderBy('lft', 'ASC')
                                     ->paginate($display);
    }

    public function getListForControl($current_id = NULL) {
        $table = getTable(Categories::class);

        if (!is_null($current_id)) {
            $current = Categories::find($current_id);

            return Categories::whereRaw("id NOT IN (SELECT id 
                                                        FROM {$table} 
                                                        WHERE lft >= {$current->lft} 
                                                            AND rgt <= {$current->rgt})")->get()->sortBy('lft');
        } else {
            return Categories::all()->toArray();
        }
    }

    public function getListContentByAlias($alias, $display = 10) {
        $category = $this->getByAlias($alias);

        if (empty($category)) {
            return [];
        }

        $where = [
            'category_id' => $category->id,
            'status' => 1
        ];

        return Content::where($where)->paginate($display);
    }

    public function getTotal() {
        return Categories::count();
    }

    public function getByAlias($alias) {
        return Categories::where([
            'alias' => $alias
        ])->first();
    }
}

