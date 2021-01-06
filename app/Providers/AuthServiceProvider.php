<?php

namespace App\Providers;

use App\Modules\Domain\Models\Documents\Documents;
use App\Modules\Domain\Models\Documents\DocumentsTypes;
use App\Modules\Policies\DocumentsPolicy;
use App\Modules\Policies\DocumentsTypesPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Documents::class => DocumentsPolicy::class,
        DocumentsTypes::class => DocumentsTypesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param Gate $gate
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();
        // Full for Admin
        $gate->before(function ($user) {
            if (isset($user->group->rules)) {
                $rules = array_flip(json_decode($user->group->rules));
                if (isset($rules['full'])) {
                    return true;
                }
            }
        });

        $gate->define('show_menu_doc_departments', function ($user) {
            return $user->hasPermission('full');
        });

        $gate->define('show_menu_users', function ($user) {
            return $user->hasPermission('full');
        });

        $gate->define('show_menu_doc_type', function ($user) {
            return $user->hasPermission('full_doc_type');
        });
    }
}
