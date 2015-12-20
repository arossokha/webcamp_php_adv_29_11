<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Show selected Users'), '#', ['onclick' => "(function(){
                var keys = $('#user-grid').yiiGridView('getSelectedRows');
                alert('Selected keys '+ keys.join(','));
            })();",'class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'user-grid',
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            ['class' => 'yii\grid\SerialColumn'],

            'userId',
            'email',
            // 'firstName',
            // 'lastName',
            'fullName',
            'birthDay:date',
            // 'password',
            // 'info:ntext',
            // 'authKey',
            // 'token',
            [
                'attribute' => 'image',
                'format' => ['image', ['style' => 'height:50px;']]
            ],
            [
                'attribute' => 'firstName',
                'label' => 'Full',
                'value' => function ($model) {
                    return $model->getFullName();
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {pdf}',
                'buttons' => [
                    'pdf' => function ($url, $model, $key) {
                          return Html::a('<span class="glyphicon glyphicon-file"></span>', $url,['target' => '_blank']);
                      }
                ]
            ],
        ],
    ]); ?>

</div>
