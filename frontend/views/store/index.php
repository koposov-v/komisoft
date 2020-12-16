<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;


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
    <pre>
    <?
    var_dump(\frontend\models\Store::OutputIdStore("MTS")); ?>
    </pre>
    <?=$this->render('_search', ['model' => $searchModel, 'data_name' => $data_name]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a("$model->name",
                        ["store/?name=$model->name"],
                        [
                            'data-toggle'=>'modal',
                            'data-target'=> '#events',
                            'class' => 'modal-store',
                            'data-name'=>"$model->name",
                        ]
                    );
                },
            ],
            'date_created',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?php
    $js =<<<JS
    $(document).ready(function (){
        $('.modal-store').click(function (){
            var name = $(this).data('name')
            showModal('store/show?name='+name)
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
