<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Secret */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Access to Secret ' . $model->alias;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="secret-access">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::beginForm(); ?>

    <?php if ($message) { ?>
    <div class="alert alert-danger" role="alert"><?= $message ?></div>
    <?php } ?>

    <div class="form-group">
        <?= Html::label('Please, enter password'); ?>
        <?= Html::passwordInput('password', null, ['maxlength' => '255', 'class' => 'form-control']); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('View Secret', ['class' => 'btn btn-success']) ?>
    </div>

    <?= Html::endForm(); ?>

</div>
