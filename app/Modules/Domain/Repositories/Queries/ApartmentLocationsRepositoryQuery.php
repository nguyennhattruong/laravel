<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\ApartmentLocations;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class ApartmentLocationsRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'name' => 'like',
        ];

        $defaults = $this->addPrefixKey($defaults, ApartmentLocations::class);
        $input = $this->addPrefixKey($request->input(), ApartmentLocations::class);

        $conditions = $this->getCondition($defaults, $input);

        $status = $this->addPrefixValue('status', ApartmentLocations::class);
        $language = $this->addPrefixValue('language', ApartmentLocations::class);

        $conditions[] = $this->getConditionStatus($request->input('status'), $status);

        if (!empty($lang = $this->getConditionLanguage($request->input('language'), $language))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request['display']);

        return ApartmentLocations::sortable()->select('*')
                                ->where($conditions)
                                ->orderBy('id', 'DESC')
                                ->paginate($display);
    }

    public function getById($id) {
        return ApartmentLocations::find($id);
    }

    public function getAll() {
        return ApartmentLocations::all();
    }

    public function getListFrontend($limit = 12) {
        $where = [
            'status' => 1
        ];
        return ApartmentLocations::where($where)->paginate($limit);
    }

    public function getByAlias($alias) {
        $where = [
            'alias' => $alias,
            'status' => 1
        ];

        return ApartmentLocations::where($where)->first();
    }
}
