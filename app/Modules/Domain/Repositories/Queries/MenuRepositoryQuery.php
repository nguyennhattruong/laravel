<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Menu;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class MenuRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'title' => 'like',
            'menutype_id' => '='
        ];

        $conditions = $this->getCondition($defaults, $request);
        $conditions[] = $this->getConditionStatus($request->input('status'));

        if (!empty($lang = $this->getConditionLanguage($request->input('language')))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request->input('display'));

        return Menu::sortable()->where($conditions)
                               ->orderBy('lft', 'ASC')
                               ->paginate($display);
    }

    public function getListParents($current_id) {
        $table = getTable(Menu::class);

        if (!empty($current = Menu::find($current_id))) {
            return Menu::whereRaw("id NOT IN (SELECT id 
                                              FROM {$table} 
                                              WHERE lft >= {$current->lft} 
                                                  AND rgt <= {$current->rgt})")->get()
                                                                               ->sortBy('lft');
        }

        return Menu::all()->sortBy('lft');
    }

    public function getByAlias($alias) {
        return Menu::where(['alias' => $alias])->first();
    }

    public function getListByType($id) {
        $where = [
            ['menutype_id', '=', $id],
            ['status', '=', 1],
        ];
        return Menu::where($where)->orderBy('lft', 'ASC')
                                  ->get();
    }

    public function getRootsNotSelf($id) {
        return Menu::whereNull('parent_id')->where([['id', '<>', $id]])
                                                  ->orderBy('lft', 'ASC')
                                                  ->get();
    }

    public function getPrevSibling($id) {
        $menu = Menu::find($id);
        $where = [
            ['lft', '<', $menu->lft],
            ['depth', '=', $menu->depth]
        ];

        return Menu::where($where)->orderBy('lft', 'DESC')->first();
    }

    public function getNextSibling($id) {
        $menu = Menu::find($id);
        $where = [
            ['lft', '>', $menu->lft],
            ['depth', '=', $menu->depth]
        ];

        return Menu::where($where)->orderBy('lft', 'ASC')->first();
    }
}
