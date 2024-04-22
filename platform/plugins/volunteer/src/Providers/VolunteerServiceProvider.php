<?php

namespace Botble\Volunteer\Providers;

use Botble\Volunteer\Models\Volunteer;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Supports\ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;

class VolunteerServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/volunteer')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes();

        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Volunteer::class, [
                'name',
            ]);
        }

        $this->app['events']->listen(RouteMatched::class, function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-volunteer',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'plugins/volunteer::volunteer.name',
                'icon' => 'fa fa-user-circle',
                'url' => route('volunteer.index'),
                'permissions' => ['volunteer.index'],
            ]);
        });
    }
}
