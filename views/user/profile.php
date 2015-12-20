<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="user-profile">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'firstName')->hint('Enter your name') ?>
        <?= $form->field($model, 'lastName') ?>
        <?= $form->field($model, 'birthDay') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'info')->textarea() ?>
        <?= $form->field($model, 'file')->fileInput() ?>
        <?php 
            if($model->image) {
                echo Html::img(Yii::getAlias('@web').$model->image,[
                        'style' => 'width: 200px;'
                    ]);
            }
        ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-profile -->
