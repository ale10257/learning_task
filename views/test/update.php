<?php

/**
 * @var \yii\web\View $this
 * @var \app\forms\DocumentForm $documentForm
 * @var \app\forms\ListForm $listForm
 */

use yii\helpers\Html;

$this->title = 'Update Document: ' . $documentForm->name;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $documentForm->name, 'url' => ['view', 'id' => $documentForm->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="document-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'documentForm' => $documentForm,
        'listForm' => $listForm,
    ]) ?>

</div>
