<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MetodoPago $model */

$this->title = 'Update Metodo Pago: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Metodo Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="metodo-pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
