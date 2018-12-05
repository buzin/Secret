<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Secret */

$this->title = 'Update Secret: ' . $model->alias;
$this->params['breadcrumbs'][] = ['label' => 'Secrets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->alias, 'url' => ['view', 'id' => $model->alias]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="secret-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
