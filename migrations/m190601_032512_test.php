<?php

use yii\db\Migration;

/**
 * Class m190601_032512_test
 */
class m190601_032512_test extends Migration
{
    protected $table_spravka = '{{%documents}}';
    protected $table_list = '{{%documents_list}}';
    protected $tableOptions;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table_spravka, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull()
        ], $this->tableOptions);

        $this->createTable($this->table_list, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_document' => $this->integer()
        ], $this->tableOptions);

        $this->addForeignKey('fk-document-id', $this->table_list, 'id_document', $this->table_spravka, 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
