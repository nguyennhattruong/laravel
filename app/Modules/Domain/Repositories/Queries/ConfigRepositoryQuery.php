<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Config;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class ConfigRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getGeneral() {
        $columns = ['site_name', 'meta_description', 'off_message', 'off'];

        if (empty($config = Config::select($columns)->find(1))) {
            $config = new Config();
        }

        return $config;
    }

    public function getMail() {
        $columns = ['mail_from', 'from_name', 'reply_to_email', 'reply_to_name', 'mailer', 'smtp_host', 'smtp_port'
            , 'smtp_secure', 'smtp_auth', 'smtp_user', 'smtp_pass'];

        if (empty($config = Config::select($columns)->find(1))) {
            $config = new Config();
        }

        return $config;
    }

    public function getMetadata() {
        $columns = ['meta_keywords', 'meta_robots', 'meta_extension'];

        if (empty($config = Config::select($columns)->find(1))) {
            $config = new Config();
        }

        return $config;
    }

    public function getEmbedScript() {
        $columns = ['header_script'];

        if (empty($config = Config::select($columns)->find(1))) {
            $config = new Config();
        }

        return $config;
    }

    public function getEmbedCSS() {
        $columns = ['header_css'];

        if (empty($config = Config::select($columns)->find(1))) {
            $config = new Config();
        }

        return $config;
    }

    public function getEmbedLink() {
        $columns = ['header_link'];

        if (empty($config = Config::select($columns)->find(1))) {
            $config = new Config();
        }

        return $config;
    }
}
