<?php

namespace app\controllers;

use yii\data\Pagination;
use yii\web\Controller;

class BaseController extends Controller
{

    protected function getPaginator(int $totalCount, int $pageSize = 6): Pagination
    {
        return new Pagination([
            'totalCount' => $totalCount,
            'pageSize' => $pageSize,
            'pageSizeParam' => false,
            'forcePageParam' => false,
        ]);
    }
}