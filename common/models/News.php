<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $text
 * @property string $date
 * @property string $thumbnail
 * @property integer $views
 * @property integer $published
 * @property integer $deleted
 */
class News extends \yii\db\ActiveRecord
{
    
    const STATUS_ACTIVE = NULL;
    const STATUS_DELETED = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'title'], 'required'],
            [['author_id', 'views', 'published', 'deleted'], 'integer'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['title', 'thumbnail'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserData', 'ID'),
            'author_id' => Yii::t('UserData', 'Author ID'),
            'title' => Yii::t('UserData', 'Title'),
            'text' => Yii::t('UserData', 'Text'),
            'date' => Yii::t('UserData', 'Date'),
            'thumbnail' => Yii::t('UserData', 'Thumbnail'),
            'views' => Yii::t('UserData', 'Views'),
            'published' => Yii::t('UserData', 'Published'),
            'deleted' => Yii::t('UserData', 'Deleted'),
        ];
    }
    
    /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getAuthor() 
   { 
       return $this->hasOne(User::className(), ['id' => 'author_id']); 
   } 
}
