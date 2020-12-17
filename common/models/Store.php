<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $name
 * @property string $date_created
 * @property string $date_updated

 */
class Store extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'store';
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
            [['name'], 'required'],
            [['name'], 'string'],
            [['name'], 'unique'],
            [['date_updated','date_created'], 'datetime'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'Имя',
            'date_updated'=>'Дата обновлена',
            'date_created'=>'Дата создания'
        ];
    }

    /**
     * @param Store $model
     * @return array
     */
    static function getDevices(Store $model):array
    {
        return Device::find()
            ->where(['store_id'=>$model->id])
            ->all();
    }
    function getPropertiesForSearch($key, $value): array
    {
        return ArrayHelper::map( \frontend\models\Store::find()->all(),$key, $value);
    }
}
