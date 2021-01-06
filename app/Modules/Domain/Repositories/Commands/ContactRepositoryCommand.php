<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Categories;
use App\Modules\Domain\Models\Contact;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;
use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;

class ContactRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    public function insert($input) {
        if (empty($input['fullname'])
            || empty($input['email'])
            || empty($input['phone'])
        ) {
            return false;
        }

        // Check exist
        $flag = Contact::where([
            'phone' => $input['phone'],
            'email' => $input['email'],
            'fullname' => $input['fullname'],
//            'content' => $input['content']
        ])->exists();

        if (!$flag) {
            $contact = new Contact();
            $contact = $this->getItems($contact, ['fullname', 'phone', 'email'], $input);
            $contact->send_time = date('Y-m-d');
            $contact->type = 2;
//            $contact->content = $input['content'];

            return $contact->save();
        }

        return true;
    }
}
