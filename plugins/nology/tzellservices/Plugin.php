<?php
/**
 * Created by NOLOGY.
 * Pepe López
 * Date: 8/20/2014
 */

namespace Nology\TzellServices;

use App;
use Event;
use Backend;
use System\Classes\PluginBase;
use Illuminate\Foundation\AliasLoader;

/**
 * TzellServices Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'TzellServices',
            'description' => 'Provides interaction with tzell API.',
            'author'      => 'NOLOGY. Pepe López',
            'icon'        => 'icon-leaf'
        ];
    }

}
