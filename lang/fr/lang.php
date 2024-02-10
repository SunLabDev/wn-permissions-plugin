<?php

return [
    'plugin' => [
        'name' => 'Permissions',
        'description' => 'Front-end user permissions management.',
    ],

    'permissions' => [
        'access_permissions' => 'Gérer les permissions',
        'access_group_permissions' => 'Gérer les permissions de groupe utilisateurs',
        'access_user_permissions' => 'Gérer les permissions utilisateur',
        'tab' => 'Permissions utilisateurs'
    ],

    'controllers' => [
        'users' => [
            'menu_label' => 'Permissions',
            'menu_desc' => 'Gestion des permissions',
            'tabs' => 'Permissions',
        ],
        'permissions' => [
            'preview_title' => 'Aperçu d’une permission',
            'create_title' => 'Nouvelle permission',
            'update_title' => 'Mise à jour d’une permission',
            'delete_title' => 'Effacer une permission',
            'delete_confirm' => 'Do you really want to delete this permission?',
        ],
    ],

    'models' => [
        'permission' => [
            'label' => 'Permission',
            'label_plural' => 'Permissions',
            'code' => 'Code',
            'code_comment' => 'Généré automatiquement à partir du champ "Nom" si vide.',
            'comment' => 'Description',
            'label' => 'Nom',
            'label_comment' => 'Nom de la permission.',
            'tab' => 'Groupe',
            'tab_comment' => 'Utilisé pour le regrouppement des permissions',
        ],
    ],
];
