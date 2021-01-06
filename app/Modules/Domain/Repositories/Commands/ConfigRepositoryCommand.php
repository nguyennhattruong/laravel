<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Config;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class ConfigRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    /**
     * Update General
     *
     * @param $item
     * @return bool
     * @author nhat_truong
     * @since  2017-10-24
     */
    public function updateGeneral($item) {
        $config = Config::find(1);

        if (!isset($config)) {
            $config = new Config();
        }

        $config->site_name        = $item->site_name;
        $config->meta_description = $item->meta_description;
        $config->off_message      = $item->off_message;
        $config->off              = $item->off;

        return $config->save();
    }

    /**
     * @param $mail
     * @return bool
     * @author nhat_truong
     * @since  2017-11-24
     */
    public function updateMail($mail) {
        $config = Config::find(1);

        if (!isset($config)) {
            $config = new Config();
        }

        $config->mail_from      = $mail->mail_from;
        $config->from_name      = $mail->from_name;
        $config->reply_to_email = $mail->reply_to_email;
        $config->reply_to_name  = $mail->reply_to_name;
        $config->mailer         = $mail->mailer;
        $config->smtp_host      = $mail->smtp_host;
        $config->smtp_port      = $mail->smtp_port;
        $config->smtp_secure    = $mail->smtp_secure;
        $config->smtp_auth      = $mail->smtp_auth;
        $config->smtp_user      = $mail->smtp_user;
        $config->smtp_pass      = $mail->smtp_pass;

        return $config->save();
    }

    /**
     * @param $request
     * @return bool
     * @author nhat_truong
     * @since 2017-12-10
     */
    public function updateMetadata($request)
    {
        $config = Config::find(1);

        if (!isset($config)) {
            $config = new Config();
        }

        $config->meta_keywords  = $request->meta_keywords;
        $config->meta_robots    = $request->meta_robots;

        $count = count($request->metaKey);
        $arr   = [];

        for ($i = 0; $i < $count; $i++) {
            if (!is_null($request->metaKey[$i])) {
                $arr[$request->metaKey[$i]] = $request->metaContent[$i];
            }
        }

        $config->meta_extension = json_encode($arr);

        return $config->save();
    }

    /**
     * @param $request
     * @return bool
     * @author nhat_truong
     * @since  2017-12-15
     */
    public function updateEmbedScript($request) {
        $config = Config::find(1);

        if (!isset($config)) {
            $config = new Config();
        }

        $count = count($request->key);
        $arr   = [];

        for ($i = 0; $i < $count; $i++) {
            if (!is_null($request->key[$i])) {
                $arr[$request->key[$i]] = $request->value[$i];
            }
        }

        $config->header_script = json_encode($arr);

        return $config->save();
    }

    public function updateEmbedCSS($item) {
        $config = Config::find(1);

        if (!isset($config)) {
            $config = new Config();
        }

        $config->header_css = $item->header_css;

        return $config->save();
    }

    public function updateEmbedLink($item) {
        $config = Config::find(1);

        if (!isset($config)) {
            $config = new Config();
        }

        $config->header_link = $item->header_link;

        return $config->save();
    }
}
