<?php

use yii\db\Migration;

/**
 * Class m240118_074335_ct_books
 */
class m240118_074335_ct_books extends Migration
{

    public function safeUp(): void
    {
        $this->createTable('{{%books}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'slug'        => $this->string()->notNull(),
            'year'        => $this->integer(),
            'description' => $this->text(),
            'isbn'        => $this->string(13)->unique(),
            'image'       => $this->string(),
            'created_at'  => $this->dateTime()->notNull(),
            'updated_at'  => $this->dateTime()->notNull(),
            'status_id'   => $this->smallInteger()->notNull()->defaultValue(1),
            'is_deleted'  => $this->smallInteger()->notNull()->defaultValue(0),
        ]);
    }

    public function safeDown(): bool
    {
        $this->dropTable('{{%books}}');
        return true;
    }
}
