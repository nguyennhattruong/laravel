<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Menu;
use App\Modules\Domain\Services\Queries\MenuServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class MenuRepositoryCommand extends RepositoryCommand
{
    private function _getLink($input) {
        switch ($input['onsite']) {
            case 1:
                switch ($input['link_options']) {
                    case 'home':
                        return json_encode([
                            'component' => 'home'
                        ]);
                        break;
                    case 'content':
                        return json_encode([
                            'component' => 'content',
                            'id_link' => $input['id_link']
                        ]);
                        break;
                    case 'categories':
                        return json_encode([
                            'component' => 'categories',
                            'id_link' => $input['id_link']
                        ]);
                        break;
                    case 'products_categories':
                        return json_encode([
                            'component' => 'products_categories',
                            'id_link' => $input['id_link']
                        ]);
                        break;
                    case 'contact':
                        return json_encode([
                            'component' => 'contact'
                        ]);
                        break;
                    case 'neo':
                        return json_encode([
                            'component' => 'neo',
                            'id_link' => $input['id_link']
                        ]);
                        break;
                }
                break;
            case 2:
                return $input['link'];
                break;
            default:
                return '';
                break;
        }
    }

    public function insert($input) {
        $category = new Menu();
        $service = new MenuServiceQuery();

        $category = $this->setAttributes($category, $input);
        $category->status = $this->getStatus($input['status']);
        $category->language = $this->getLang($input['language']);
        $category->link = $this->_getLink($input);

        if ($category->save()) {
            if (!is_null($input['parent_id'])) {
                $parent = $service->getById($input['parent_id']);

                $category->makeChildOf($parent);
            } else {
                $category->makeRoot();
            }
        }

        Menu::rebuild(true);

        return true;
    }

    public function update($input) {
        $service = new MenuServiceQuery();

        $node = $service->getById($input['id']);
        $node = $this->setAttributes($node, $input);

        $node->status = $this->getStatus($input['status']);
        $node->language = $this->getLang($input['language']);
        $node->link = $this->_getLink($input);

        if ($node->save()) {
            if (!is_null($input['parent_id'])) {
                $parent = $service->getById($input['parent_id']);
                $node->makeChildOf($parent);
            } else {
                $node->makeRoot();
            }
        }

        // Update ordering
        if (isset($input['ordering_options']) && isset($input['ordering'])) {
            $sibling = $service->getById($input['ordering']);
            if ($input['ordering_options'] == 'next') {
                $node->makeNextSiblingOf($sibling);
            } else {
                $node->makePreviousSiblingOf($sibling);
            }
        }

        Menu::rebuild(true);

        return true;
    }

    public function delete($id) {
        $menu = Menu::find($id);
        return $menu->delete();
    }

    public function update_status($id, $status) {
        return Menu::where('id', $id)->update(['status' => $status]);
    }
}
