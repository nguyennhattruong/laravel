<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Application\Requests\ContentRequest;
use App\Modules\Domain\Models\Content;
use App\Modules\Domain\Services\Commands\ContentServiceCommand;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Infrastructure\Files\Upload;
use App\Modules\Presentation\Forms\Backend\Content\ContentEditForm;
use App\Modules\Presentation\Forms\Backend\Content\ContentIndexForm;
use App\Modules\Presentation\Forms\Backend\Content\ContentIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ContentController extends IController
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $service = new ContentServiceQuery();

        return view('Backend::content.index', [
            'form' => $this->form(ContentIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(ContentIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $form = $this->form(ContentEditForm::class, [
            'model' => new Content()
        ]);

        return view('Backend::content.edit', [
            'form' => $form,
            'image' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        $input = $request->input();

        if (trim($input['alias']) == '') {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(ContentEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias(Content::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new ContentServiceCommand();

        if ($service->insert($input)) {
            return $this->successSave('ContentInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        $service = new ContentServiceQuery();

        if (empty($content = $service->getById($id))) {
            return redirect()->route('ContentIndex');
        }

        $form = $this->form(ContentEditForm::class, [
            'model' => $content
        ]);

        return view('Backend::content.edit', [
            'form' => $form,
            'image' => $content->image
        ]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param ContentRequest $request
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id) {
        $input = $request->input();
        $input['id'] = $id;

        $service = new ContentServiceQuery();

        if (empty($content = $service->getById($id))) {
            return redirect()->route('ContentIndex');
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(ContentEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if ($input['alias'] != $content->alias && hasAlias(Content::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new ContentServiceCommand();

        if ($service->update($input)) {
            return $this->successSave('ContentEdit', $content->id);
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * Trash, Restore, Update Cate for content
     *
     * @param ContentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function manage(ContentRequest $request) {
        if (isset($request['form_action'])) {
            switch ($request['form_action']) {
                case 'trash':
                    return $this->_trash($request);
                    break;
                case 'restore':
                    return $this->_restore($request);
                    break;
                case 'update_cate':
                    return $this->_update_cate($request);
                    break;
                case 'update_status':
                    return $this->_update_status($request);
                    break;
                case 'delete':
                    return $this->_delete($request);
                    break;
                default:
                    break;
            }
        }

        return redirect()->route('ContentIndex');
    }

    private function _trash(ContentRequest $request) {
        $service = new ContentServiceCommand();

        $errors = [];

        if (!$this->_validation_list($request)) {
            return redirect()->back();
        }

        foreach ($request->input('contentId') as $id) {
            if (!$service->trash($id)) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorSaveList($errors);
        } else {
            return $this->successSave();
        }
    }

    private function _restore(ContentRequest $request) {
        $service = new ContentServiceCommand();

        $errors = [];

        if (!$this->_validation_list($request)) {
            return redirect()->back();
        }

        foreach ($request->input('contentId') as $id) {
            if (!$service->restore($id)) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorSaveList($errors);
        } else {
            return $this->successSave();
        }
    }

    private function _update_cate(ContentRequest $request) {
        $service = new ContentServiceCommand();

        $errors = [];

        if (!$this->_validation_list($request)) {
            return redirect()->back();
        }

        foreach ($request->input('contentId') as $id) {
            if (!$service->update_cate($id, $request->input('cate'))) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorSaveList($errors);
        } else {
            return $this->successSave();
        }
    }

    private function _update_status(ContentRequest $request) {
        $service = new ContentServiceCommand();

        $errors = [];

        if (!$this->_validation_list($request)) {
            return redirect()->back();
        }

        foreach ($request->input('contentId') as $id) {
            if (!$service->update_status($id, $request->input('status_to'))) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorSaveList($errors);
        } else {
            return $this->successSave();
        }
    }

    private function _delete(ContentRequest $request) {
        $service = new ContentServiceCommand();

        $errors = [];

        if (!$this->_validation_list($request)) {
            return redirect()->back();
        }

        foreach ($request->input('contentId') as $id) {
            if (!$service->delete($id)) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorSaveList($errors);
        } else {
            return $this->successSave();
        }
    }

    protected function _validation_list($request) {
        if (empty($request->input('contentId'))) {
            $this->warningCheckAll();
            return false;
        }

        return true;
    }

    /**
     * Ajax upload avatar
     *
     * @return bool|string
     */
    public function ajaxUpload() {
        $file = $_FILES['file'];

        $upload = new Upload($file, [
            'tempDir' => config('define.folder_tmp')
        ]);
        $result = $upload->uploadTemp();
        $json = ['result' => 0];

        if($result != false){
            $json = [
                'result' => 1,
                'image' => $result
            ];
        }

        return response()->json($json);
    }
}
