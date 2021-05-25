## Permissions

Front-end user permissions management.

### Composer installation
```terminal
composer require sunlab/wn-permissions-plugin
```

### Requirements

This plugin requires the [Winter.User](https://github.com/wintercms/wn-user-plugin) Plugin.

### Creating Permissions

In the backend, navigate to Winter "Users" menu, on the left side there should
be an open lock icon with the name "Permissions". Click this, and it will take you
to the list of permission.
- Click "New Permission" to get to a form where you can enter information about a new
permission you would like to create.
- Click on a permission in the list to manage existing permissions.

### Managing User Permissions

In the backend, navigate to Winter "Users" menu, now on a User model updating page,
you can manage his permission at his user-level.

### Managing Group Permissions

In the backend, navigate to Winter "Users" menu, into the side menu, select `Groups`.
Now on a `Group` model updating page,
you can manage the permissions that will be granted for every `User` in that group.

### Using Permissions in your own development

Since every user model is now extended with the `hasUserPermission` method,
it is available in both twig and backend php i.e.

**For Twig**
```twig
{% if user.hasUserPermission(['can-eat-cake', 'can-take-cheese']) %}
    <p>This user has all above permissions</p>
{% else %}
    <p>This user does not have permission</p>
{% endif %}

{% if user.hasUserPermission(['can-eat-cake', 'can-take-cheese'], 'one') %}
    <p>This user has one of the above permissions</p>
{% else %}
    <p>This user does not have permission</p>
{% endif %}
```

**For Backend**
```php
if ($user->hasUserPermission(['can-eat-cake', 'can-take-cheese'])) {
    // This user has all above permissions
} else {
    // This user does not have permission
}

if ($user->hasUserPermission(['can-eat-cake', 'can-take-cheese'], 'one')) {
    // This user has one of the above permissions
} else {
    // This user does not have permission
}
```
