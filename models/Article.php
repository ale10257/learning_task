<?php

namespace app\models;


use app\modules\mailList\models\MailingListEntry;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $lead
 *
 * @property MailingListEntry[] $mailingListEntries
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'lead'], 'string', 'max' => 255],
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
            'lead' => 'Lead',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailingListEntries()
    {
        return $this->hasMany(MailingListEntry::class, ['article_id' => 'id']);
    }
}
