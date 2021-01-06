<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Modules\Domain\Services\Commands\ToolServiceCommand;
use App\Modules\Domain\Services\Queries\ToolServiceQuery;
use App\Modules\Presentation\Forms\Backend\Tool\CleanSystemForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ToolController extends Controller
{
    use FormBuilderTrait;
    private $_toolServiceQuery;
    private $_toolServiceCommand;

    function __construct() {
        $this->_toolServiceQuery = new ToolServiceQuery();
        $this->_toolServiceCommand = new ToolServiceCommand();
    }

    /**
     * Index General Configuration
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since  2017-10-24
     */
    public function cleanSystem() {
        $form = $this->form(CleanSystemForm::class);

        return view('Backend::tool.clean_system', [
            'form' => $form,
            'data' => $this->_toolServiceQuery->getTotal()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since 2017-12-03
     */
    public function cleanSystemPost() {
        $form = $this->form(CleanSystemForm::class);
        $this->_toolServiceCommand->cleanTempFile();

        return view('Backend::tool.clean_system', [
            'form' => $form,
            'data' => $this->_toolServiceQuery->getTotal()
        ]);
    }

    public function designContent() {
        return view('Backend::tool.design_content');
    }
}
