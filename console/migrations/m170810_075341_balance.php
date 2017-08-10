<?php

use yii\db\Migration;

class m170810_075341_balance extends Migration
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

        $this->createTable('balance', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(),
            'income' => $this->integer(),
            'expense' => $this->integer(),
            'current' => $this->integer(),
            'accounting_datetime' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('balance');
    }
}
