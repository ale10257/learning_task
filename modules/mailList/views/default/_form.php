<?php

/* @var $this yii\web\View */
/* @var $model app\modules\mailList\models\MailingList */
/* @var $entries app\modules\mailList\models\MailingListEntry[] */

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\mailList\assets\Select2Asset;

Select2Asset::register($this);

$url_set = Url::to(['search-article']);
$url_add = Url::to(['add-entry']);
$url_add_lead = Url::to(['lead-entry']);

$js = "
    $(function () {
        function setSelect2 (obj) {
            obj.select2({
                language: 'ru',
                placeholder: 'Выберите статью',
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '$url_set',
                    dataType: 'json',
                    delay: 250,
                    cache: true,
                },
                allowClear: true
            });
        };
        $('.mail-list-select2').each(function () {
            setSelect2 ($(this));
        });
        $(document).on('change', '.mail-list-select2', function () {
            let current = $(this);
            let val = current.val();
            let id  = current.attr('id');
            let titleField = current.parents('tr').find('.title-text');
            let leadField = current.parents('tr').find('.lead-text');
            $('.mail-list-select2').each(function () {
                if ($(this).attr('id') !== id && $(this).val() === val) {
                    alert('Эта статья уже выбрана!');
                    current.html('<option></option>');
                    return false;
                }
                if (val) {
                    $.post('$url_add_lead', {article_id: val}, function (data) {
                       titleField.val(data.title);
                       leadField.val(data.lead);
                    });
                }
            });
        });
        $(document).on('click', '.add-entry', function () {
            let tr = $(this).parents('tr');
            $.post('$url_add', function (data) {
                tr.after(data.tr);
                setSelect2 ($('#' + data.id));
            });
        });
        $(document).on('click', '.delete-entry', function () {
            $(this).parents('tr').remove();
        });
    });
";
$this->registerJs($js, \yii\web\View::POS_END);
?>
<script>

</script>
<div class="mailing-list-form">

    <?= Html::beginForm() ?>

    <div class="form-group">
        <?= Html::textInput($model->formName() . '[title]', $model->title, ['class' => 'form-control']) ?>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Статья</th>
            <th>Заголовок</th>
            <th>Лид</th>
            <th></th>
            <th></th>
        </tr>
        <?php $i = 0 ?>
        <?php foreach ($entries as $entry) : ?>
            <?php $minus = $i == 0 ? false : true ?>
            <?= $this->render('_entry_form', ['entry' => $entry, 'minus' => $minus, 'id' => null]) ?>
            <?php $i++ ?>
        <?php endforeach ?>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?= Html::endForm() ?>

</div>
