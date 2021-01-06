<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\ProductsCategories;
use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class ProductsCategoriesRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    public function insert($input) {
        $category = new ProductsCategories();
        $category = $this->getItems($category, ['title', 'alias', 'parent_id', 'description'], $input);
        $category->status = $this->getStatus($input['status']);
        $category->language = $this->getLang($input['language']);

        if ($category->save()) {
            if (!is_null($input['parent_id'])) {
                $service = new ProductsCategoriesServiceQuery();
                $parent = $service->getById($input['parent_id']);

                return $category->makeChildOf($parent);
            } else {
                return $category->makeRoot();
            }
        }

        return false;
    }

    public function update($input) {
        $service = new ProductsCategoriesServiceQuery();
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
        return ProductsCategories::destroy($id);
    }

    public function update_status($id, $status) {
        return ProductsCategories::where('id', $id)->update(['status' => $status]);
    }
}
