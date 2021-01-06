<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Models\Menu;
use App\Modules\Domain\Repositories\Queries\MenuRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class MenuServiceQuery extends ServiceQuery
{
    private $_rep;

    function __construct() {
        $this->_rep = new MenuRepositoryQuery();
    }

    public function getList($input) {
        $list = $this->_rep->getList($input);

        return $this->_injectionLink($list);
    }

    public function getListParents($id) {
        $result = [];
        $list = $this->_rep->getListParents($id);

        foreach ($list as $item) {
            $result[$item['id']] = str_repeat('- ', $item->depth) . $item->title;
        }

        return $result;
    }

    public function getById($id) {
        return Menu::find($id);
    }

    public function getAllById ($id) {
        $menu = Menu::find($id);

        switch ($menu->onsite) {
            case 1:
                $json = json_decode($menu->link);
                $menu->link_options = $json->component;

                if (in_array($json->component, ['content', 'categories', 'neo', 'products_categories'])) {
                    $menu->id_link = $json->id_link;
                }

                $menu->link = '';
                break;
        }

        return $menu;
    }

    public function getSiblings($id) {
        $result = [];

        if (!empty($menu = $this->getById($id))) {
            if ($menu->getDepth() !== 0) {

                if (count($siblings = $menu->getSiblings()) > 0) {
                    $result = $this->_injectionTitle($siblings)->pluck('title', 'id')->toArray();
                }
            } else {
                $result = $this->_rep->getRootsNotSelf($id)->pluck('title', 'id')->toArray();
            }
        }

        return $result;
    }

    public function getByAlias($alias) {
        return $this->_rep->getByAlias($alias);
    }

    public function getHtmlMenuVertical($id) {
        $html = '';

        $list = $this->_rep->getListByType($id);
        $list = $this->_injectionLink($list)->toHierarchy();

        foreach ($list as $node) {
            $html .= $this->buildMenuVertical($node);
        }

        $html = '<ul class="list-unstyled mb-0">' . $html . '</ul>';

        return $html;
    }

    public function getHtmlMenu($id) {
        $menu = '';
        $menuMobile = '';

        $list = $this->_rep->getListByType($id);
        $list = $this->_injectionLink($list)->toHierarchy();

        foreach ($list as $node) {
            $menu .= $this->buildMenu($node);
        }

        foreach ($list as $node) {
            $menuMobile .= $this->buildMobileMenu($node);
        }

        $data = [
            'desktop' => '<ul class="menu">' . $menu . '</ul>',
            'mobile'  => '<div class="menu-mobile not-selectable">
                              <div class="menu-main menu-close">
                                  <ul class="list-group list-group-flush" id="menu-accordion">' . $menuMobile . '</ul>
                              </div>
                          </div>'
        ];

        return $data;
    }

    public function buildMenu($node) {
        if ($node->isLeaf()) {
            return "<li><a class=\"hvr-underline-from-center rounded-pill\" href=\"{$node->url}\"><i class=\"{$node->icon} mr-1\" aria-hidden=\"true\"></i> {$node->title}</a>" . '</li>';
        } else {
            $type = 'down';
            $class = '';
            if ($node->depth > 0) {
                $type = 'right';
                $class = 'class="hvr-underline-from-center"';
            }

            $html = "<li class=\"sub-menu\">
                         <a {$class} href=\"{$node->url}\"><i class=\"{$node->icon} mr-1\" aria-hidden=\"true\"></i> {$node->title}
                             <span class=\"ml-2 float-right\"><i class=\"fas fa-chevron-{$type}\" aria-hidden=\"true\"></i>
                             </span>
                         </a>
                         <ul class='shadow-lg'>";
            foreach ($node->children as $child) {
                $html .= $this->buildMenu($child);
            }
            $html .= '</ul>';
            $html .= '</li>';
        }

        return $html;
    }

    public function buildMobileMenu($node) {
        if ($node->isLeaf()) {
            return "<li class=\"list-group-item\">
                        <a href=\"{$node->url}\"><i class=\"{$node->icon} mr-2\" aria-hidden=\"true\"></i> {$node->title}</a>
                    </li>";
        } else {
            $html = "<li class=\"list-group-item\" id=\"parent-collapse{$node->id}\">
                         <a href=\"{$node->url}\"><i class=\"{$node->icon} mr-2\" aria-hidden=\"true\"></i> {$node->title}</a>
                         <span id=\"heading{$node->id}\" class=\"angle-down\" data-toggle=\"collapse\" data-target=\"#collapse{$node->id}\"
                               aria-controls=\"collapse{$node->id}\"><i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i></span>
                         <ul id=\"collapse{$node->id}\" class=\"list-unstyled collapse\" aria-labelledby=\"heading{$node->id}\"
                             data-parent=\"#parent-collapse{$node->id}\">";
            foreach ($node->children as $child) {
                $html .= $this->buildMobileMenu($child);
            }
            $html .= '</ul>';
            $html .= '</li>';
        }

        return $html;
    }

    public function buildMenuVertical($node) {
        if ($node->isLeaf()) {
            return "<li class=\"py-2\">
                        <i class=\"fa fa-caret-right\" aria-hidden=\"true\"></i>
                        <i class=\"{$node->icon} mr-2\" aria-hidden=\"true\"></i> 
                        <a href=\"{$node->url}\">{$node->title}</a>
                    </li>";
        } else {
            $html = "<li class=\"py-2\" id=\"parent-collapse{$node->id}\">
                         <i class=\"fa fa-caret-right\" aria-hidden=\"true\"></i>
                         <i class=\"{$node->icon} mr-2\" aria-hidden=\"true\"></i>
                         <a href=\"{$node->url}\">{$node->title}</a>
                         <ul id=\"collapse{$node->id}\" class=\"mt-1 pl-3 list-unstyled mb-0\" aria-labelledby=\"heading{$node->id}\"
                             data-parent=\"parent-collapse{$node->id}\">";
            foreach ($node->children as $child) {
                $html .= $this->buildMenuVertical($child);
            }
            $html .= '</ul>';
            $html .= '</li>';
        }

        return $html;
    }

    private function _injectionLink($list) {
        $serviceCate = new CategoriesServiceQuery();
        $serviceContent = new ContentServiceQuery();
        $serviceProCate = new ProductsCategoriesServiceQuery();
        foreach ($list as $item) {
            $item->url = route('SiteIndex');
            switch ($item->onsite) {
                case 1:
                    $json = json_decode($item->link);
                    switch ($json->component) {
                        case 'home':
                            break;
                        case 'content':
                            if (isset($json->id_link)) {
                                if (!empty($content = $serviceContent->getById($json->id_link))) {
                                    $item->url = route('SiteContent', $content->alias);
                                }
                            }
                            break;
                        case 'categories':
                            if (isset($json->id_link)) {
                                if (!empty($cate = $serviceCate->getById($json->id_link))) {
                                    $item->url = route('SiteCategory', $cate->alias);
                                }
                            }
                            break;
                        case 'products_categories':
                            if (isset($json->id_link)) {
                                if (!empty($cate = $serviceProCate->getById($json->id_link))) {
                                    $item->url = route('FrontendProductCategory', $cate->alias);
                                }
                            }
                            break;
                        case 'contact':
                            $item->url = route('SiteContact');
                            break;
                        case 'neo':
                            if (isset($json->id_link)) {
                                $item->url = url()->full() . $json->id_link;
                            }
                            break;
                    }
                    break;
                case 2:
                    $item->url = $item->link;
                    break;
                default:
                    $item->url = '';
            }
        }

        return $list;
    }

    private function _injectionTitle($list) {
        foreach ($list as $item) {
            $item->title = str_repeat('- ', $item['depth']) . $item['title'];
        }

        return $list;
    }
}
