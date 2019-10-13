<?php

use yii\db\Migration;

/**
 * Class m191012_033504_mailing_list
 */
class m191012_033504_mailing_list extends Migration
{
    protected $table = '{{%mailing_list}}';
    protected $tableOptions;
    public function safeUp()
    {
        parent::safeUp();

        if ($this->db->driverName === 'mysql') {
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table,
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
            ],
            $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
