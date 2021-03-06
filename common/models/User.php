<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\helpers\UtilsHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property integer $role
 */
class User extends base\BaseUser implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    const ROLE_ADMIN = 0;
    const ROLE_MODER = 1;
    const ROLE_USER = 2;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => UtilsHelper::STATUS_ACTIVE],
            ['status', 'in', 'range' => [UtilsHelper::STATUS_ACTIVE, UtilsHelper::STATUS_NOT_ACTIVE]],
            [['username','email'], 'unique'],
            [['username','email'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => UtilsHelper::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
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
        return static::findOne(['username' => $username, 'status' => UtilsHelper::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => UtilsHelper::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserData()
    {
        return $this->hasOne(UserData::className(), ['user_id' => 'id']);
    }
    
    /**
     * Get translated role name
     * @return string role
     */
    public function getRoleName(){
        return self::getRoles()[$this->role];
    }
    
    /**
     * Return user with data by ID
     * @param type $id User ID
     * @return type
     * @throws Exception
     */
    public static function getUser($id = null){
        if(!$id){
            throw new Exception('User ID not specified');
        }
        return static::find()->joinWith('userData')->where(['{{user}}.id'=>$id])->one();
    }
    
    /**
     * Returns current user with data
     * @return type
     */
    public static function getCurrentUser(){
        return static::find()->joinWith('userData')->where(['{{user}}.id' => \Yii::$app->user->id])->one();
    }

        /**
     * Return all users with their data and which have ROLE_USER
     * @return type
     */
    public static function getUsers(){
        return static::find()->joinWith('userData')->where(['role'=>self::ROLE_USER])->all();
    }
    
    /**
     * Returns array of all user roles
     * @return array roles
     */
    public static function getRoles(){
        return [
            self::ROLE_ADMIN => Yii::t('userRole', 'Admin'),
            self::ROLE_MODER => Yii::t('userRole', 'Moderator'),
            self::ROLE_USER => Yii::t('userRole', 'User'),
        ];
    }
}
