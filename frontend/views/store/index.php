<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Store;
use yii\bootstrap\Modal;
use yii\helpers\Json;


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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                        ]

                    );
                },
            ],
            'data',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?php
    $js =<<<JS
    
    let data;
    const store = document.querySelectorAll('[data-target="#events"]');
    console.log(store);
    store.forEach((el)=>{
        el.addEventListener("click",listId);
    })
    async function listId(e){
        let idElement = decodeURI(e.target.href.split("=")[1])
        console.log(idElement)
        $.get( `/store/show?name=`+idElement, {'data': data}, function(data){
        $('#events')
        .find('#modelContent')
        .html(data);
    });
    }
JS;
    $this->registerJs($js);
?>
