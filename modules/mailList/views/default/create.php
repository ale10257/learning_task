<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\mailList\models\MailingList */
/* @var $entries \app\modules\mailList\models\MailingListEntry[] */

$this->title = 'Create Mailing List';
$this->params['breadcrumbs'][] = ['label' => 'Mailing Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-list-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', compact('model', 'entries')) ?>

</div>
