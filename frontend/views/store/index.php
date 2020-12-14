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
        'id'=>'listDevice',
    ]
]);
echo "<h1 class='s123'></h1>";
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
                        ["$model->name"],
                        [
                            'data-toggle'=>'modal',
                            'data-target'=> '#listDevice',
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
    
        const store = document.querySelectorAll('[data-target="#listDevice"]');
        store.forEach((el)=>{
            el.addEventListener("click",listId);
        })
        async function listId(e){
            e.preventDefault()
            let element = e.target.innerHTML;
            $.ajax({
                url: '/store/post-name',
                data: {ajax: element},
                type: 'POST',
                success: function(res){
                    
                    $('.s123').html(res['data'])
                },
                error: function(){
                    alert('Error!');
                }
            });
        }
JS;
    $this->registerJs($js);
?>
