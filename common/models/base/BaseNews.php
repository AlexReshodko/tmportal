<?php

namespace common\models\base;

use Yii;

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
 * @property \common\models\User $author
 */
class BaseNews extends \yii\db\ActiveRecord
{
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
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['author_id' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'author_id']);
    }
}
