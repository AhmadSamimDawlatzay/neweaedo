<?php

namespace Botble\Donation;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('donations');
        Schema::dropIfExists('donations_translations');
    }
}
