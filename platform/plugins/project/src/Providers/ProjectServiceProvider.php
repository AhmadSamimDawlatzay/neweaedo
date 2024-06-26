<?php

namespace Botble\Project\Providers;

use Botble\Project\Models\Project;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Supports\ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Schema;

class ProjectServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/project')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes();

        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Project::class, [
                'name',
            ]);
        }

        $this->app['events']->listen(RouteMatched::class, function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-project',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'plugins/project::project.name',
                'icon' => 'fa fa-pie-chart',
                'url' => route('project.index'),
                'permissions' => ['project.index'],
            ]);
        });

        \SlugHelper::registermodule(Project::class,'Project');
        \SlugHelper::setPrefix(Project::class,'project');
        Schema::defaultStringLength(191);
    }
}
