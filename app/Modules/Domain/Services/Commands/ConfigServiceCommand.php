<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\ConfigRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class ConfigServiceCommand extends ServiceCommand
{
    private $_configRepositoriesCommand;

    function __construct() {
        $this->_configRepositoriesCommand = new ConfigRepositoryCommand();
    }

    /**
     * Update General Configuration
     *
     * @param $config
     * @return string
     *
     * @author nhat_truong
     * @since  2017-10-25
     */
    public function updateGeneral($config) {
        return $this->_configRepositoriesCommand->updateGeneral($config);
    }

    /**
     * Update Mail
     *
     * @param $mail
     * @return bool
     *
     * @author nhat_truong
     * @since  2017-11-24
     */
    public function updateMail($mail) {
        return $this->_configRepositoriesCommand->updateMail($mail);
    }

    /**
     * Update metadata
     *
     * @param $request
     * @return bool
     *
     * @author nhat_truong
     * @since 2017-12-10
     */
    public function updateMetadata($request)
    {
        return $this->_configRepositoriesCommand->updateMetadata($request);
    }

    /**
     * @param $request
     * @return bool
     *
     * @author nhat_truong
     * @since  2017-12-15
     */
    public function updateEmbedScript($request) {
        return $this->_configRepositoriesCommand->updateEmbedScript($request);
    }

    public function updateEmbedCSS($request) {
        return $this->_configRepositoriesCommand->updateEmbedCSS($request);
    }

    public function updateEmbedLink($request) {
        return $this->_configRepositoriesCommand->updateEmbedLink($request);
    }
}
