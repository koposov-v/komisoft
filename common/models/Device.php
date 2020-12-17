<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property string|null $store
 * @property string|null $data
 */
class Device extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_created', 'date_updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_updated'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_updated','date_created'], 'datetime'],
            [['store'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store' => 'Store',
            'date_updated'=>'Дата обновлена',
            'date_created'=>'Дата создания',
        ];
    }
    static function select_data($key, $value){
        return ArrayHelper::map( self::find()->all(),$key, $value);
    }

}
