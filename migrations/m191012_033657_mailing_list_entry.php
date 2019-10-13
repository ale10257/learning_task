<?php

use yii\db\Migration;


class m191012_033657_mailing_list_entry extends Migration
{
    protected $table = '{{%mailing_list_entry}}';
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
                'mailing_list_id' => $this->integer(),
                'article_id' => $this->integer(),
                'lead' => $this->string()
            ],
            $this->tableOptions);

        $this->addForeignKey('mailing_list_id-fk', $this->table, 'mailing_list_id', 'mailing_list', 'id', 'CASCADE');
        $this->addForeignKey('article_id-fk', $this->table, 'article_id', 'articles', 'id');
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
