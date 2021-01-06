<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Pages;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class PagesRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'title' => 'like',
        ];

        $defaults = $this->addPrefixKey($defaults, Pages::class);
        $input = $this->addPrefixKey($request->input(), Pages::class);

        $conditions = $this->getCondition($defaults, $input);

        $status = $this->addPrefixValue('status', Pages::class);
        $language = $this->addPrefixValue('language', Pages::class);

        $conditions[] = $this->getConditionStatus($request->input('status'), $status);

        if (!empty($lang = $this->getConditionLanguage($request->input('language'), $language))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request['display']);

        return Pages::sortable()->select('*')
                                ->where($conditions)
                                ->orderBy('id', 'DESC')
                                ->paginate($display);
    }

    public function getByAlias($alias) {
        $where = [
            'alias' => $alias,
            'status' => 1
        ];

        return Pages::where($where)->first();
    }
}
