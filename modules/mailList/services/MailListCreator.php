<?php

namespace app\modules\mailList\services;

use app\modules\mailList\models\MailingList;
use app\modules\mailList\models\MailingListEntry;
use Yii;

class MailListCreator
{
    /**
     * @param MailingList $model
     */
    public function create($model)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $post = Yii::$app->request->post();
            $model->load($post);
            if (!$model->save()) {
                throw new \DomainException($this->getOneError($model));
            }
            MailingListEntry::deleteAll(['mailing_list_id' => $model->id]);
            $entry_form_name = (new MailingListEntry())->formName();
            $entry_arr = [];
            $keys = array_keys($post[$entry_form_name]);
            foreach ($keys as $key) {
                $entry = new MailingListEntry();
                $entry->mailing_list_id = $model->id;
                $entry_arr[$key] = $entry;
            }
            if (!MailingListEntry::loadMultiple($entry_arr, $post)) {
                throw new \DomainException('Failed to load models entries');
            }
            foreach ($entry_arr as $item) {
                if (!$item->save()) {
                    throw new \DomainException($this->getOneError($item));
                }
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new \DomainException($e->getMessage());
        }

    }

    /**
     * @param \yii\db\ActiveRecord $model
     * @return string
     */
    private function getOneError($model)
    {
        $errors = $model->firstErrors;
        $keys = array_keys($errors);
        return $errors[$keys[0]];
    }
}