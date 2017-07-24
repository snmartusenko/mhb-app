<?php

use yii\db\Migration;

class m970716_181705_relations extends Migration
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
        //transaction->operation
        $this->createIndex('fk_transaction_operation_idx', '{{%transaction}}', 'operation_id');
        $this->addForeignKey('fk_transaction_operation', '{{%transaction}}', 'operation_id', '{{%operation}}', 'id');

        //transaction->category
        $this->createIndex('fk_transaction_category_idx', '{{%transaction}}', 'category_id');
        $this->addForeignKey('fk_transaction_category', '{{%transaction}}', 'category_id', '{{%category}}', 'id');

        //transaction->account
        $this->createIndex('fk_transaction_account_idx', '{{%transaction}}', 'account_id');
        $this->addForeignKey('fk_transaction_account', '{{%transaction}}', 'account_id', '{{%account}}', 'id');

        //transaction->currency
        $this->createIndex('fk_transaction_currency_idx', '{{%transaction}}', 'currency_id');
        $this->addForeignKey('fk_transaction_currency', '{{%transaction}}', 'currency_id', '{{%currency}}', 'id');

        //transaction->contragent
        $this->createIndex('fk_transaction_contragent_idx', '{{%transaction}}', 'contragent_id');
        $this->addForeignKey('fk_transaction_contragent', '{{%transaction}}', 'contragent_id', '{{%contragent}}', 'id');

        //transaction->user
        $this->createIndex('fk_transaction_user_idx', '{{%transaction}}', 'user_id');
        $this->addForeignKey('fk_transaction_user', '{{%transaction}}', 'user_id', '{{%user}}', 'id');

        //category->operation
        $this->createIndex('fk_category_operation_idx', '{{%category}}', 'operation_id');
        $this->addForeignKey('fk_category_operation', '{{%category}}', 'operation_id', '{{%operation}}', 'id');
    }

    public function down()
    {
        //transaction->operation
        $this->dropForeignKey('fk_transaction_operation', '{{%transaction}}');
        $this->dropIndex('fk_transaction_operation_idx', '{{%transaction}}');

        //transaction->category
        $this->dropForeignKey('fk_transaction_category', '{{%transaction}}');
        $this->dropIndex('fk_transaction_category_idx', '{{%transaction}}');

        //transaction->account
        $this->dropForeignKey('fk_transaction_account', '{{%transaction}}');
        $this->dropIndex('fk_transaction_account_idx', '{{%transaction}}');

        //transaction->currency
        $this->dropForeignKey('fk_transaction_currency', '{{%transaction}}');
        $this->dropIndex('fk_transaction_currency_idx', '{{%transaction}}');

        //transaction->contragent
        $this->dropForeignKey('fk_transaction_contragent', '{{%transaction}}');
        $this->dropIndex('fk_transaction_contragent_idx', '{{%transaction}}');

        //transaction->user
        $this->dropForeignKey('fk_transaction_user', '{{%transaction}}');
        $this->dropIndex('fk_transaction_user_idx', '{{%transaction}}');

        //category->operation
        $this->dropForeignKey('fk_category_operation', '{{%category}}');
        $this->dropIndex('fk_category_operation_idx', '{{%category}}');
    }
}
