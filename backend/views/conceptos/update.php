<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Conceptos $model */

$this->title = 'Modificar Concepto';
$this->params['breadcrumbs'][] = ['label' => 'Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="conceptos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
