<?php

namespace app\models;


/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocumentList $documentList
 */
class Document extends BaseActiveRecord
{
    public static function tableName()
    {
        return 'documents';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function getDocumentList()
    {
        return $this->hasOne(DocumentList::class, ['id_document' => 'id']);
    }
}
