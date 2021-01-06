<?php

namespace App\Modules\Application\Controllers\Frontend;

use App\Modules\Domain\Repositories\Queries\ApartmentTypesRepositoryQuery;
use App\Modules\Domain\Services\Queries\ApartmentLocationsServiceQuery;
use App\Modules\Infrastructure\Core\IController;

class ApartmentLocationsController extends IController
{
    private $service;

    function __construct(ApartmentTypesRepositoryQuery $type) {
        parent::__construct();
        $this->service = new ApartmentLocationsServiceQuery();
    }

    public function locations() {
        $list = $this->service->getListFrontend();
        return iView('apartment_locations.list', [
            'list' => $list,
        ]);
    }

    public function show($alias) {
        $content = $this->service->getByAlias($alias);

        $content->content = json_decode($content->content);

        if ($result = json_decode($content->content->utilityImage)) {
            $content->content->utilityImage = $result;
        } else {
            $content->content->utilityImage = [$content->content->utilityImage];
        }

        if ($result = json_decode($content->content->oneImage)) {
            $content->content->oneImage = $result;
        } else {
            $content->content->oneImage = [$content->content->oneImage];
        }

        if ($result = json_decode($content->content->twoImage)) {
            $content->content->twoImage = $result;
        } else {
            $content->content->twoImage = [$content->content->twoImage];
        }

        if ($result = json_decode($content->content->threeImage)) {
            $content->content->threeImage = $result;
        } else {
            $content->content->threeImage = [$content->content->threeImage];
        }

        if ($result = json_decode($content->content->officeImage)) {
            $content->content->officeImage = $result;
        } else {
            $content->content->officeImage = [$content->content->officeImage];
        }

        return iView('apartment_locations.detail', [
            'data' => $content,
        ]);
    }
}
