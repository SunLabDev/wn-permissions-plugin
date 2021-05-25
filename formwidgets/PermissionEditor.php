<?php namespace SunLab\Permissions\FormWidgets;

use Backend\Classes\FormField;
use SunLab\Permissions\Models\Permission;

/**
 * PermissionEditor Form Widget
 */
class PermissionEditor extends \Backend\FormWidgets\PermissionEditor
{
    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->addViewPath(base_path('modules/backend/formwidgets/permissioneditor/partials'));

        $this->addCss('/modules/backend/formwidgets/permissioneditor/assets/css/permissioneditor.css');
        $this->fillFromConfig([
            'mode',
            'availablePermissions',
        ]);

        $this->user = $this->getParentForm()->model;
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        parent::prepareVars();
        $this->vars['permissionsData'] =
            Permission::query()
                      ->select(['code', 'label', 'tab'])
                      ->whereKey($this->vars['permissionsData'])
                      ->get()
                      ->keyBy('code')
                      ->toArray();
    }

    protected function getFilteredPermissions()
    {
        return collect($this->availablePermissions)->groupBy('tab');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        if ($this->formField->disabled || $this->formField->hidden) {
            return FormField::NO_SAVE_DATA;
        }

        if (is_string($value) && !strlen($value)) {
            return null;
        }

        if (is_array($value) && !count($value)) {
            return null;
        }

        return $value;
    }
}
