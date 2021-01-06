<?php

namespace App\Modules\Application\Controllers\Frontend;

use App\Modules\Domain\Models\ApartmentUtilities;
use App\Modules\Domain\Models\AttributesValues;
use App\Modules\Domain\Repositories\Queries\ApartmentTypesRepositoryQuery;
use App\Modules\Domain\Services\Queries\ApartmentServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentController extends IController
{
    private $service;
    private $repository;

    function __construct(ApartmentTypesRepositoryQuery $type) {
        parent::__construct();
        $this->service = new ApartmentServiceQuery();
        $this->repository = $type;
    }

    public function show($alias) {
        $content = $this->service->getByAlias($alias);

        // Features
        $features = DB::table('co_apartment_utilities')
            ->join('co_attributes_values', 'co_apartment_utilities.attribute_id', '=', 'co_attributes_values.id')
            ->where('apartment_id', $content->id)
            ->pluck('co_attributes_values.name', 'co_attributes_values.id')->toArray();

        $featuresAll = DB::table('co_attributes_values')
            ->join('co_attributes', 'co_attributes_values.attribute_id', '=', 'co_attributes.id')
            ->where('co_attributes.column_name', 'utility')
            ->pluck('co_attributes_values.name', 'co_attributes_values.id')->toArray();

        return iView('apartment.detail', [
            'data' => $content,
            'features' => $features,
            'featuresAll' => $featuresAll,
        ]);
    }

    public function type($alias) {
        // Check apartment type
        if (empty($type = $this->repository->findByAlias($alias))) {
            return $this->redirectHome();
        }

        return iView('apartment.type', [
            'list' => $this->service->getListByTypeId($type->id),
            'type' => $type
        ]);
    }

    public function search(Request $request) {

        $input = [
            'name' => $request->input('keyword'),
            'type_id' => $request->input('type'),
            'location_ids' => $request->input('location'),
            'year' => $request->input('year'),
            'bedroom' => $request->input('bedroom'),
            'bathroom' => $request->input('bathroom'),
            'land_size' => $request->input('land_size'),
            'label_id' => $request->input('label'),
            'state' => $request->input('state'),
        ];

        return iView('apartment.search', [
            'list' => $this->service->search($input),
            'keyword' => $request->input('keyword')
        ]);
    }
}
