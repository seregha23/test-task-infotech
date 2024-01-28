<?php

use yii\db\Migration;

/**
 * Class m240121_155742_ct_books_to_authors
 */
class m240121_155742_ct_books_to_authors extends Migration
{

    public function safeUp(): void
    {
        $this->createTable('{{%books_to_authors}}', [
            'id'         => $this->primaryKey(),
            'book_id'    => $this->integer()->notNull(),
            'author_id'  => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey('fk_books_to_authors_book_id', '{{%books_to_authors}}', 'book_id', '{{%books}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_books_to_authors_author_id', '{{%books_to_authors}}', 'author_id', '{{%authors}}', 'id', 'CASCADE');

        $this->createIndex('book_id_author_id_idx', '{{%books_to_authors}}', ['book_id', 'author_id']);
    }

    public function safeDown(): bool
    {
        $this->dropTable('{{%books_to_authors}}');
        return true;
    }
}
