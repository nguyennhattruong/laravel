<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Categories;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;
use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;

class CategoriesRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    public function insert($input) {
        $category = new Categories();
        $category = $this->getItems($category, ['title', 'alias', 'parent_id', 'description'], $input);
        $category->status = $this->getStatus($input['status']);
        $category->language = $this->getLang($input['language']);

        if ($category->save()) {
            if (!is_null($input['parent_id'])) {
                $service = new CategoriesServiceQuery();
                $parent = $service->getById($input['parent_id']);

                return $category->makeChildOf($parent);
            } else {
                return $category->makeRoot();
            }
        }

        return false;
    }

    public function update($input) {
        $service = new CategoriesServiceQuery();
        $node = $service->getById($input['id']);
        $node = $this->getItems($node, ['title', 'alias', 'parent_id', 'description'], $input);
        $node->status = $this->getStatus($input['status']);
        $node->language = $this->getLang($input['language']);

        if ($node->save()) {
            if (!is_null($input['parent_id'])) {
                $parent = $service->getById($input['parent_id']);

                return $node->makeChildOf($parent);
            } else {
                return $node->makeRoot();
            }
        }

        return false;
    }

    public function delete($id) {
        try {
            return Categories::find($id)->delete();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update_status($id, $status) {
        return Categories::where('id', $id)->update(['status' => $status]);
    }
}
