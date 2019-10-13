<?php

namespace app\modules\mailList\models;

/**
 * This is the model class for table "mailing_list".
 *
 * @property int $id
 * @property string $title
 *
 * @property MailingListEntry[] $mailingListEntries
 */
class MailingList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mailing_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['title'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailingListEntries()
    {
        return $this->hasMany(MailingListEntry::class, ['mailing_list_id' => 'id']);
    }
}
