<?php

namespace app\modules\mailList\models;

use app\models\Article;

/**
 * This is the model class for table "mailing_list_entry".
 *
 * @property int $id
 * @property int $mailing_list_id
 * @property int $article_id
 * @property string $lead
 *
 * @property Article $article
 * @property MailingList $mailingList
 */
class MailingListEntry extends \yii\db\ActiveRecord
{
    public $article_arr = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mailing_list_entry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mailing_list_id', 'article_id'], 'integer'],
            [['lead'], 'string', 'max' => 255],
            [['mailing_list_id', 'article_id', 'lead'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mailing_list_id' => 'Mailing List ID',
            'article_id' => 'Article ID',
            'lead' => 'Lead',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailingList()
    {
        return $this->hasOne(MailingList::class, ['id' => 'mailing_list_id']);
    }
}
