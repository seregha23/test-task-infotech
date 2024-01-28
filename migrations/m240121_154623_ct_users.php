<?php

use yii\db\Migration;

/**
 * Class m240121_154623_ct_users
 */
class m240121_154623_ct_users extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%users}}', [
            'id'               => $this->primaryKey(),
            'login'            => $this->string(25)->notNull(),
            'username'         => $this->string(50)->notNull(),
            'password_hash'    => $this->string(64)->notNull(),
            'email'            => $this->string(100)->notNull(),
            'auth_key'         => $this->string(32)->notNull(),
            'created_at'       => $this->dateTime()->notNull(),
            'updated_at'       => $this->dateTime()->notNull(),
            'status_id'        => $this->smallInteger()->notNull()->defaultValue(1),
            'is_deleted'       => $this->smallInteger()->notNull()->defaultValue(0),
        ]);
    }

    public function safeDown(): bool
    {
        $this->dropTable('{{%users}}');
        return true;
    }
}
