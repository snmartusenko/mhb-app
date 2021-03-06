<?php

use yii\db\Migration;

class m870716_181740_initdata extends Migration
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
        $this->insert('user', [
            'id' => 1,
            'username' => 'Serg',
            'auth_key' => 'el8MV1CdEejglZJVQj3LuMDv-GwmoZAE',
            'password_hash' => '$2y$13$gRMtRghJcA66IqUCys2moOs6pIJG/d7NqDVht6F3fePtjHf.wfgpS', //111111
            'password_reset_token' => null,
            'email' => 'snmartusenko@gmail.com',
            'status' => 10,
            'created_at' => 1500708122,
            'updated_at' => 1500708122,
        ]);

        Yii::$app->db->createCommand()->batchInsert('account',
            ['id', 'name', 'status', 'created_at'],
            [
                [1, 'Счет1', 10, 1500708122],
                [2, 'Счет2', 10, 1500708122],
                [3, 'Счет3', 10, 1500708122],
            ])->execute();

        Yii::$app->db->createCommand()->batchInsert('category',
            ['id', 'operation_id', 'name', 'status', 'created_at'],
            [
                [1, 1, '(общий)', 10, 1500708122],
                [2, 2, '(общий)', 10, 1500708122],
                [3, 3, '(общее)', 10, 1500708122],
                [4, 1, 'ЗП', 10, 1500708122],
                [5, 1, 'Подработка', 10, 1500708122],
                [6, 1, 'Подарки', 10, 1500708122],
                [7, 1, 'Ввод остатков', 10, 1500708122],
                [8, 2, 'Жилье', 10, 1500708122],
                [9, 2, 'Продукты', 10, 1500708122],
                [10, 2, 'Одежда', 10, 1500708122],
                [11, 2, 'Транспорт', 10, 1500708122],
                [12, 2, 'Развлечения', 10, 1500708122],
                [13, 2, 'Разное', 10, 1500708122],
            ])->execute();

        Yii::$app->db->createCommand()->batchInsert('contragent',
            ['id', 'name', 'status', 'created_at'],
            [
                [1, 'Контрагент1', 10, 1500708122],
                [2, 'Контрагент2', 10, 1500708122],
                [3, 'Контрагент3', 10, 1500708122],
            ])->execute();

        Yii::$app->db->createCommand()->batchInsert('currency',
            ['id', 'name', 'status', 'created_at'],
            [
                [1, 'UAH', 10, 1500708122],
                [2, 'USD', 10, 1500708122],
                [3, 'EUR', 10, 1500708122],
            ])->execute();

        Yii::$app->db->createCommand()->batchInsert('operation',
            ['id', 'name', 'status', 'created_at'],
            [
                [1, 'Приход', 10, 1500708122],
                [2, 'Расход', 10, 1500708122],
                [3, 'Перемещение', 10, 1500708122],
            ])->execute();

        Yii::$app->db->createCommand()->batchInsert('balance',
            ['id', 'account_id', 'income', 'expense', 'current', 'accounting_datetime'],
            [
                [1, 1, 0, 0, 0, 1500708122],
                [2, 2, 0, 0, 0, 1500708122],
                [3, 3, 0, 0, 0, 1500708122],
            ])->execute();
    }

    public function down()
    {

    }
}
