<?php

return [
    'plugin' => [
        'name' => 'Rechte',
        'description' => 'Verwaltung von Benutzerrechten für Frontend-Anwendungen',
    ],

    'permissions' => [
        'access_permissions' => 'Benutzerrechte verwalten',
        'access_group_permissions' => 'Rechte von Benutzergruppen verwalten',
        'access_user_permissions' => 'Rechte von Benutzern verwalten',
        'tab' => 'Rechte'
    ],

    'controllers' => [
        'users' => [
            'menu_label' => 'Berechtigungen',
            'menu_desc' => 'Wähle Berechtigungen',
            'tab' => 'Berechtigungen',
        ],
        'permissions' => [
            'preview_title' => 'Berechtigung anzeigen',
            'create_title' => 'Berechtigung erstellen',
            'update_title' => 'Berechtigung bearbeiten',
            'delete_title' => 'Berechtigung löschen',
            'delete_confirm' => 'Möchtest du diese Berechtigung wirklich löschen?',
        ],
    ],

    'models' => [
        'permission' => [
            'label' => 'Berechtigung',
            'label_plural' => 'Berechtigungen',
            'code' => 'Code',
            'code_comment' => 'Lasse Feld leer, um Code automatisch aus dem Namen zu generieren.',
            'comment' => 'Beschreibung',
            'label' => 'Name',
            'label_comment' => 'Name der Berechtigung.',
            'tab' => 'Gruppe',
            'tab_comment' => 'Wird für die Gruppierung von Berechtigungen verwendet.',
        ],
    ],
];
