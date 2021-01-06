<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Categories;
use App\Modules\Domain\Models\Content;
use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class ContentRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'title' => 'like',
            'category_id' => '='
        ];

        $defaults = $this->addPrefixKey($defaults, Content::class);
        $input = $this->addPrefixKey($request->input(), Content::class);

        $conditions = $this->getCondition($defaults, $input);

        $status = $this->addPrefixValue('status', Content::class);
        $language = $this->addPrefixValue('language', Content::class);

        $conditions[] = $this->getConditionStatus($request->input('status'), $status);

        if (!empty($lang = $this->getConditionLanguage($request->input('language'), $language))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request['display']);
        $columns = ['id', 'alias', 'title', 'image', 'category_id', 'author', 'language', 'created_at', 'hits', 'status'];
        $columns = $this->addPrefixValue($columns, Content::class);

        return Content::sortable()->select($columns)
                                  ->where($conditions)
                                  ->orderBy($columns[0], 'DESC')
                                  ->paginate($display);
    }

    public function getById($id) {
        return Content::find($id);
    }

    public function getByAlias($alias) {
        $where = [
            'alias' => $alias,
            'status' => 1
        ];

        return Content::where($where)->first();
    }

    public function getWhereIn($ids) {
        return Content::whereIn('category_id', $ids)->paginate();
    }

    public function getTotal() {
        return Content::count();
    }

    public function getListByCategoryId($id) {
        $where = [
            'category_id' => $id,
            'status' => 1
        ];
        
        return Content::where($where)->limit(10)
                                     ->orderByDesc('id')
                                     ->get()
                                     ->toArray();
    }

    /**
     * Get list by widget config
     *
     * @param $input ['category', 'quantity']
     * @return array
     */
    public function getListByWidget($input) {
        $service = new CategoriesServiceQuery();
        $list = $service->getDescendantsAndSelf($input['category']);

        $ids = [];
        foreach ($list as $item) {
            $ids[] = $item->id;
        }

        $where = [
            'status' => 1
        ];

        return Content::where($where)->whereIn('category_id', $ids)
                                     ->limit($input['quantity'])
                                     ->orderByDesc('id')
                                     ->get();
    }
}
