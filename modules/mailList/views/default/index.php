<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\mailList\models\MailingListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mailing Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-list-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Mailing List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
