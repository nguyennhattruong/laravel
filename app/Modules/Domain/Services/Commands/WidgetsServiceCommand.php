<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\WidgetsRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;
use App\Modules\Presentation\Forms\Backend\Widgets\ContentListForm;

class WidgetsServiceCommand extends ServiceCommand
{
    private $_service;

    function __construct() {
        $this->_service = new WidgetsRepositoryCommand();
    }

    public function insert($input) {
        $params = '';
        switch ($input['widget']) {
            case 'content_list':
                $form = new ContentListForm();
                $params = json_encode($form->_fields);
                break;
        }

        $input['params'] = $params;

        return $this->_service->insert($input);
    }

    public function updateOrdering($input) {
        return $this->_service->updateOrdering($input);
    }

    public function update($input) {
        return $this->_service->update($input);
    }

    public function delete($id) {
        return $this->_service->delete($id);
    }
}
