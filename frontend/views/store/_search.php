<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model frontend\models\StoreSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
/**
 * @param $key
 * @param $value
 * @return array
 */
function getPropertiesForSearch($key, $value): array
{
    return ArrayHelper::map( \frontend\models\Store::find()->all(),$key, $value);
}
?>
<div class="store-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id');?>
    <?=$form->field($model, 'name')->widget(Select2::classname(), [
        'data' => getPropertiesForSearch('name','name'),
        'language' => 'Ru',
        'options' => ['placeholder' => 'Select a store ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
