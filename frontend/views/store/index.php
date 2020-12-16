<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php



Modal::begin([
    'header'=>'<h2>Список устройств</h2>',
    'options' => [
        'id'=>'events',
    ]
]);
echo "<div id='modelContent'></div>";

Modal::end();


?>
<div class="store-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Store', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?//=$this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'filter' =>  Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'name',
                    'data' => ArrayHelper::map(\frontend\models\Store::find()->asArray()->all(), 'name', 'name'),
                    'value' => 'name',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Выберите значение'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'selectOnClose' => true,
                    ]
                ]),
                'value' => function($model){
                    return Html::a("$model->name",
                        ["store/?storeid=$model->id"],
                        [
                            'data-toggle'=>'modal',
                            'data-target'=> '#events',
                            'class' => 'modal-store',
                            'data-id'=>"$model->id",
                        ]
                    );
                },
            ],
            [
                'attribute' => 'date_created',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?php
$js =<<<JS
    $(document).ready(function (){
        $('.modal-store').click(function (){
            var store_id = $(this).data('id')
            showModal('http://front.test/store/show?storeId='+store_id)
        })
    })
    
     function showModal(url){
        let data;
        $.get( url, {'data': data}, function(data){
            $('#events')
                .find('#modelContent')
                .html(data)
        });
    }
JS;
$this->registerJs($js);
?>
