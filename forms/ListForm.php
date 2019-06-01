<?php

namespace app\forms;

use app\models\Document;
use app\models\DocumentList;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class ListForm extends Model
{
    /** @var string */
    public $name;
    /** @var int */
    public $id_document;

    /** @var DocumentList */
    private $documentList;
    /** @var Document */
    private $document;

    public function __construct(DocumentList $documentList, Document $document)
    {
        parent::__construct();
        $this->documentList = $documentList;
        $this->document = $document;
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id_document'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function getForm($document_id = null)
    {
        if (!$document_id) {
            return $this;
        }
        $document = $this->document->getItem($document_id);
        if (!$documentList = $document->documentList) {
            new NotFoundHttpException('Data not found!');
        }
        $this->name = $documentList->name;
        $this->id_document = $documentList->id_document;
        return $this;
    }

    public function saveForm($document_id)
    {
        $this->id_document = $document_id;
        if (!$documentList = $this->documentList::find()->where(['id_document' => $document_id])->one()) {
            $documentList = $this->documentList;
        }
        $documentList->name = trim($this->name);
        $documentList->id_document = $this->id_document;
        $documentList->saveItem();
    }
}