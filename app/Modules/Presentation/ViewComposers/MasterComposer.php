<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Handle\PluginServiceHandle;
use App\Modules\Domain\Services\Queries\ConfigServiceQuery;
use Illuminate\View\View;

class MasterComposer
{
    public function compose(View $view)
    {
        $service = new ConfigServiceQuery();
        $pluginService = new PluginServiceHandle();

        $link = $service->getEmbedLink()['header_link'];
        $css = $service->getEmbedCSS()['header_css'];
        $scripts = $service->getEmbedScript()['header_script'];

        $script_str = '';
        if (!empty($scripts)) {
            foreach ($scripts as $script) {
                $script_str .= $script;
            }
        }

        $view->with('data', [
            'header_script' => $script_str,
            'header_css' => $css,
            'header_link' => $link,
            'plugins' => $pluginService->getPlugins()
        ]);
    }
}
