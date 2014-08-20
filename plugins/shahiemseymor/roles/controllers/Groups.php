<?php namespace ShahiemSeymor\Roles\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use ShahiemSeymor\Roles\Models\UserGroup;
use Flash;

class Groups extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) 
        {
            foreach ($checkedIds as $roleId) {
                if (!$role = UserGroup::find($roleId))
                    continue;

                $role->delete();
            }

            Flash::success('The Role has been deleted successfully.');
        }

         return $this->listRefresh();
    }
}