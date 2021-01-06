<?php

namespace App\Modules\Presentation\Forms\Backend\Config;

use App\Modules\Infrastructure\Core\IForm;

class MailForm extends IForm
{
    public function buildForm() {
        $this->languageName = 'config';
        $this
            ->addText('mail_from')
            ->addText('from_name')
            ->addText('reply_to_email')
            ->addText('reply_to_name')
            ->addSelect('mailer', [
                'smtp' => 'SMTP'
            ])
            ->addText('smtp_host')
            ->addNumber('smtp_port')
            ->addSelect('smtp_secure', [
                'none' => 'None',
                'ssl' => 'SSL',
                'tls' => 'TLS'
            ])
            ->addYesNoSimple('smtp_auth', [
                'label' => trans('Backend::config.smtp_auth')
            ])
            ->addText('smtp_user')
            ->addPassword('smtp_pass')
            ->addButtonSubmit();
    }
}
