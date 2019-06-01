<?php

/**
 * @var \yii\web\View $this
 * @var \app\forms\DocumentForm $documentForm
 * @var \app\forms\ListForm $listForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\TestAsset;
use yii\helpers\Url;

TestAsset::register($this);

?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($documentForm, 'name')->textInput([
        'id' => 'document_input',
        'data' => [
            'url' => Url::to(['check-name']),
            'id' => $documentForm->id
        ]
    ])->label('Document name') ?>

    <div style="display: none;" id="document-list-block">
        <?= $form->field($listForm, 'name')->textInput(['id' => 'document_list_input'])->label('List name') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
