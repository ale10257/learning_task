<?php
/**
 * @var \yii\web\View $this
 * @var \yii\db\ActiveRecord $model
 * @var string $field
 */
?>
<?php if($model->firstErrors) : ?>
    <div class="has-error">
        <?php foreach($model->firstErrors as $key => $error) : ?>
            <?php if($key == $field) : ?>
                <p class="help-block"><?= $error ?></p>
            <?php endif ?>
        <?php endforeach ?>
    </div>
<?php endif ?>
