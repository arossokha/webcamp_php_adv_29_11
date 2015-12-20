<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="user-view" style="width:300px;float: left; margin: 10px;">
    <h2>Item <?php echo $model->getFullName();?></h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userId',
            'email:email',
            'birthDay',
        ],
    ]) ?>

</div>
