<?php

namespace app\models;


/**
 * This is the model class for table "documents_list".
 *
 * @property int $id
 * @property string $name
 * @property int $id_document
 *
 * @property Document $document
 */
class DocumentList extends BaseActiveRecord
{
    public static function tableName()
    {
        return 'documents_list';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id_document'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function getDocument()
    {
        return $this->hasOne(Document::class, ['id' => 'id_document']);
    }
}
