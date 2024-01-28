<?php

use yii\db\Migration;

/**
 * Class m240122_065419_ct_subscribers
 */
class m240122_065419_ct_subscribers extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%subscribers}}', [
            'id'         => $this->primaryKey(),
            'email'       => $this->string(25)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'status_id'  => $this->smallInteger()->notNull()->defaultValue(1),
            'is_deleted' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%subscribers}}');
        return true;
    }
}
