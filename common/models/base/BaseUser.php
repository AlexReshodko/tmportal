<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property News[] $news
 * @property UserData[] $userDatas
 * @property UserPollValue[] $userPollValues
 */
class BaseUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('User', 'ID'),
            'username' => Yii::t('User', 'Username'),
            'auth_key' => Yii::t('User', 'Auth Key'),
            'password_hash' => Yii::t('User', 'Password Hash'),
            'password_reset_token' => Yii::t('User', 'Password Reset Token'),
            'email' => Yii::t('User', 'Email'),
            'role' => Yii::t('User', 'Role'),
            'status' => Yii::t('User', 'Status'),
            'created_at' => Yii::t('User', 'Created At'),
            'updated_at' => Yii::t('User', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDatas()
    {
        return $this->hasMany(UserData::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPollValues()
    {
        return $this->hasMany(UserPollValue::className(), ['user_id' => 'id']);
    }
}
