<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tallas $model */

$this->title = 'Modificar Talla';
$this->params['breadcrumbs'][] = ['label' => 'Tallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="tallas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
