<?php
namespace app\models;

use yii\db\ActiveRecord;

class BaseActiveRecord extends ActiveRecord
{
    /**
     * @param int|string $id
     * @param string $field
     * @return $this|null
     */
    public function getItem($id, $field = 'id')
    {
        if (!$object = static::findOne([$field => $id])) {
            throw new \DomainException($this->strClass() . '. Not found!');
        }
        return $object;
    }

    public function saveItem()
    {
        if (!static::save()) {
            throw new \DomainException($this->strClass() . '. Saving is error: ' . json_encode($this->errors, JSON_UNESCAPED_UNICODE));
        }
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteItem($id)
    {
        $model = $this->getItem($id);
        if (!$model->delete()) {
            throw new \DomainException($this->strClass() . ' .Delete is error!');
        }
    }

    protected function strClass()
    {
        return 'Class: ' . get_class($this);
    }
}