<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MetodoPago $model */

$this->title = 'Create Metodo Pago';
$this->params['breadcrumbs'][] = ['label' => 'Metodo Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodo-pago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
