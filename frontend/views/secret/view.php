<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Secret */

$this->title = 'Secret ' . $model->alias;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="secret-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= $model->content ?></p>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->alias], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
