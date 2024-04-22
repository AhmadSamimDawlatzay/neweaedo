<?php

namespace Botble\Volunteer;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('volunteers');
        Schema::dropIfExists('volunteers_translations');
    }
}
