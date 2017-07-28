<?php

use yii\db\Migration;

class m170716_181520_transaction extends Migration
{
    // Use safeUp()/down() to run migration code with a transaction.
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('transaction', [
            'id' => $this->primaryKey(),

            'date' => $this->integer()->notNull(),
            'operation_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'account_id' => $this->integer()->notNull(),
            'value' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->notNull(),
            'contragent_id' => $this->integer(),

            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('transaction');
    }
}
