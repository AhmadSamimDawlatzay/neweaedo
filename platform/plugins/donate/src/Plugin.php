<?php

namespace Botble\Donate;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('donates');
        Schema::dropIfExists('donates_translations');
    }
}
