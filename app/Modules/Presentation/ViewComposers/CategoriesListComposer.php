<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use Illuminate\View\View;

class CategoriesListComposer
{
    public function compose(View $view) {
        $menu = '';
        $service = new CategoriesServiceQuery();

        $data = $view->offsetGet('wid_content');

        $id = isset($data['params']->category_id) && $data['params']->category_id != 'null'
            ? $data['params']->category_id : 0;

        if ($id == 0) {
            $categories = $service->getAll()->toHierarchy();
        } else {
            $categories = $service->getDescendants($id)->toHierarchy();
        }

        foreach ($categories as $node) {
            $menu .= $this->buildMenu($node);
        }

        $view->with('data', $menu);
    }

    private function buildMenu($node) {
        if ($node->isLeaf()) {
            return "<li>
                        <a href=\"" . route('SiteCategory', $node->alias) . "\">
                            <i class=\"{$node->icon} mr-1\" aria-hidden=\"true\"></i> {$node->title}
                        </a>
                    </li>";
        } else {
            $html = "<li>
                         <a href=\"" . route('SiteCategory', $node->alias) . "\">
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
