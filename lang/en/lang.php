<?php

return [
    'plugin' => [
        'name' => 'Permissions',
        'description' => 'Front-end user permissions management.',
    ],

    'permissions' => [
        'access_permissions' => 'Manage Permissions',
        'access_group_permissions' => 'Manage User Group Permissions',
        'access_user_permissions' => 'Manage User Permissions',
        'tab' => 'User Permissions'
    ],

    'controllers' => [
        'users' => [
            'menu_label' => 'Permissions',
            'menu_desc' => 'Choose the permissions',
            'tab' => 'Permissions',
        ],
        'permissions' => [
            'preview_title' => 'Permission preview',
            'create_title' => 'New Permission',
            'update_title' => 'Update Permission',
            'delete_title' => 'Delete Permission',
            'delete_confirm' => 'Do you really want to delete this permission?',
        ],
    ],

    'models' => [
        'permission' => [
            'label' => 'Permission',
            'label_plural' => 'Permissions',
            'code' => 'Code',
            'code_comment' => 'Auto-generated from "Name" field if left empty.',
            'label' => 'Name',
            'label_comment' => 'Name of the permission.',
            'comment' => 'Description',
            'tab' => 'Group',
            'tab_comment' => 'Used to group permissions.',
        ],
    ],
];
