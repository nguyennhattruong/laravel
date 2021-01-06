<?php
/**
 * Service Load Module
 *
 * @author nhat_truong
 * @since 2017-12-03
 */
namespace App\Modules;

use File;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot() {
        // Load routes
        $listRoutes = scandir(__DIR__ . '/Application/Routes');
        foreach ($listRoutes as $route) {
            if ($route != "." && $route != "..") {
                include __DIR__ . '/Application/Routes/' . $route;
            }
        }

        $listModule = array_map('basename', File::directories(__DIR__ . '/Presentation/Views'));
        foreach ($listModule as $module) {
            // Load language
            if (is_dir(__DIR__ . '/Presentation/Lang/' . $module)) {
                $this->loadTranslationsFrom(__DIR__ . '/Presentation/Lang/' . $module, $module);
            }

            // Load the views
            if (is_dir(__DIR__ . '/Presentation/Views/' . $module)) {
                $this->loadViewsFrom(__DIR__ . '/Presentation/Views/' . $module, $module);
            }

            /*// Load the views widgets
            if (is_dir(__DIR__ . '/Presentation/Views/Widgets')) {
                $this->loadViewsFrom(__DIR__ . '/Presentation/Views/Widgets', 'Widgets');
            }*/
        }
    }
}
