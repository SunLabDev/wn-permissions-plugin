<?php Block::put('breadcrumb') ?>
    <ul>
        <li><a href="<?= Backend::url('sunlab/permissions/permissions') ?>"><?= e(trans('sunlab.permissions::lang.models.permission.label_plural')); ?></a></li>
        <li><?= e($this->pageTitle) ?></li>
    </ul>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <?= Form::open(['class'=>'layout']) ?>

        <div class="layout-row">
            <?= $this->formRender() ?>
        </div>

        <div class="form-buttons">
            <div class="loading-indicator-container">
                <button
                    type="button"
                    data-request="onSave"
                    data-request-data="close:1"
                    data-hotkey="ctrl+enter, cmd+enter"
                    data-load-indicator="Saving Permission..."
                    class="btn btn-default">
                    Save and Close
                </button>
                <button
                    type="button"
                    class="oc-icon-trash-o btn-icon danger pull-right"
                    data-request="onDelete"
                    data-load-indicator="Deleting Permission..."
                    data-request-confirm="<?= e(trans('sunlab.permissions::lang.permissions.delete_confirm')) ?>">
                </button>
                <span class="btn-text">
                    or <a href="<?= Backend::url('sunlab/permissions/permissions') ?>">Cancel</a>
                </span>
            </div>
        </div>

    <?= Form::close() ?>

<?php else: ?>

    <p class="flash-message static error"><?= e($this->fatalError) ?></p>
    <p><a href="<?= Backend::url('sunlab/permissions/permissions') ?>" class="btn btn-default"><?= e(trans('backend::lang.form.return_to_list')); ?></a></p>

<?php endif ?>
