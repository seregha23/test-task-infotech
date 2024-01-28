<?php

namespace app\services;

use app\models\Book;
use app\models\BookToAuthor;

class BooksService
{
    public static function saveBooksToAuthors(array $authorIds, Book $book): void
    {
        $oldAuthorIds = $book->getAuthorIds();
        $newAuthorIds = $authorIds;
        $authorIdsToAdd    = array_diff($newAuthorIds, $oldAuthorIds);
        $authorIdsToDelete = array_diff($oldAuthorIds, $newAuthorIds);

        foreach ($authorIdsToAdd as $authorIdToAdd) {
            $bookToAuthor = new BookToAuthor();
            $bookToAuthor->book_id = $book->id;
            $bookToAuthor->author_id = $authorIdToAdd;
            $bookToAuthor->save();
        }

        if ($authorIdsToDelete) {
            BookToAuthor::deleteAll(['and', ['author_id' => $authorIdsToDelete], 'book_id' => $book->id]);
        }
    }

}