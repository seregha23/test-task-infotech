<?php
namespace app\models;


/**
 *
 * @property int $id [int(11)]
 * @property string $email [varchar(128)]
 * @property int $created_at [timestamp]
 * @property int $updated_at [timestamp]
 * @property bool $status_id [tinyint]
 * @property bool $is_deleted [tinyint]
 */

class Subscriber extends Base {

    public static function tableName(): string {
        return '{{%subscribers}}';
    }
}