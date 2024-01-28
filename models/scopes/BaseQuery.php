<?php
namespace app\models\scopes;

use app\models\Base;
use yii\db\ActiveQuery;

class BaseQuery extends ActiveQuery {
    public string $tableName = '';

    public function published(): BaseQuery {
        $this->andWhere([$this->tableName.'.status_id' => Base::STATUS_PUBLISHED, $this->tableName.'.is_deleted' => 0]);
        return $this;
    }
}