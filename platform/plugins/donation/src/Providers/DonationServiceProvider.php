<?php

namespace Botble\Donation\Providers;

use Botble\Donation\Models\Donation;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Supports\ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Schema;

class DonationServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/donation')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes();

        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Donation::class, [
                'name',
            ]);
        }

        $this->app['events']->listen(RouteMatched::class, function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-donation',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'plugins/donation::donation.name',
                'icon' => 'fas fa-money-bill-alt',
                'url' => route('donation.index'),
                'permissions' => ['donation.index'],
            ]);
        });

        \SlugHelper::registermodule(Donation::class,'Donation');
        \SlugHelper::setPrefix(Donation::class,'donation');
        Schema::defaultStringLength(191);
    }
}
