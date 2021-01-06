<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Repositories\Queries\ConfigRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class ConfigServiceQuery extends ServiceQuery
{
    private $_configRepositoriesQuery;

    function __construct() {
        $this->_configRepositoriesQuery = new ConfigRepositoryQuery();
    }

    /**
     * Get General Configuration
     *
     * @return mixed
     * @author nhat_truong
     * @since  2017-10-25
     */
    public function getGeneral() {
        return $this->_configRepositoriesQuery->getGeneral();
    }

    /**
     * Get Mail
     *
     * @return mixed|static
     * @author nhat_truong
     * @since  2017-11-24
     */
    public function getMail() {
        return $this->_configRepositoriesQuery->getMail();
    }

    /**
     * Get Metadata
     *
     * @author nhat_truong
     * @since 2017-12-10
     */
    public function getMetadata() {
        $data = $this->_configRepositoriesQuery->getMetadata();

        if (!is_null($data)) {
            $data->meta_extension = json_decode($data->meta_extension);
        }

        return $data;
    }

    /**
     * @author nhat_truong
     * @since  2017-12-15
     */
    public function getEmbedScript() {
        $data = $this->_configRepositoriesQuery->getEmbedScript();

        if (!is_null($data)) {
            $data->header_script = json_decode($data->header_script);
        }

        return $data;
    }

    public function getEmbedCSS() {
        return $this->_configRepositoriesQuery->getEmbedCSS();
    }

    public function getEmbedLink() {
        return $this->_configRepositoriesQuery->getEmbedLink();
    }

    public function getPageMeta() {
        $general = $this->getGeneral();
        $data = $this->getMetadata();

        $data->title = $general->site_name;
        $data->meta_description = $general->meta_description;

        return $data;
    }
}
