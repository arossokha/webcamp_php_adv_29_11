<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Json;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Countries');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('var countryNames = '.Json::encode($countryNames).';',View::POS_HEAD);

$this->registerJsFile('/js/editor.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<!-- <script>
    var countryNames = <?php echo Json::encode($countryNames); ?>;
</script> -->



<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>This is new theme</h2>

    <?php if(strlen($message)) { ?>
    <div class="alert alert-success">
      <strong>Success!</strong> <?php echo $message;?>
    </div>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
