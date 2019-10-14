<?php
/* @var $minus bool */
/* @var $entry \app\modules\mailList\models\MailingListEntry */
/* @var $this \yii\web\View */
/* @var $id string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<tr>
    <td style="max-width: 250px; min-width: 250px;">
        <?= Html::dropDownList($entry->formName() . '[' . $id .'][article_id]', $entry->article_id, $entry->article_arr,
            [
                'id' => $id,
                'required' => true,
                'class' => 'mail-list-select2',
            ]) ?>
        <?= $this->render('_form_error', ['model' => $entry, 'field' => 'article_id']) ?>
    </td>
    <td>
        <?php $value = !empty($entry->article_id) ? $entry->article->title : null ?>
        <?= Html::textarea(null, $value, ['readonly' => true, 'class' => 'form-control title-text']) ?>
    </td>
    <td>
        <?= Html::textarea($entry->formName() . '[' . $id .'][lead]', $entry->lead, [
            'class' => 'form-control lead-text',
            'required' => true,
        ]) ?>
        <?= $this->render('_form_error', ['model' => $entry, 'field' => 'lead']) ?>
    </td>
    <td style="padding-top: 15px;" class="text-center">
        <?= Html::button('<span style="font-size: 20px;">+</span>',
            ['class' => 'btn btn-success add-entry', 'data-url' => Url::to(['add-entry'])]) ?>
    </td>
    <td style="padding-top: 15px;" class="text-center">
        <?php if ($minus) : ?>
            <?= Html::button('<span style="font-size: 20px;">&minus;</span>',
                ['class' => 'btn btn-danger delete-entry']) ?>
        <?php endif ?>
    </td>
</tr>

