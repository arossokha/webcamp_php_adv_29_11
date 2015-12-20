<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->userId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->userId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->userId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

        <?php
        // Yii::$app->formatter->locale = 'en-US';
        // echo Yii::$app->formatter->asDate($model->birthDay)."<br />";
        // Yii::$app->formatter->locale = 'de-DE';
        // echo Yii::$app->formatter->asDate($model->birthDay)."<br />";
        // Yii::$app->formatter->locale = 'ua-UA';
        // echo Yii::$app->formatter->asDate($model->birthDay)."<br />";
        // echo Yii::$app->formatter->asHtml($model->info)."<br />";
        echo Yii::$app->formatter->asImage($model->image,['style' => 'width:100px;'])."<br />";

    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userId:currency',
            'userId:boolean',
            'email',
            'email:email',
            [                      
                'label' => 'Long name',
                'value' => 'my long name',
            ],
            'birthDay',
            'password',
            'info',
            'info:ntext',
            'info:html',
            'authKey',
            'token',
            'image:image',
        ],
    ]) ?>

</div>
