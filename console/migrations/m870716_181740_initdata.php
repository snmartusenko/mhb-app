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
                [1, 1, 'ЗП', 10, 1500708122],
                [2, 1, 'Подработка', 10, 1500708122],
                [3, 1, 'Ввод остатков', 10, 1500708122],
                [4, 2, 'Жилье', 10, 1500708122],
                [5, 2, 'Продукты', 10, 1500708122],
                [6, 2, 'Разное', 10, 1500708122],
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
                [1, 'Доход', 10, 1500708122],
                [2, 'Расход', 10, 1500708122],
                [3, 'Перемещение', 10, 1500708122],
            ])->execute();
    }

    public function down()
    {

    }
}
