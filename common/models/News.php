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
 * @property integer $status
 * 
 * @property User $author 
 */
class News extends base\BaseNews
{
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
}

class NewsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => UtilsHelper::STATUS_ACTIVE]);
    }
}