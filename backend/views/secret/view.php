<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Secret */

$this->title = $model->alias;
$this->params['breadcrumbs'][] = ['label' => 'Secrets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="secret-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'alias',
            'password',
            'content:ntext',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->alias], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->alias], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
