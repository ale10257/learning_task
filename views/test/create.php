<?php

/**
 * @var \yii\web\View $this
 * @var \app\forms\DocumentForm $documentForm
 * @var \app\forms\ListForm $listForm
 */

use yii\helpers\Html;

$this->title = 'Create Document';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'documentForm' => $documentForm,
        'listForm' => $listForm,
    ]) ?>

</div>
