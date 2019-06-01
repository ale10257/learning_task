<?php


namespace app\forms;


use app\models\Document;
use yii\base\Model;

class DocumentForm extends Model
{
    /** @var int */
    public $id;
    /** @var string */
    public $name;


    /** @var Document */
    private $document;

    public function __construct(Document $document)
    {
        parent::__construct();
        $this->document = $document;
    }

    public function rules()
    {
        $rules = [
            ['name', 'required'],
            ['name', 'string'],
        ];
        if (!$this->id) {
            $rules[] = ['name', 'unique', 'targetClass' => Document::class];
        } else {
            $rules[] = ['name', 'unique', 'targetClass' => Document::class, 'filter' => ['<>', 'id', $this->id]];
        }

        return $rules;
    }

    public function getForm($id = null)
    {
        if ($id) {
            $document = $this->document->getItem($id);
            $this->id = $id;
            $this->name = $document->name;
        }
        return $this;
    }

    public function saveForm($id = null)
    {
        $document = $id ? $this->document->getItem($id) : $this->document;
        $document->name = trim($this->name);
        $document->saveItem();
        return $document;
    }
}