<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // $this->render('_search', ['model' => $searchModel, 'data_name'=>$data_name]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'store',
                'format' => 'raw',
                'filter' =>  Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'store',
                    'data' => ArrayHelper::map(\frontend\models\Device::find()->asArray()->all(), 'store', 'store'),
                    'value' => 'store',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Выберите значение'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'selectOnClose' => true,
                    ]
                ]),
            ],
            'date_created',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
