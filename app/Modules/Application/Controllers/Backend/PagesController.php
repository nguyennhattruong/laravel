<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Models\Pages;
use App\Modules\Domain\Services\Commands\PagesServiceCommand;
use App\Modules\Domain\Services\Queries\PagesServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Pages\PagesEditForm;
use App\Modules\Presentation\Forms\Backend\Pages\PagesIndexForm;
use App\Modules\Presentation\Forms\Backend\Pages\PagesIndexGridForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Illuminate\Http\Request;

class PagesController extends IController
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $service = new PagesServiceQuery();

        return view('Backend::pages.index', [
            'form' => $this->form(PagesIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(PagesIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $form = $this->form(PagesEditForm::class, [
            'model' => new Pages()
        ]);

        return view('Backend::pages.edit', [
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $input = $request->input();

        if (trim($input['alias']) == '') {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(PagesEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias(Pages::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new PagesServiceCommand();

        if ($service->insert($input)) {
            return $this->successSave('PagesInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        $service = new PagesServiceQuery();

        if (empty($page = $service->getById($id))) {
            return redirect()->route('PagesIndex');
        }

        $form = $this->form(PagesEditForm::class, [
            'model' => $page
        ]);

        return view('Backend::pages.edit', [
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id) {
        $input = $request->input();
        $input['id'] = $id;

        $service = new PagesServiceQuery();

        if (empty($page = $service->getById($id))) {
            return redirect()->route('PagesIndex');
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(PagesEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if ($input['alias'] != $page->alias && hasAlias(Pages::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $serviceCommand = new PagesServiceCommand();

        if ($serviceCommand->update($input)) {
            return $this->successSave('PagesEdit', $page->id);
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * Trash, Restore, Update Status, delete
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function manage(Request $request) {
        if (isset($request['form_action'])) {
            switch ($request['form_action']) {
                case 'update_status':
                    return $this->_updateStatus($request);
                    break;
                case 'delete':
                    return $this->_delete($request);
                    break;
                default:
                    break;
            }
        }

        return redirect()->route('PagesIndex');
    }

    private function _updateStatus(Request $request) {
        $service = new PagesServiceCommand();
        $errors = [];

        if (empty($request->input('id'))) {
            return $this->warningCheckAll();
        }

        foreach ($request->input('id') as $id) {
            if (!$service->updateStatus($id, $request->input('status_to'))) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorSaveList($errors);
        } else {
            return $this->successSave();
        }
    }

    private function _delete(Request $request) {
        $service = new PagesServiceCommand();
        $errors = [];

        if (empty($request->input('id'))) {
            return $this->warningCheckAll();
        }

        foreach ($request->input('id') as $id) {
            if (!$service->delete($id)) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorDeleteList($errors);
        } else {
            return $this->successSave();
        }
    }
}
