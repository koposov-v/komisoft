<?php

namespace frontend\models;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\db\Expression;
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
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d '),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'data'], 'required'],
            [['data'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'data' => 'Data',
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
}
