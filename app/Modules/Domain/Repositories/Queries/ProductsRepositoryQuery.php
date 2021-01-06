<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Products;
use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class ProductsRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'title' => 'like',
            'category_id' => '='
        ];

        $defaults = $this->addPrefixKey($defaults, Products::class);
        $input    = $this->addPrefixKey($request->input(), Products::class);
        $status   = $this->addPrefixValue('status', Products::class);
        $language = $this->addPrefixValue('language', Products::class);

        $conditions   = $this->getCondition($defaults, $input);
        $conditions[] = $this->getConditionStatus($request->input('status'), $status);

        if (!empty($lang = $this->getConditionLanguage($request->input('language'), $language))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request['display']);
        $columns = ['id', 'alias', 'title', 'category_id', 'images', 'language', 'created_at', 'hits', 'status'];
        $columns = $this->addPrefixValue($columns, Products::class);

        return Products::sortable()->select($columns)
                                   ->where($conditions)
                                   ->orderBy($columns[0], 'DESC')
                                   ->paginate($display);
//        dd($result);
    }

    public function getListByIn($ids) {
        return Products::whereIn('id', $ids)->get();
    }

    public function getById($id) {
        return Products::find($id);
    }

    public function getByAlias($alias) {
        $where = [
            'alias' => $alias,
            'status' => 1
        ];

        return Products::where($where)->first();
    }

    public function getTotal() {
        return Products::count();
    }

    public function getListByCategoryId($id, $limit = 10) {
        $where = [
            'category_id' => $id,
            'status' => 1
        ];

        return Products::where($where)->limit($limit)
                                      ->orderByDesc('id')
                                      ->get()
                                      ->toArray();
    }

    public function getListForFrontend($id) {
        $where = [
            'category_id' => $id,
            'status' => 1
        ];

        return Products::where($where)->orderByDesc('id')
                                      ->paginate(8);
    }

    public function getListByWidget($input) {
        $service = new ProductsCategoriesServiceQuery();
        $list = $service->getDescendantsAndSelf($input['category']);

        $ids = [];
        foreach ($list as $item) {
            $ids[] = $item->id;
        }

        $where = [
            'status' => 1
        ];
        return Products::where($where)->whereIn('category_id', $ids)
//                                      ->limit($input['quantity'])
                                      ->orderByDesc('id')
                                      ->paginate($input['quantity']);
//                                      ->get();
    }
}
