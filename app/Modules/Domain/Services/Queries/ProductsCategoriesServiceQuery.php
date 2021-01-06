<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Models\ProductsCategories;
use App\Modules\Domain\Repositories\Queries\ProductsCategoriesRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class ProductsCategoriesServiceQuery extends ServiceQuery
{
    function __construct() {
        $this->_repository = new ProductsCategoriesRepositoryQuery();
    }

    public function getAll() {
        return $this->_repository->getAll();
    }

    public function getList($input) {
        return $this->_repository->getList($input);
    }

    public function getListForControl($current_id = NULL) {
        $result = [];
        $list = $this->_repository->getListForControl($current_id);

        foreach ($list as $item) {
            $result[$item['id']] = str_repeat('- ', $item['depth']) . $item['title'];
        }

        return $result;
    }

    public function getListContentByAlias($alias, $display) {
        return $this->_repository->getListContentByAlias($alias, $display);
    }

    public function getById($id) {
        return ProductsCategories::find($id);
    }

    public function getByAlias($alias) {
        return $this->_repository->getByAlias($alias);
    }

    public function getTotal() {
        return $this->_repository->getTotal();
    }

    public function getAncestors($id) {
        return ProductsCategories::find($id)->getAncestors();
    }

    public function getSiblingsAndSelf($id) {
        return ProductsCategories::find($id)->getSiblingsAndSelf();
    }

    public function getAncestorsAndSelf($id) {
        return ProductsCategories::find($id)->getAncestorsAndSelf();
    }

    public function getDescendantsAndSelf($id) {
        if (!is_null(ProductsCategories::find($id)->getDescendantsAndSelf()))
            return ProductsCategories::find($id)->getDescendantsAndSelf();
        return true;
    }

    public function buildMenu($node) {
        if ($node->isLeaf()) {
            return "<li>
                        <a href=\"" . route('FrontendProductCategory', $node->alias) . "\">
                            <i class=\"{$node->icon} mr-1\" aria-hidden=\"true\"></i> {$node->title}
                        </a>
                    </li>";
        } else {
            $html = "<li>
                         <a href=\"" . route('FrontendProductCategory', $node->alias) . "\">
                             <i class=\"{$node->icon} mr-1\" aria-hidden=\"true\"></i> {$node->title}
                         </a>
                     <ul>";
            foreach ($node->children as $child) {
                $html .= $this->buildMenu($child);
            }
            $html .= '</ul>';
            $html .= '</li>';
        }

        return $html;
    }
}
