<?php

namespace App\Modules;

use File;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function register() {
        // Widgets
        View::composer(getView('widgets.custom_html'), 'App\Modules\Presentation\ViewComposers\CustomHtmlComposer');

        View::composer(getView('widgets.content_list'), 'App\Modules\Presentation\ViewComposers\ContentListComposer');
        View::composer(getView('widgets.apartment_list'), 'App\Modules\Presentation\ViewComposers\ApartmentListComposer');
        View::composer(getView('widgets.apartment_location_list'), 'App\Modules\Presentation\ViewComposers\ApartmentLocationListComposer');
        View::composer(getView('widgets.categories_list'), 'App\Modules\Presentation\ViewComposers\CategoriesListComposer');
        View::composer(getView('widgets.content_related_list'), 'App\Modules\Presentation\ViewComposers\ContentRelatedListComposer');

        View::composer(getView('widgets.products_list'), 'App\Modules\Presentation\ViewComposers\ProductsListComposer');
        View::composer(getView('widgets.products_categories_list'), 'App\Modules\Presentation\ViewComposers\ProductsCategoriesListComposer');
        View::composer(getView('widgets.carousel_bootstrap'), 'App\Modules\Presentation\ViewComposers\CarouselBootstrapComposer');
        View::composer(getView('widgets.navbar'), 'App\Modules\Presentation\ViewComposers\NavbarComposer');
        View::composer(getView('widgets.navbar_vertical'), 'App\Modules\Presentation\ViewComposers\NavbarVerticalComposer');

        // Plugins
        View::composer(getView('plugins.register_mail_popup'), 'App\Modules\Presentation\ViewComposers\Plugins\RegisterMailComposer');

        // Layout
        View::composer(getView('master.widget_area'), 'App\Modules\Presentation\ViewComposers\WidgetAreaComposer');
        View::composer(getView('master.widget_single'), 'App\Modules\Presentation\ViewComposers\WidgetSingleComposer');

        // Master
        View::composer(getView('master.master'), 'App\Modules\Presentation\ViewComposers\MasterComposer');
        View::composer(getView('master.master_home'), 'App\Modules\Presentation\ViewComposers\MasterComposer');
        View::composer(getView('master.master_page'), 'App\Modules\Presentation\ViewComposers\MasterComposer');

        // Meta page
        View::composer(getView('master.meta'), 'App\Modules\Presentation\ViewComposers\PageMetaComposer');
    }
}
