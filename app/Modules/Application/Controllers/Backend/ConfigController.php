<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Application\Requests\ConfigRequest;
use App\Modules\Domain\Services\Commands\ConfigServiceCommand;
use App\Modules\Domain\Services\Queries\ConfigServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Config\EmbedCssForm;
use App\Modules\Presentation\Forms\Backend\Config\EmbedLinkForm;
use App\Modules\Presentation\Forms\Backend\Config\EmbedScriptForm;
use App\Modules\Presentation\Forms\Backend\Config\GeneralForm;
use App\Modules\Presentation\Forms\Backend\Config\MailForm;
use App\Modules\Presentation\Forms\Backend\Config\MetadataForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ConfigController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
        $this->_serviceCommand = new ConfigServiceCommand();
        $this->_serviceQuery = new ConfigServiceQuery();
    }

    /**
     * Index General Configuration
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since  2017-10-24
     */
    public function general() {
        $form = $this->form(GeneralForm::class, [
            'model' => $this->_serviceQuery->getGeneral()
        ]);

        return view('Backend::config.general', [
            'form' => $form
        ]);
    }

    /**
     * Post General Configuration
     *
     * @param ConfigRequest $request
     * @return ConfigController|\Illuminate\Http\RedirectResponse
     *
     * @author nhat_truong
     * @since  2017-10-24
     */
    public function generalPost(ConfigRequest $request) {
        $form = $this->form(GeneralForm::class, [
            'model' => $request
        ]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $request->input());
        }

        if ($this->_serviceCommand->updateGeneral($request)) {
            return $this->successSave('ConfigGeneral');
        }

        return $this->errorSave($request->input());
    }

    /**
     * Index Mail Settings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since  2017-11-24
     */
    public function mail() {
        $form = $this->form(MailForm::class, [
            'model' => $this->_serviceQuery->getMail()
        ]);

        return view('Backend::config.mail', [
            'form' => $form
        ]);
    }

    /**
     * Post Mail Settings
     *
     * @param ConfigRequest $request
     * @return ConfigController|\Illuminate\Http\RedirectResponse
     *
     * @author nhat_truong
     * @since  2017-11-24
     */
    public function mailPost(ConfigRequest $request) {
        $form = $this->form(MailForm::class, [
            'model' => $request
        ]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $request->input());
        }

        if ($this->_serviceCommand->updateMail($request)) {
            return $this->successSave('ConfigMail');
        }

        return $this->errorSave($request->input());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since 2017-12-10
     */
    public function metadata() {
        $data = $this->_serviceQuery->getMetadata();
        $form = $this->form(MetadataForm::class, [
            'model' => $data
        ]);

        return view('Backend::config.metadata', [
            'form' => $form,
            'data' => $data
        ]);
    }

    /**
     * @param ConfigRequest $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since 2017-12-10
     */
    public function metadataPost(ConfigRequest $request) {
        $form = $this->form(MetadataForm::class, [
            'model' => $request
        ]);

        if (!$form->isValid()) {
            $this->errorForm($form, $request->input());
        }

        if ($this->_serviceCommand->updateMetadata($request)) {
            $this->successSave('ConfigMetadata');
        }

        return $this->errorSave($request->input());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since  2017-12-15
     */
    public function embedScript() {
        $data = $this->_serviceQuery->getEmbedScript();

        $form = $this->form(EmbedScriptForm::class, [
            'model' => $data
        ]);

        return view('Backend::config.embed_script', [
            'form' => $form,
            'data' => $data
        ]);
    }

    /**
     * @param ConfigRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     *
     * @author nhat_truong
     * @since  2017-12-15
     */
    public function embedScriptPost(ConfigRequest $request) {
        $form = $this->form(EmbedScriptForm::class, [
            'model' => $request
        ]);

        if (!$form->isValid()) {
            $this->errorForm($form, $request->input());
        }

        if ($this->_serviceCommand->updateEmbedScript($request)) {
            $this->successSave('ConfigEmbedScript');
        }

        return $this->errorSave($request->input());
    }

    public function embedCSS() {
        $data = $this->_serviceQuery->getEmbedCSS();

        $form = $this->form(EmbedCssForm::class, [
            'model' => $data
        ]);

        return view('Backend::config.embed_css', [
            'form' => $form,
            'data' => $data
        ]);
    }

    public function embedCSSPost(ConfigRequest $request) {
        $form = $this->form(EmbedCssForm::class, [
            'model' => $request
        ]);

        if (!$form->isValid()) {
            $this->errorForm($form, $request->input());
        }

        if ($this->_serviceCommand->updateEmbedCSS($request)) {
            $this->successSave('ConfigEmbedCSS');
        }

        return $this->errorSave($request->input());
    }

    public function embedLink() {
        $data = $this->_serviceQuery->getEmbedLink();

        $form = $this->form(EmbedLinkForm::class, [
            'model' => $data
        ]);

        return view('Backend::config.embed_link', [
            'form' => $form,
            'data' => $data
        ]);
    }

    public function embedLinkPost(ConfigRequest $request) {
        $form = $this->form(EmbedLinkForm::class, [
            'model' => $request
        ]);

        if (!$form->isValid()) {
            $this->errorForm($form, $request->input());
        }

        if ($this->_serviceCommand->updateEmbedLink($request)) {
            $this->successSave('ConfigEmbedLink');
        }

        return $this->errorSave($request->input());
    }
}
