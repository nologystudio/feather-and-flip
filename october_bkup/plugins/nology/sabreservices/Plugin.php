<?php
/**
 * Created by NOLOGY.
 * Pepe López
 * Date: 8/20/2014
 */

namespace Nology\SabreServices;

use App;
use Event;
use Backend;
use System\Classes\PluginBase;
use Illuminate\Foundation\AliasLoader;

/**
 * SabreServices Plugin Information File
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
            'name'        => 'Sabre Services',
            'description' => 'Provides interaction with sabre API.',
            'author'      => 'NOLOGY. Pepe López',
            'icon'        => 'icon-leaf'
        ];
    }

}
