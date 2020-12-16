<?php

namespace frontend\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $name
 * @property string $data
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
    static function OutputIdStore($name){
        $query  = new Query();
        $query->select
        (['id'
        ])
            ->from('device')
            ->where("device.store='$name'");
        $command= $query->createCommand();
        $result = $command->queryAll();
        $final= [];
        foreach ($result as $item){
            array_push($final,$item['id'].' ');
        }
        return $final;
    }
    static function select_data($key, $value){
        return ArrayHelper::map( self::find()->all(),$key, $value);
    }

}
