<?php

namespace common\models;

use Yii;
use common\helpers\UtilsHelper;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $text_preview 
 * @property string $text
 * @property string $date
 * @property integer $views
 * @property integer $published
 * @property integer $deleted
 * 
 * @property User $author 
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
            [['title', 'text_preview'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('News', 'ID'),
            'author_id' => Yii::t('News', 'Author ID'),
            'title' => Yii::t('News', 'Title'),
            'text_preview' => Yii::t('News', 'Text Preview'), 
            'text' => Yii::t('News', 'Text'),
            'date' => Yii::t('News', 'Date'),
            'views' => Yii::t('News', 'Views'),
            'published' => Yii::t('News', 'Published'),
            'deleted' => Yii::t('News', 'Deleted'),
        ];
    }
    
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
    
    /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getAuthor() 
   { 
       return $this->hasOne(User::className(), ['id' => 'author_id']); 
   }
}

class NewsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['published' => UtilsHelper::STATUS_PUBLISHED, 'deleted' => UtilsHelper::STATUS_NOT_DELETED]);
    }
}