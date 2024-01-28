<?php

use yii\db\Migration;

/**
 * Class m240118_074401_ct_authors
 */
class m240118_074401_ct_authors extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%authors}}', [
            'id'         => $this->primaryKey(),
            'slug'       => $this->string()->notNull(),
            'first_name' => $this->string(25)->notNull(),
            'surname'    => $this->string(50)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'status_id'  => $this->smallInteger()->notNull()->defaultValue(1),
            'is_deleted' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);
    }


    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
        return true;
    }
}
