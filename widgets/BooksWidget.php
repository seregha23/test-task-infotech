<?php

namespace app\widgets;

use app\models\Book;
use yii\base\Widget;
use yii\data\Pagination;

class BooksWidget extends Widget
{
    public string $widgetView = '';
    public string $orderBy = 'id DESC';
    public string $caption = 'N/A';
    /** @var Book[] $books */
    public array $books = [];
    public ?Pagination $pagination = null;

    public function init(): void {
        $query = Book::find()->published();

        $countQuery = clone $query;
        $this->pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 6,
            'pageSizeParam' => false,
            'forcePageParam' => false,
        ]);
        $this->books = $query->offset( $this->pagination->offset)
            ->limit( $this->pagination->limit)
            ->all();

    }

    public function run(): string {
        if (!$this->books) {
            return '';
        }
        return $this->render($this->widgetView ?: "//books/_widget_books", ['books' => $this->books, 'pagination' => $this->pagination, 'caption' => $this->caption]);
    }
}