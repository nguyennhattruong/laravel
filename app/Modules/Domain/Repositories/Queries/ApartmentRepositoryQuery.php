<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Apartment;
use App\Modules\Domain\Services\Queries\ApartmentCategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ApartmentServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class ApartmentRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'name' => 'like',
            'category_id' => '='
        ];

        $defaults = $this->addPrefixKey($defaults, Apartment::class);
        $input    = $this->addPrefixKey($request->input(), Apartment::class);
        $status   = $this->addPrefixValue('status', Apartment::class);
        $language = $this->addPrefixValue('language', Apartment::class);

        $conditions   = $this->getCondition($defaults, $input);
        $conditions[] = $this->getConditionStatus($request->input('status'), $status);

        if (!empty($lang = $this->getConditionLanguage($request->input('language'), $language))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request['display']);
        $columns = ['id', 'alias', 'name', 'images', 'language', 'created_at', 'hits', 'status'];
        $columns = $this->addPrefixValue($columns, Apartment::class);

        return Apartment::sortable()->select($columns)
                                   ->where($conditions)
                                   ->orderBy($columns[0], 'DESC')
                                   ->paginate($display);
    }

    public function getListByIn($ids) {
        return Apartment::whereIn('id', $ids)->get();
    }

    public function getById($id) {
        return Apartment::find($id);
    }

    public function getByAlias($alias) {
        $where = [
            'alias' => $alias,
            'status' => 1
        ];

        return Apartment::where($where)->first();
    }

    public function getTotal() {
        return Apartment::count();
    }

    public function getListByTypeId($id, $limit = 10) {
        $where = [
            'type_id' => $id,
            'status' => 1
        ];

        return Apartment::where($where)->orderByDesc('id')
                                       ->paginate($limit);
    }

    public function getListForFrontend($id) {
        $where = [
            'type_id' => $id,
            'status' => 1
        ];

        return Apartment::where($where)->orderByDesc('id')
                                       ->paginate(16);
    }

    public function getListByWidget($input) {

        $limit = $input['quantity'];
        unset($input['quantity']);

        $where = $input + ['status' => 1];

        return Apartment::where($where)->limit($limit)
                                      ->orderByDesc('id')
                                      ->get();
    }

    public function getListByLocation($locationId, $limit = 3) {
        $where = [
            'location_id' => $locationId,
            'status' => 1
        ];

        return Apartment::where($where)->limit($limit)
                                       ->orderByDesc('id')
                                       ->get();
    }

    public function search($input) {
        $defaults = [
            'name' => 'like',
            'type_id' => '',
            'bathroom' => '',
            'bedroom' => '',
            'label_id' => '=',
            'state' => ''
        ];

        $defaults = $this->addPrefixKey($defaults, Apartment::class);
        $input    = $this->addPrefixKey($input, Apartment::class);

        $conditions   = $this->getCondition($defaults, $input);

        $columns = ['*'];
        $columns = $this->addPrefixValue($columns, Apartment::class);

        $query = Apartment::sortable()->select($columns)
                                    ->where($conditions)
                                    ->orderBy('id', 'DESC');

        if (!empty($input['co_apartment.location_ids'])) {
            $query->whereIn('location_id', $input['co_apartment.location_ids']);
        }

        if (!empty($input['co_apartment.year'])) {
            foreach ($input['co_apartment.year'] as $key => $value) {
                if ($value == '') {
                    $input['co_apartment.year'][$key] = 0;
                }
            }
        }

        if (!empty($input['co_apartment.land_size'])) {
            foreach ($input['co_apartment.land_size'] as $key => $value) {
                if ($value == '') {
                    $input['co_apartment.land_size'][$key] = 0;
                }
            }
        }

        if ($input['co_apartment.land_size'][0] != 0 || $input['co_apartment.land_size'][1] != 0) {
            $query->whereBetween('land_size', $input['co_apartment.land_size']);
        }

        return $query->paginate(10);
    }
}
