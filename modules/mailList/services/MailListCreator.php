<?php

namespace app\modules\mailList\services;

use app\modules\mailList\models\MailingList;
use app\modules\mailList\models\MailingListEntry;
use Yii;

class MailListCreator
{
    /**
     * @param MailingList $model
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function create($model)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $post = Yii::$app->request->post();
        $model->load($post);
        if (!$model->save()) {
            $entry_arr = $this->getEntryArr($post, $model);
            return $this->returnError($transaction, $model, $entry_arr);
        }
        $entry_arr = $this->getEntryArr($post, $model);
        MailingListEntry::deleteAll(['mailing_list_id' => $model->id]);
        $error = false;
        foreach ($entry_arr as $item) {
            if (!$item->save()) {
                $error = true;
            }
        }
        if ($error) {
            return $this->returnError($transaction, $model, $entry_arr);
        }
        $transaction->commit();
        return [
            'error' => $error
        ];
    }

    /**
     * @param MailingListEntry[] $entry_arr
     * @return MailingListEntry[]|array
     */
    public function setEntryArr(array $entry_arr)
    {
        foreach ($entry_arr as $entry_model) {
            if (!empty($entry_model->article_id)) {
                $entry_model->article_arr[$entry_model->article_id] = $entry_model->article->title;
            }
        }
        return $entry_arr;
    }

    /**
     * @param \yii\db\Transaction $transaction
     * @param MailingList $model
     * @param MailingListEntry[] $entry_arr
     * @return array
     */
    private function returnError($transaction, $model, $entry_arr)
    {
        $transaction->rollBack();
        return [
            'error' => true,
            'model' => $model,
            'entries' => $this->setEntryArr($entry_arr)
        ];
    }

    /**
     * @param array $post
     * @param MailingList $model
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getEntryArr($post, $model)
    {
        $entry_form_name = (new MailingListEntry())->formName();
        $entry_arr = [];
        $keys = array_keys($post[$entry_form_name]);
        foreach ($keys as $key) {
            $entry = new MailingListEntry();
            $entry->mailing_list_id = $model->id;
            $entry_arr[$key] = $entry;
        }
        MailingListEntry::loadMultiple($entry_arr, $post);
        return $entry_arr;
    }
}