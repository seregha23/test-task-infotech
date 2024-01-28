<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

 /**
 *
 * @property int $id [int(11)]
 * @property string $login
 * @property string $email [varchar(128)]
 * @property string $username [varchar(64)]
 * @property string $auth_key [varchar(32)]
 * @property string $password_hash [varchar(255)]
 * @property string $created_at [timestamp]
 * @property string $updated_at [timestamp]
 * @property int $status_id [smallint(6)]
 * @property bool $is_deleted [tinyint(1)]
 *
 */
class User extends Base implements IdentityInterface
{


    public static  function tableName(): string {
        return '{{%users}}';
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): ?User {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status_id' => self::STATUS_PUBLISHED]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): ?bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        if (!$this->password_hash) {
            return false;
        }
        return app()->security->validatePassword($password, $this->password_hash);
    }

    public function generateAuthKey(): void
    {
        $this->auth_key = app()->security->generateRandomString();
    }

    public function setPassword(string $password): void
    {
        if (strlen($password)) {
            $this->password_hash = app()->security->generatePasswordHash($password);
        }
    }


    public function rules(): array {
        return [
            [['login', 'email', 'username'], 'safe'],
        ];
    }
}
