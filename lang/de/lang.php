<?php

return [
    'plugin' => [
        'name' => 'Rechte',
        'description' => 'Verwaltung von Benutzerrechten für Frontend-Anwendungen',
        'access_permissions' => 'Benutzerrechte verwalten',
        'access_group_permissions' => 'Rechte von Benutzergruppen verwalten',
        'access_user_permissions' => 'Rechte von Benutzern verwalten',
        'tab' => 'Rechte'
    ],
    'permissions' => [
        'menu_label' => 'Berechtigungen',
        'menu_desc' => 'Wähle Berechtigungen',
        'view_permission' => 'Berechtigung anzeigen',
        'create_permission' => 'Berechtigung erstellen',
        'update_permission' => 'Berechtigung bearbeiten',
        'delete_permission' => 'Berechtigung löschen',
        'delete_confirm' => 'Möchtest du diese Berechtigung wirklich löschen?',
    ],
    'permission' => [
        'fields' => [
            'code' => 'Code',
            'code_comment' => 'Lasse Feld leer, um Code automatisch aus dem Namen zu generieren.',
            'name' => 'Name',
            'comment' => 'Beschreibung',
        ],
        'delete_permission' => 'Berechtigung löschen',
    ],
];
