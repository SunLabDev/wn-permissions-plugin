<?php namespace SunLab\Permissions\Controllers;

use BackendMenu;

class Permissions extends \Backend\Classes\Controller
{
    public $requiredPermissions = [
        'sunlab.permissions.access_permissions'
    ];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Winter.User', 'user', 'permissions');
    }
}
