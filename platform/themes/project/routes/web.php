<?php
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\Project\Http\Controllers\ProjectController;

// Custom routes
// You can delete this route group if you don't need to add your custom routes.
Route::group(['controller' => ProjectController::class, 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        // Add your custom route here
        // Ex: Route::get('hello', 'getHello');
        Route::get('project','getProject');
        Route::get('project/{slug}','getProjects');

    });
});

Theme::routes();
