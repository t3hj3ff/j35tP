<?php

use yii\helpers\Html;
use yii\helpers\arrayHelper;
use yii\widgets\ActiveForm;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options'=>['entype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'itemName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= Html::activeHiddenInput($model, 'author', array('value'=> Yii::$app->user->id));?>

    <?= $form->field($model, 'stock_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_image')->fileInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(arrayHelper::map(Category::find()->select(['name','id'])->all(),'name','name'),['class'=>'form-control inline-block']); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
