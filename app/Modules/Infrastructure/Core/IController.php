<?php

namespace App\Modules\Infrastructure\Core;

use App\Http\Controllers\Controller;
use App\Modules\Domain\Services\Queries\ConfigServiceQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IController extends Controller
{
    protected $_formEdit       = NULL;
    protected $_formIndex      = NULL;
    protected $_formIndexGrid  = NULL;
    protected $_viewIndex      = NULL;
    protected $_viewInsert     = NULL;
    protected $_viewEdit       = NULL;
    protected $_serviceQuery   = NULL;
    protected $_serviceCommand = NULL;
    protected $_model          = NULL;
    protected $_routeInsert    = NULL;
    protected $_routeEdit      = NULL;
    protected $_routeIndex     = NULL;

    public $meta;

    public function __construct() {
        $config = new ConfigServiceQuery();
        $this->meta = $config->getPageMeta();
        $this->init();
    }

    protected function init() {
    }

    public function error($message = '') {
        return redirect()->back()->with('messageError', $message);
    }

    /**
     * Error for Form or only text
     *
     * @param array $input
     * @param string $message
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function errorSave($input = [], $message = '') {
        if (!empty($input)) {
            return redirect()->back()
                             ->with('messageError', $message != '' ? $message : trans('Backend::common.save_failed'))
                             ->withInput($input);
        }

        return redirect()->back();
    }

    /**
     * Error for Update
     *
     * @param array $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    public function errorSaveList($ids = []) {
        return redirect()->back()
                         ->with('messageError', trans('Backend::common.message_save_failed', [
                             'ids' => implode(', ', $ids)
                         ]));
    }

    /**
     * Error for Delete
     *
     * @param array $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    public function errorDeleteList($ids = []) {
        return redirect()->back()
                         ->with('messageError', trans('Backend::common.message_delete_failed', [
                             'ids' => implode(', ', $ids)
                         ]));
    }

    /**
     * Error alias
     *
     * @param $input
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-04-11
     */
    public function errorAlias($input) {
        return redirect()->back()
                         ->with('messageError', trans('Backend::common.alias_exist'))
                         ->withInput($input);
    }

    /**
     * Error invalid form
     *
     * @param $form
     * @param $input
     * @return $this
     */
    public function errorForm($form, $input) {
        return redirect()->back()
                         ->withErrors($form->getErrors())
                         ->withInput($input);
    }

    /**
     * Success for Edit
     *
     * @param string $route
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function successSave($route = '', $id = NULL) {
        if ($route != '') {
            return redirect()->route($route, $id)
                             ->with('messageSuccess', trans('Backend::common.save_success'));
        }

        return redirect()->back()
                         ->with('messageSuccess', trans('Backend::common.save_success'));
    }

    public function warningCheckAll() {
        return redirect()->back()
                         ->with('messageWarning', trans('Backend::common.message_check_all'));
    }

    public function setPageMeta($title = null, $description = null, $keywords = null) {
        if (!is_null($title)) {
            $this->meta->title = $title;
        }

        if (!is_null($description)) {
            $this->meta->meta_description = $description;
        }

        if (!is_null($keywords)) {
            $this->meta->meta_keywords = $keywords;
        }
    }

    public function redirectHome() {
        return redirect()->route('SiteIndex');
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        if (!Auth::user()->can('create', $this->_model)) {
            return $this->permission();
        }

        $form = $this->form($this->_formEdit, [
            'model' => $this->_model
        ]);

        return view(is_null($this->_viewInsert) ? $this->_viewEdit : $this->_viewInsert, [
            'form' => $form
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

        $form = $this->form($this->_formEdit, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        if ($this->_serviceCommand->insert($input)) {
            return $this->successSave($this->_routeInsert);
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
        if (!$this->isPermission($id, 'update')) {
            return $this->permission();
        }

        if (empty($content = $this->_serviceQuery->getById($id))) {
            return redirect()->route($this->_routeIndex);
        }

        $form = $this->form($this->_formEdit, [
            'model' => $content
        ]);

        return view($this->_viewEdit, [
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
        if (!$this->isPermission($id, 'update')) {
            return $this->permission();
        }

        $input = $request->input();
        $input['id'] = $id;

        if (empty($info = $this->_serviceQuery->getById($id))) {
            return redirect()->route($this->_routeIndex);
        }

        $form = $this->form($this->_formEdit, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        if ($this->_serviceCommand->update($input)) {
            return $this->successSave($this->_routeEdit, $info->id);
        } else {
            return $this->errorSave($input);
        }
    }

    public function show($id) {
        if (!$this->isPermission($id, 'view')) {
            return $this->permission();
        }

        if (empty($data = $this->_serviceQuery->getById($id))) {
            return redirect()->route($this->_routeIndex);
        }

        return view($this->_viewShow, [
            'data' => $data
        ]);
    }

    public function permission() {
        return view('errors.403');
    }

    public function isPermission($id, $action) {
        $model = $this->_serviceQuery->getById($id);
        $user = Auth::user();
        return $user->can($action, $model);
    }
}
