<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_data".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $office_id
 * @property integer $position_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $address
 * @property string $phone
 * @property string $skype
 * @property string $hire_date
 * @property string $birthday
 * @property string $comment
 * @property string $photo
 * @property integer $map_place
 *
 * @property Office $office
 * @property JobPosition $position
 * @property User $user
 */
class UserData extends base\BaseUserData
{
    const SCENARIO_CREATE = 'create';
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required', 'on' => 'default'],
            [['hire_date','office_id'], 'required', 'on' => 'create'],
            [['user_id', 'office_id', 'position_id', 'gender', 'map_place'], 'integer'],
            [['hire_date', 'birthday', 'gender'], 'safe'],
            [['comment'], 'string'],
            [['first_name', 'last_name', 'address', 'phone', 'skype', 'photo'], 'string', 'max' => 255],
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Office::className(), 'targetAttribute' => ['office_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = [
            'office_id',
            'position_id',
            'first_name',
            'last_name',
            'gender',
            'address',
            'phone',
            'skype',
            'hire_date',
            'birthday',
            'map_place'
        ];
        return $scenarios;
    }

    public function getFullName(){
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public static function getGenders(){
        return [
            self::GENDER_FEMALE => Yii::t('app', 'Female'),
            self::GENDER_MALE => Yii::t('app', 'Male')
        ];
    }
    
    /**
     * Get gender name
     * @param type $gender
     * @return type
     */
    public function getGenderName() {
        if (!$this->gender) {
            return \common\helpers\UtilsHelper::getNotSetMsg();
        }
        return \Yii::t('app', self::getGenders()[$this->gender]);
    }
}
