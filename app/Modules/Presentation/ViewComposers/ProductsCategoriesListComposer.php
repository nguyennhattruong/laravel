<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use Illuminate\View\View;

class ProductsCategoriesListComposer
{
    public function compose(View $view) {
        $menu = '';
        $service = new ProductsCategoriesServiceQuery();
        $categories = $service->getAll()->toHierarchy();

        foreach ($categories as $node) {
            $menu .= $this->buildMenu($node);
        }

        $view->with('data', $menu);
    }

    private function buildMenu($node) {
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
